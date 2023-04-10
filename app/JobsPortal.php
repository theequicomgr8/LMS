<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JobsPortal extends Authenticatable
{
   protected $connection = 'mysql4';
   protected $table = 'cromag8l_ineed';
}
