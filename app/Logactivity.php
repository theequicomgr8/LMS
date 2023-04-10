<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Logactivity extends Authenticatable
{
     protected $connection = 'mysql';
	protected $table = 'log_activity';
}
