<?php

class PrintsModel {


    function connectDB(){
        $db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8', 'root', '');
        return $db;
    }

   
    function getAll($select, $sort = null, $order = null, $begin = null, $end = null){ 
        $db = $this->connectDB();

        $query = "SELECT $select FROM objeto";

        //Traer datos ordenados
        if(isset($select) && $sort != null && $order != null){
            $query = "SELECT $select FROM objeto ORDER BY $sort $order";
        }

        //Traer datos paginados sin ordenar
        if(isset($select) && $begin != null && $end != null){
            $query = "SELECT $select FROM objeto LIMIT $begin, $end";
        }

        //datos paginados ordenados
        if($select != null && $sort != null && $order != null && $begin != null && $end != null ){
            $query = "SELECT $select FROM objeto ORDER BY $sort $order LIMIT $begin, $end";
        }

        $query = $db->prepare($query);
        $query->execute();
        $prints = $query->fetchAll(PDO::FETCH_OBJ);
        return $prints;
    
        }



    public function get($id) {
        $db = $this->connectDB();
        $query = $db->prepare("SELECT * FROM objeto WHERE id = ?");
        $query->execute([$id]);
        $print = $query->fetch(PDO::FETCH_OBJ);
        
        return $print;
    }


    public function insert($name, $descripcion, $tipo_id_fk, $dimensiones, $precio) {
        $db = $this->connectDB();
        $query = $db->prepare("INSERT INTO objeto(nombre, descripcion, tipo_id_fk, dimensiones, precio) VALUES (?,?,?,?,?)");
        $query->execute([$name, $descripcion, $tipo_id_fk, $dimensiones, $precio]);

        return $db->lastInsertId();
    }


  
    function delete($id) {
        $db = $this->connectDB();
        $query = $db->prepare('DELETE FROM objeto WHERE id = ?');
        $query->execute([$id]);
    }

    

}
