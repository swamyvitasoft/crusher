<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'login'; // table name
    protected $primaryKey = 'login_id';
    protected $allowedFields = ['role', 'name', 'email_id', 'password'];
}
