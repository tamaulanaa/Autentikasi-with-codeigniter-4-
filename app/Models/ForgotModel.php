<?php

namespace App\Models;

use CodeIgniter\Model;

class ForgotModel extends Model
{
    protected $DBGroup = 'default';
    protected $table            = 'forgot_table';
    protected $allowedFields    = ['email', 'token', 'created_at'];
}
