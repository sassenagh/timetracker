<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>TimeTracker</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                width: 100%;
                /* height: 100vh; */
                margin: 0;
            }

            .full-height {
                margin-top: 5%;
                /* height: 100vh; */
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 64px;
            }

            .subtitle {
                font-size: 34px;
            }

            .clock {
                font-size: 30px;
            }

            .badge-warning, .badge-activated {
                color: #212529;
                background-color: #ffed4a;
            }

            .badge-danger, .badge-stopped {
                color: #fff;
                background-color: #dc3545;
            }

            .badge-secondary, .badge-never {
                color: #fff;
                background-color: #6c757d;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .form-control {
                display: inline;
                width: auto;
            }
        </style>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">
    </head>
    <body>
        <div class="flex-center position-ref full-height container-fluid">


            <div class="content">
                <div class="title">
                    TimeTracker
                </div>


                <div>
                    <input type="text" class="form-control" aria-describedby="inputGroup-sizing-default"  id="task-name" name="task-name">

                    <button id='start' class="btn btn-outline-success"><i class='fas fa-play'></i> start</button>
                    <button id='stop' class="btn btn-outline-danger"><i class='fas fa-stop'></i> stop</button>

                    <div class="clock">
                        <span id='hours'>00</span> :
                        <span id='minutes'>00</span> :
                        <span id='seconds'>00</span>
                    </div>

                </div>

                <div class="mt-sm-3">
                    <div class="subtitle">
                        Today's Tasks
                    </div>

                    <div id="today">
                        @if ($today_tasks != '[]')
                        <table class="table">
                            <tbody>
                                @foreach ($today_tasks as $task)
                                    <tr>
                                        <th scope="row">{{ $task->task_name }}</th>
                                        <td><span class="badge badge-{{ $task->status }}">{{ $task->status }}</span></td>
                                        <td>{{ gmdate("H:i:s", $task->total_time_in_seconds) }}</td></p>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No tasks found for today
                        @endif
                    </div>

                </div>

                <div class="mt-sm-3">
                    <div class="subtitle">
                        All Tasks
                    </div>
                    <div id="all">
                        @if ($all_tasks != '[]')
                        <table class="table">
                            <tbody>
                                @foreach ($all_tasks as $task)
                                    <tr>
                                        <th scope="row">{{ $task->task_name }}</th>
                                        <td><span class="badge badge-{{ $task->status }}">{{ $task->status }}</span></td>
                                        <td>{{ gmdate("H:i:s", $task->total_time_in_seconds) }}</td></p>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No tasks found
                        @endif
                    </div>

                </div>





            </div>
        </div>


        <script src="/js/tasks.js"></script>
        <script src="/js/app.js"></script>
    </body>
</html>
