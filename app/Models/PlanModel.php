<?php
namespace App\Models;
use CodeIgniter\Model;

class PlanModel extends Model {
    protected $table = 'plans';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'destination',
        'start_date',
        'end_date',
        'activities',
        'title',
        'user_id'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}