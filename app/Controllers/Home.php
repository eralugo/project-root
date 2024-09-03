<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {

        $db = \Config\Database::connect();

        $query = $db->query("SELECT * FROM test ");

        $resultado = $query->getResult();

        //return view('welcome_message');

        return " " .var_dump($resultado);
    }
}
