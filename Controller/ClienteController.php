<?php

require_once "./Model/ClienteModel.php";
require_once "./Model/ActividadModel.php";
require_once "./Model/TarjetaModel.php";
require_once "./View/ClienteView.php";
require_once "./Helpers/AuthHelper.php";

class ClienteController {

    private $view;
    private $model;
    private $authhelper;

    function __construct()
    {
        $this->model = new ClienteModel();
        $this->actividadModel = new ActividadModel();
        $this->tarjetaModel = new TarjetaModel();
        $this->view = new ClienteView();
        $this->authhelper = new AuthHelper();
    }

    public function insertarCliente() {
        $logueado = $this->authhelper->checkLoggedIn();
        $admin = $this->authhelper->checkAdimn();
        if($logueado && $admin){
            if(!empty($_POST['nombre']) && !empty($_POST['dni']) && !empty($_POST['telefono']) && !empty($_POST['direccion']) && !empty($_POST['ejecutivo']) && !empty($_POST['id'])) {
                $dni = $this->model->getDniFromDB();
                if($dni == false){
                    $this->model->insertClientFromDB($_POST['nombre'], $_POST['dni'], $_POST['telefono'], $_POST['direccion'], $_POST['ejecutivo'], $_POST['id']);
                    $this->view->showMessage("Cliente insertado con exito!");
                    $kms = $this->actividadModel->getKmsFromDB();
                    if($kms){
                        $this->view->showMessage("Ademas le regalamos 200 kms en su cuenta");
                    }
                    $ejecutivo = $this->model->getClientFromDB();
                    if($ejecutivo){
                        $this->view->showMessage("Ademas se le obsequiara una tarjeta de regalo!"); 
                    }
                }
                else {
                    $this->view->showMessage("No se pudo agregar nuevo cliente");
                }
            }
            else {
                $this->view->showMessage("Los campos no estan completos");
            }
        }
        else {
            $this->view->showMessage("Usted no tiene permiso!");
        }
    }

    public function resumenDeCuenta() {
        $id = $_POST['id'];
        $cliente = $this->model->getClientByID($id);
        if($cliente) {
            $tarjetas = $this->tarjetaModel->getCardsFromDB();
            if($tarjetas) {
                foreach($tarjetas as $tarjeta) {
                    $tarjetaAsociada = $this->tarjetaModel->getCardFromDB($tarjeta->tipo_tarjeta);
                    $this->view->showMessage("Estas son tus tarjetas asociadas $tarjetaAsociada");
                }
                $actividad = $this->actividadModel->getActivityFromDB();
                if($tarjetas && $actividad) {
                    $this->view->showMessage("resumen $tarjeta y resumen $actividad");
                }
            }
            else {
                $this->view->showMessage("No existe dicha tarjeta!");
            }
        }
        else{
            $this->view->showMessage("Cliente no asociado!");
        }

    }

    public function trasferenciaRapida() {
        $logueado = $this->authhelper->checkLoggedIn();
        $id = $_POST['id'];
        if($logueado) {
            $clientes= $this->model->getClientByID($id);
            if($clientes) {
                $tarjeta = $this->tarjetaModel->getCardsFromDB();
                if($tarjeta) {
                    
                }
                
            }
        }
    }

    
}


