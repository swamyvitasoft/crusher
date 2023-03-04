<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table      = 'products'; // table name
    protected $primaryKey = 'id';
    protected $allowedFields = ['product'];
}
