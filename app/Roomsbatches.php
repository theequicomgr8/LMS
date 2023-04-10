<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Roomsbatches extends Authenticatable
{
    protected $connection = 'mysql3';
   protected $table = 'rooms_batches';
      
    
}
