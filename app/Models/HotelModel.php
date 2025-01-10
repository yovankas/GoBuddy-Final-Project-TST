<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelModel extends Model
{
    protected $table = 'hotels';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'rating', 'review_count', 'address', 'price', 'destination', 'link', 'thumbnail_url', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getHotelsWithDetails($destination, $page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;

        $builder = $this->select('hotels.*, GROUP_CONCAT(DISTINCT ha.amenity) as amenities')
            ->join('hotels_amenities ha', 'ha.hotel_id = hotels.id', 'left')
            ->where('hotels.destination', $destination)
            ->groupBy('hotels.id')
            ->limit($perPage, $offset);

        $hotels = $builder->get()->getResultArray();

        // Process amenities for each hotel
        foreach ($hotels as &$hotel) {
            $hotel['amenities'] = $hotel['amenities'] ? explode(',', $hotel['amenities']) : [];
        }

        return $hotels;
    }
}