<?php
require_once "./Model/ClienteModel.php";
require_once "./Model/ActividadModel.php";
require_once "./Model/TarjetaModel.php";
require_once "./View/ApiView.php";

class ApiClientController{

    private $model;
    private $actividadModel;
    private $tarjetaModel;
    private $view;

    function __construct(){
        $this->model = new ClienteModel();
        $this->actividadModel = new ActividadModel();
        $this->tarjetaModel = new TarjetaModel();
        $this->view = new ApiView();
    }

    function obtenerTarjetas(){
        $tarjetas = $this->tarjetaModel->getCardsFromDB();
        return $this->view->response($tarjetas, 200);
    }

    function historialActividad() {
        $actividades = $this->actividadModel->getActivitysFromDB();
        if($actividades) {
            foreach($actividades as $actividad){
                $intervalo = $this->actividadModel->getActivityFromDB($actividad->fecha);
                if($intervalo) {
                    return $this->view->response($actividades, 200);
                }
                else {
                    return $this->view->response("No se puede ver el historial", 404);
                }

            }
        }
    }

    public function eliminarTarjeta($params = null){
        $idTarjeta = $params[":ID"];
        $tarjeta = $this->tarjetaModel->getCardFromDB($idTarjeta);
        if($tarjeta){
            $this->tarjetaModel->deleteCardFromDB($idTarjeta);
            return $this->view->response("Tarjeta borrada con exito!", 200);
        }
        else {
            $this->view->response("La tarjeta con id = $idTarjeta no existe", 404);
        }

    }

}