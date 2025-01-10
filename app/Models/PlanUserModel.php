<?php

namespace App\Models;

use CodeIgniter\Model;

class PlanUserModel extends Model
{
    protected $table = 'plan_users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['plan_id', 'user_id', 'is_owner'];
    public $timestamps = false;
}