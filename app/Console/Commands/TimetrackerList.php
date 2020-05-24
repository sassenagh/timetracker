<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\TasksController;

class TimetrackerList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timetracker:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Getting the class Tasks in Controller
        $task = new TasksController();

        try{
            // Calling function to get today's tasks
            $today = $task->getTodayTasks();
            // Listing in terminal
            echo "\n*** Today's tasks ***\n";
            echo "Start time - End time - Status - Task name - Total time elapsed\n";
            foreach ($today as $val) {
                echo $val['created_at']. " - ".
                        $val['updated_at']." - ".
                        $val['status']." - ".
                        $val['task_name']." - ".
                        gmdate("H:i:s", $val['total_time_in_seconds'])."\n";
                }

            // Calling function to get all tasks
            $all = $task->getAllTasks();
            // Listing in terminal
            echo "\n*** All tasks ***\n";
            echo "Start time - End time - Status - Task name - Total time elapsed\n";
            foreach ($all as $val) {
                echo $val['created_at']. " - ".
                        $val['updated_at']." - ".
                        $val['status']." - ".
                        $val['task_name']." - ".
                        gmdate("H:i:s", $val['total_time_in_seconds'])."\n";
                }
                echo "\n";
        } catch(Exception $e){
            echo $e. "\n";
        }
    }
}
