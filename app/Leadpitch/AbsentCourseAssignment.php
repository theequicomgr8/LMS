<?php

namespace App\Leadpitch;

use Illuminate\Database\Eloquent\Model;
use Session;
class AbsentCourseAssignment extends Model
{
    
// 	protected $prefix;
protected $connection = 'mysql12';
    protected $table ="croma_absentcourseassign";	 
   
   /* public function __construct(array $attributes = [])
    {
		 
        if(isset($this->prefix)){			
            $this->table = Session::get('company_id').$this->table;
        } else {
            $this->table = Session::get('company_id').$this->table;
        }

        parent::__construct($attributes);
    } */
}
