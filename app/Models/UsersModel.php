<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';


    protected $allowedFields = ['id', 'nama', 'email', 'password', 'image', 'active', 'token_active', 'created_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates

    // Validation
    protected $validationRules      = [
        'nama' => 'required',
        'email'    => 'required|max_length[254]|valid_email',
        'password' => 'required|max_length[255]|min_length[8]',
        // 'confirm_password' => 'required|matches[password]',
        'image' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,2048]'

    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
