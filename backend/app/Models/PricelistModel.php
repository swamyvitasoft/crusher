<?php

namespace App\Models;

use CodeIgniter\Model;

class PricelistModel extends Model
{
    protected $table      = 'price_list'; // table name
    protected $primaryKey = 'price_id';
    protected $allowedFields = ['product', 'quantity', 'price', 'login_id'];
}
