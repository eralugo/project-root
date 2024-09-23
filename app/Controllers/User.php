<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
//use App\Models\UserModel;
 
class User extends BaseController
{
    use ResponseTrait;
     
    public function index()
    {
        //$users = new UserModel;
        //return $this->respond(['users' => $users->findAll()], 200);

        $response = [
            'message' => 'exito'
        ];
          
        return $this->respond($response, 200);
    }
    public function update($id)
    {
        //$users = new UserModel;
        //return $this->respond(['users' => $users->findAll()], 200);

        $response = [
            'message' => $id
        ];
          
        return $this->respond($response, 200);
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
        return $this->respond($respuesta, 200); // en caso de error 401

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Ocurrió un error interno.']);
        }
    }

}


