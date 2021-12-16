<?php

class ActividadModel
{
    private $db;

    public function __construct()
    {
        //conexion a la base de datos
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_servicioPFY;charset=utf8', 'root', '');
    }

    function getKmsFromDB() {
        $query = $this->db->prepare("SELECT * FROM actividad WHERE kms = ?");
        $query->execute();
    }

    function getActivityFromDB() {
        $query = $this->db->prepare("SELECT * FROM actividad WHERE id = ?");
        $query->execute();
        $actividad = $query->fetch(PDO::FETCH_OBJ);
        return $actividad;
    }

    function getActivitysFromDB() {
        $query = $this->db->prepare("SELECT * FROM actividad");
        $query->execute();
        $actividades = $query->fetchAll(PDO::FETCH_OBJ);
        return $actividades;
    }

}