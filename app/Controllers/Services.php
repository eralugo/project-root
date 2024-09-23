<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use App\Models\ServicesModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\ServicesModelModel;
use Faker\Provider\Uuid;
use CodeIgniter\Database\Exceptions\DatabaseException;
 
class Services extends BaseController
{
    use ResponseTrait;

    private $servicioModel;
    
    public function __construct(){

        $this->servicioModel = new ServicesModel();
    }
         
    public function index() 
    {
        try
        {
            $response = $this->servicioModel->findAll();
            if(!is_array($response)) 
            return $this->response->setStatusCode(code: 401)->setJSON(['status'=>'error', 'tipo'=>"logico", 'detalle'=>'dato no encontrado']);                      
                            
            return $this->respond($response, 200);
        }
        catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(["status"=>"error", "tipo"=>"exepcion", 'detalle'=>$e->getMessage()]);
        }
    }

    public function find($uuid) 
    {
        try
        {
            $response = $this->servicioModel->find($uuid);
                        
            if(!is_array($response)) 
            return $this->response->setStatusCode(code: 401)->setJSON(['status'=>'error', 'tipo'=>"logico", 'detalle'=>'dato no encontrado']);                      
            
            return $this->respond($response, 200);
        }
        catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(["status"=>"error", "tipo"=>"exepcion", 'detalle'=>$e->getMessage()]);
        }
    }

    public function create()
    {
        try
        {
            $data = $this->request->getJSON(true);
            
            $respuesta = $this->servicioModel->insert( $data);
            if($respuesta === false) return $this->response->setStatusCode(code: 401)->setJSON(['status'=>'error', 'tipo'=>"logico", 'detalle'=>'valores no validos']);  

            return $this->respond(['status' => 'correcto', 'id'=> $this->servicioModel->getInsertID()], 200);
        }
        catch (DatabaseException $e) {
            return $this->response->setStatusCode(500)->setJSON(["status"=>"error", "tipo"=>"exepcion", 'detalle'=>$e->getMessage()]);
        }
        catch (\RuntimeException $e) {
            return $this->response->setStatusCode(500)->setJSON(["status"=>"error", "tipo"=>"exepcion", 'detalle'=>$e->getMessage()]);
        }
        catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(["status"=>"error", "tipo"=>"exepcion", 'detalle'=>$e->getMessage()]);
        }
    }
    public function update()
    {
        try
        {
            $data = $this->request->getJSON(true); // get data json body 
            $service_id = $data['id'];  // '141b2890-4b6e-43d2-bf0f-e68b87c6e657'; // service_id

            $array = (array) $data;
            unset($array['id']); // Eliminar la clave 'id'         
            $objectSinId = (object) $array; // (Opcional) Convertir de nuevo el array a un objeto si lo necesitas

            //['service_num_folio_o_reserva', 'customer_id', 'status_id', 'service_date', 'service_time', 'place_id_origin', 'place_id_destination', 'service_flight_number', 'service_type_id', 'service_passenger_name', 'service_passenger_number', 'service_luggages_number', 'service_phone', 'service_meeting_point', 'service_detail', 'service_travel_time', 'driver_id', 'service_amount', 'status_payment_id', 'vehicle_id'];
            
            $respuesta = $this->servicioModel->update(  $service_id, $objectSinId);
            if($respuesta == false) return $this->response->setStatusCode(code: 401)->setJSON(['status'=>'error', 'tipo'=>"logico", 'detalle'=>'valores no validos']);  

            return $this->respond(['status' => 'correcto'], 200);
        }
        catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(["status"=>"error", "tipo"=>"exepcion", 'detalle'=>$e->getMessage()]);
        }
    }

    public function updateRestful($uuid)
    {
        try
        {
            $data_body = $this->request->getJSON(true); 
            
            $respuesta = $this->servicioModel->update( $uuid, $data_body);

            if($respuesta === false) return $this->response->setStatusCode(code: 401)->setJSON(['status'=>'error', 'tipo'=>"logico", 'detalle'=>'valores no validos']);  

            return $this->respond(['status' => 'correcto'], 200);
        }
        catch (DatabaseException $e) {
            return $this->response->setStatusCode(500)->setJSON(["status"=>"error", "tipo"=>"exepcion", 'detalle'=>$e->getMessage()]);
        }
        catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(["status"=>"error", "tipo"=>"exepcion", 'detalle'=>$e->getMessage()]);
        }
    }

    public function updatejson()
    {
        
        try {
        
        // Lee el cuerpo de la solicitud cruda como un string
        //$jsonString = file_get_contents('php://input');
        
        // Decodifica el string JSON a un arreglo asociativo
        //$data = json_decode($jsonString, true);

        $data = $this->request->getJSON(true);

        // Ahora puedes acceder a los datos del JSON como elementos de un arreglo asociativo
        $nombre = $data['nombre'] ?? null;
        $email = $data['email'] ?? null;
        $id = $data['id'] ?? null;

        $respuesta = [
            'status' => 'success',
            'nombre' => $nombre,
            'email' => $email
        ];

        // Conectarse a la base de datos
        $db = \Config\Database::connect();
        $builder = $db->table('test');
 
        // Parámetro de ejemplo: obtener usuarios activos
        //$status = 1;
 
        // Usar consulta parametrizada para evitar inyección SQL
        $query = $builder->where('id', $id)->get();
 
        // Obtener los resultados como un array asociativo
        $respuesta = $query->getResultArray();
 
        // Devolver los datos como JSON
        //return $this->response->setJSON($usuarios);
        // $this->response->setStatusCode(400)->setJSON(['error' => 'No se recibieron datos en la solicitud.']);

        // Realiza alguna acción con los datos obtenidos
        //return $this->response->setJSON($respuesta);
        return $this->respond($respuesta, 200); 

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Ocurrió un error interno.']);
        }
    }

}


