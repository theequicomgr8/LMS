<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CoursesContent extends Authenticatable
{
     protected $connection = 'mysql';
   protected $table = 'courses_content';
}
