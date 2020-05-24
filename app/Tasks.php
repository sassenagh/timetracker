<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
          protected $fillable = [
            'task_name', 'status', 'total_time_in_seconds', 'updated_at', 'created_at'
          ];

         /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
          protected $dates = ['created_at', 'updated_at'];



}
