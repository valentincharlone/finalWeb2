<?php

class TarjetaModel
{
    private $db;

    public function __construct()
    {
        //conexion a la base de datos
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_servicioPFY;charset=utf8', 'root', '');
    }

    public function getCardsFromDB() {
        $query = $this->db->prepare("SELECT * FROM tarjeta");
        $query->execute();
        $tarjetas = $query->fetchAll(PDO::FETCH_OBJ);
        return $tarjetas;
    }

    public function getCardFromDB($tipo_tarjeta) {
        $query = $this->db->prepare("SELECT * FROM tarjeta WHERE id = ?");
        $query->execute(array($tipo_tarjeta));
        $tarjeta = $query->fetchAll(PDO::FETCH_OBJ);
        return $tarjeta;
    }

    public function deleteCardFromDB($idTarjeta) {
        $query = $this->db->prepare("DELETE FROM tarjeta WHERE id = ?");
        $query->execute(array($idTarjeta));
    }

}