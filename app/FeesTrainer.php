<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class FeesTrainer extends Authenticatable
{
    protected $connection = 'mysql2';
   protected $table = 'wp_trainers_details';
      
    
}
