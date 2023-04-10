<?php
 namespace App\Leadpitch;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;
 

class Lead extends Model
{
    // protected $prefix;
    protected $connection = 'mysql12';
    protected $table ="croma_leads";	 
   
}



 