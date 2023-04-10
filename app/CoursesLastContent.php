<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CoursesLastContent extends Authenticatable
{
     protected $connection = 'mysql';
   protected $table = 'courses_lastcontent';
}
