# TimeTracker

TimeTracker allows you to save how much time you spend in every task, and lets you know what you have done today.

## Getting Started

In order to activate TimeTracker you should choose a name for your task and then push Start button. When you finish your task, you should push Stop button, then your task will be displayed on the list below.
Tasks can get 3 different states:

-   activated (if you just pushed start)
-   stopped (if the task has been correctly finished)
-   never stopped (if accidentally you refreshed the application and didn't succeed to finish the task by pushing the Stop button and you created the same task again to get it active again)

### Prerequisites

You need to have Docker and docker-compose already installed.

### Installing

You need to follow this steps:

    git clone https://github.com/sassenagh/timetracker
    cd timetracker
    docker-compose up -d

The app will be running in http://localhost:3000

## Running Timetracker by script

Please bear in mind that to run the script version, you will have to execute the commands on this section inside your docker container.

    docker exec -it [container_name] bash

Script option allows you to launch the application by your terminal using the following strings to start and stop respectively:

    php artisan timetracker:start [yourtaskname]
    php artisan timetracker:stop [yourtaskname]

Furthermore, you can list all the task recorded by the following command:

    php artisan timetracker:list

That commands allow you to see the tasks that are stored in the database during all the time you are used the application and to check separately the tasks you have done today by 2 separated lists.

## Built With

-   [Laravel](https://laravel.com/docs/) - The web framework used
-   [Docker](https://docs.docker.com/) - Docker container
-   [Bootstrap](https://getbootstrap.com/docs/4.5/getting-started/introduction/) - Used for css styles

## Authors

-   **Anna Alcaide** - _Initial work_ - [TimeTracker](https://github.com/sassenagh/timetracker)

## Acknowledgments

-   If you accidentally refreshed the page or lost connection before stopping the test at the time you needed, you can always stop it by using the script ;)
    Have a look here -> Running Timetracker by script
