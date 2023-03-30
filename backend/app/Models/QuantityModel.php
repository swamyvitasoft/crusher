<?php

namespace App\Models;

use CodeIgniter\Model;

class QuantityModel extends Model
{
    protected $table      = 'quantity'; // table name
    protected $primaryKey = 'id';
    protected $allowedFields = ['quantity'];
}
