<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicesModel extends Model{
    protected $table      = 'services';
    protected $primaryKey = 'service_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false; // definir campo

    protected $allowedFields = ['service_num_folio_o_reserva', 'customer_id', 'status_id', 'service_date', 'service_time', 'place_id_origin', 'place_id_destination', 'service_flight_number', 'service_type_id', 'service_passenger_name', 'service_passenger_number', 'service_luggages_number', 'service_phone', 'service_meeting_point', 'service_detail', 'service_travel_time', 'driver_id', 'service_amount', 'status_payment_id', 'vehicle_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}


