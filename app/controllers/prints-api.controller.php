<?php
require_once './app/models/prints.model.php';
require_once './app/views/api.view.php';

class PrintApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new PrintsModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getPrints($params = null) {
        if(isset($_GET['sort']) && isset($_GET['order'])){
            $print = $this->model->getAll($_GET['sort'], $_GET['order']);

        } else if(isset($_GET['sort'])){
            $print = $this->model->getAll($_GET['sort']);

        } else {
            $print = $this->model->getAll();
        }
        $this->view->response($print);
    }

    public function getPrint($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $print = $this->model->get($id);

        // si no existe devuelvo 404
        if ($print)
            $this->view->response($print);
        else 
            $this->view->response("La impresión con el id=$id no existe", 404);
    }

    public function deletePrint($params = null) {
        $id = $params[':ID'];

        $print = $this->model->get($id);
        if ($print) {
            $this->model->delete($id);
            $this->view->response($print);
        } else 
            $this->view->response("La impresión con el id= $id no existe", 404);
    }

    public function insertPrint($params = null) {
        $print = $this->getData();

        if (empty($print->nombre) || empty($print->descripcion) || empty($print->tipo_id_fk) || empty($print->dimensiones) || empty($print->precio)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($print->nombre, $print->descripcion,$print->tipo_id_fk , $print->dimensiones, $print->precio);
            $print = $this->model->get($id);
            $this->view->response($print, 201);
        }
    }

}
