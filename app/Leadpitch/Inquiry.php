<?php

namespace App\Leadpitch;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Inquiry extends Authenticatable
{
    protected $connection = 'mysql12';
   protected $table = 'croma_enquiries';
      
    
}
