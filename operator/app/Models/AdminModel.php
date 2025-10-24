<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = ''; // Default table name
    protected $primaryKey = 'id';           // Default primary key
    protected $allowedFields = '';
    public function tables(string $tableName, string $id, array $allowedFields)
    {
        $this->table = $tableName;
        $this->primaryKey = $id; // Set the primary key
        $this->allowedFields = $allowedFields;
    }


    public function login($username, $password)
    {
        return $this->where('username', $username)
            ->where('password', $password) // plain-text only
            ->first();
    }

    public function states()
    {
        $this->table = 'states';
        $this->primaryKey = 'id';
        $this->allowedFields = ['id', 'state', 'status'];
    }



}


