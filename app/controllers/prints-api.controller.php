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

        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getPrints($params = null) {

        
        $columns = array(  'id' => 'id',
                            'nombre' => 'nombre',
                            'descripcion' => 'descripcion',
                            'tipo_id_fk' => 'tipo_id_fk',
                            'dimensiones' => 'dimensiones',
                            'precio' => 'precio'
                        );


        $select = $_GET["select"] ?? "*";
        $sort = $_GET["sort"] ?? null;
        $order = $_GET["order"] ?? null; 
        $begin= $_GET["begin"] ?? null;
        $end = $_GET["end"] ?? null;

        $prints = $this->model->getAll($select, $sort, $order, $begin, $end);

             //Select de cualquier columna               
             if(in_array($select, $columns) || $select == "*"){
                $prints = $this->model->getAll($select);
            } //Datos ordenados de cualquier columna

                else if (in_array($select, $columns) || $select == "*" && isset($sort) && isset($order) && strtoupper($order) == "ASC" || strtoupper($order) == "DESC"){
                $prints = $this->model->getAll($select, $sort, $order);
            }  
            //Datos paginados ordenados de cualquier columna

                else if ($sort && $begin >= "0" && $begin <= "9" && $end >= "0" && $end <= "9") {
                 $prints = $this->model->getAll($select, $sort, $order, $begin, $end);
            } 
    
      
            $prints = $this->model->getAll($select, $sort, $order, $begin, $end);
    
            $this->view->response($prints);
    }

    public function getPrint($params = null) {
        $id = $params[':ID'];
        $print = $this->model->get($id);

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
