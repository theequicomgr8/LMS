<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class FeesPayTrainer extends Authenticatable
{
    protected $connection = 'mysql2';
   protected $table = 'wp_addpaytrainers_details';
      
    
}
