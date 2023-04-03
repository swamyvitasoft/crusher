<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpensesModel extends Model
{
    protected $table      = 'expenses'; // table name
    protected $primaryKey = 'expen_id';
    protected $allowedFields = ['login_id', 'expen_type', 'reason', 'receipt_no', 'amount', 'payment_date'];
}
