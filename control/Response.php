<?php
class Response{

    public $response = ["status" => "ok", "result" => array()];

    public function error_405(){
        $this->response["status"] = "error";
        $this->response["result"] = "Metodo no permitido";
        return $this->response;
    }

    public function error_210(){
        $this->response["status"] = "error";
        $this->response["result"] = "recurso no encontrado";
        return $this->response;
    }
    public function error_404(){
        $this->response["status"] = "error";
        $this->response["result"] = "no encontrado";
        return $this->response;
    }

    public function error_400(){
        $this->response["status"] = "error";
        $this->response["result"] = "solicitud incorrecta";
        return $this->response;
    }
    

}