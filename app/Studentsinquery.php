<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Studentsinquery extends Authenticatable
{
     protected $connection = 'mysql';
   protected $table = 'students_inquery';
}
