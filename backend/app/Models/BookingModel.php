<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table      = 'loads'; // table name
    protected $primaryKey = 'load_id';
    protected $allowedFields = ['customer_id', 'driver_name', 'product', 'quantity', 'vehicle_no', 'price', 'login_id', 'load_date'];
}
