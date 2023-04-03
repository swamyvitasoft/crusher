<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentsModel extends Model
{
    protected $table      = 'payments'; // table name
    protected $primaryKey = 'payment_id';
    protected $allowedFields = ['customer_id', 'load_id', 'payment_type', 'note', 'total_amount', 'payment_today', 'due_amount', 'create_date', 'login_id'];
}
