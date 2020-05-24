<?php

namespace App\Http\Controllers;

use DB;
use Log;
use App\Tasks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


     // Create Task
  public function createTask(Request $request){

    $task_name = $request->input('task_name');
    $task_name = ucfirst(trim($task_name));

      // Calling function to create a new task
    return $this->internalCreateTask($task_name);

  }

    // data processing for creating a new task
  public function internalCreateTask($task_name){
    try{
            // Creating task in database
        $task = Tasks::create(['task_name' =>$task_name, 'status'=>'activated']);

        } catch(Exception $e){
            Log::error($e);
            return false;
        }

        return true;

  }


     // Update Task
  public function updateTask(Request $request){

    $task_name = $request->input('task_name');
    $task_name = ucfirst(trim($task_name));

        // Calling function to update a task
    return $this->internalUpdateTask($task_name);

  }

    // data processing for updating a task
  public function internalUpdateTask($task_name){

    try{
            // Updating task in database
        $task = Tasks::where('task_name', $task_name)
                ->where('status', 'activated')
                ->orderBy('created_at', 'desc')
                ->first();

        if(!$task){
            echo "Unable to stop ".$task_name."\n\n";
            return false;
        }
        // Task successfully stopped
        $task->status = 'stopped';

        // Getting total time spended in task
        $start = $task->created_at;
        $end = now();

        $totaltime = $this->totalTime($start, $end);

        $task->total_time_in_seconds = $totaltime;

        // Updating in database
        $task->save();

        $this->updateStatus($task_name);

    } catch(Exception $e){
        Log::error($e);
        return false;
    }


        return true;

  }

       // Get All Tasks
  public function getAllTasks(){

        try{
            // Query all tasks
            $tasks = Tasks::select(DB::raw('task_name , status , min(created_at) as created_at, max(updated_at) as updated_at, sum(total_time_in_seconds) as total_time_in_seconds'))
            ->groupBy('task_name', 'status')
            ->orderByDesc('updated_at')
            ->get();

            return $tasks;

        } catch(Exception $e){
            Log::error($e);
        }

        return true;

      }

       // Get Today's Tasks
  public function getTodayTasks(){

        try{
            // Query tasks for today
            $tasks = Tasks::select(DB::raw('task_name , status , min(created_at) as created_at, max(updated_at) as updated_at, sum(total_time_in_seconds) as total_time_in_seconds'))
            ->whereDate('created_at', \Carbon\Carbon::today())
            ->groupBy('task_name', 'status')
            ->orderByDesc('updated_at')
            ->get();

            return $tasks;

        } catch(Exception $e){
            Log::error($e);
        }

        return true;

      }

       // Get Main Tasks
  public function getMainTasksView(){
        // Lists views
        $all_tasks = $this->getAllTasks();
        $today_tasks = $this->getTodayTasks();

        return view('tasks',['all_tasks'=>$all_tasks, 'today_tasks'=>$today_tasks]);


      }


          // New status for duplicated task accidentally not stopped
  public function updateStatus($task_name){

        //Task activated twice with the same name gets 'never stopped' status
    $task = Tasks::where('task_name', $task_name)
            ->where('status', 'activated')
            ->update(['status' => 'never stopped']);



    return true;

  }


      // Calculate time in seconds
  public function totalTime($start, $end){

    try{
        $start = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $start);
        $end = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $end);

        $date1Timestamp = strtotime($start);
        $date2Timestamp = strtotime($end);

        $totaltime = $date2Timestamp - $date1Timestamp;

        return $totaltime;

    } catch(Exception $e){
        Log::error($e);
    }

    return false;

  }



}
