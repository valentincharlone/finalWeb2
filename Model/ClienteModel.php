<?php

class ClienteModel
{
    private $db;

    public function __construct()
    {
        //conexion a la base de datos
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_servicioPFY;charset=utf8', 'root', '');
    }

    function getClientByID($id) {
        $query = $this->db->prepare("SELECT * FROM cliente WHERE id = ?");
        $query->execute(array ($id));
        $cliente = $query->fetch(PDO::FETCH_OBJ);
        return $cliente;
    }

    function getClientFromDB() {
        $query = $this->db->prepare("SELECT * FROM cliente WHERE ejecutivo = ?");
        $query->execute();
        $client = $query->fetch(PDO::FETCH_OBJ);
        return $client;
    }

    function getDniFromDB() {
        $query = $this->db->prepare("SELECT * FROM cliente WHERE dni = ?");
        $query->execute();
        $dni = $query->fetchAll(PDO::FETCH_OBJ);
        return $dni;
    }

    function insertClientFromDB($nombre, $dni, $telefono, $direccion, $ejecutivo, $id) {
        $query = $this->db->prepare("INSERT INTO cliente(nombre, dni, telefono, direccion, ejecutivo, id) VALUES (?,?,?,?,?,?)");
        $query->execute(array($nombre, $dni, $telefono, $direccion, $ejecutivo, $id));
        
    }

}