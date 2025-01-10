<?php
namespace App\Models;
use CodeIgniter\Model;

class ConfirmationModel extends Model {
    protected $table = 'confirmations';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'plan_id',
        'type',
        'provider',
        'booking_reference',
        'date',
        'time',
        'details'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}