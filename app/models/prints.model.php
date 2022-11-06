<?php

class PrintsModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8', 'root', '');
    }

    /**
     * Devuelve la lista de tareas completa.
     */
    public function getAll() {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase

        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT * FROM objeto");
        $query->execute();

        // 3. obtengo los resultados
        $print = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $print;
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM objeto WHERE id = ?");
        $query->execute([$id]);
        $print = $query->fetch(PDO::FETCH_OBJ);
        
        return $print;
    }

    /**
     * Inserta una tarea en la base de datos.
     */
    public function insert($name, $description, $selectImp, $dimensions, $price) {
        $query = $this->db->prepare("INSERT INTO objeto(nombre, descripcion, tipo_id_fk, dimensiones, precio) VALUES (?,?,?,?,?)");
        $query->execute([$name, $description, $selectImp, $dimensions, $price]);

        return $this->db->lastInsertId();
    }


    /**
     * Elimina una tarea dado su id.
     */
    function delete($id) {
        $query = $this->db->prepare('DELETE FROM objeto WHERE id = ?');
        $query->execute([$id]);
    }

}
