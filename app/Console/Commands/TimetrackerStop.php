<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\TasksController;

class TimetrackerStop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timetracker:stop {task}';

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
        $task_name = ucfirst(trim($this->argument('task')));
        try{
            // Calling function to create a new task
            $process = $task->internalUpdateTask($task_name);
            echo "Task successfully stopped\n\n";
        } catch(Exception $e){
            echo $e. "\n";
        }
    }
}
