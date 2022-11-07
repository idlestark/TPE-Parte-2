<?php

class PrintsModel {


    function conectarDB(){
        $db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8', 'root', '');
        return $db;
    }

   
    function getAll($sort = 'precio', $order = 'ASC'){ 
        $db = $this->conectarDB();
         $query_sort = "SELECT * FROM objeto
            ORDER BY ";
            $columns = array('nombre' => 'nombre ',
                              'descripcion' => 'descripcion ',
                              'tipo_id_fk' => 'tipo_id_fk ',
                              'dimensiones' => 'dimensiones ',
                              'precio' => 'precio '
                            );
    
            if (isset($columns[$sort])){
                $query_sort .= $columns[$sort];
            } else {
                return null;
            }
    
            if(strtoupper($order) == 'ASC' || strtoupper($order) == 'DESC'){
                $query_sort .= $order;
            } else {
                return null;
            }
    
            $query = $db->prepare($query_sort);
            $query->execute();
            $prints = $query->fetchAll(PDO::FETCH_OBJ);
            return $prints;
    
        }



    public function get($id) {
        $db = $this->conectarDB();
        $query = $db->prepare("SELECT * FROM objeto WHERE id = ?");
        $query->execute([$id]);
        $print = $query->fetch(PDO::FETCH_OBJ);
        
        return $print;
    }

    /**
     * Inserta una impresion en la base de datos.
     */
    public function insert($name, $descripcion, $tipo_id_fk, $dimensiones, $precio) {
        $db = $this->conectarDB();
        $query = $db->prepare("INSERT INTO objeto(nombre, descripcion, tipo_id_fk, dimensiones, precio) VALUES (?,?,?,?,?)");
        $query->execute([$name, $descripcion, $tipo_id_fk, $dimensiones, $precio]);

        return $db->lastInsertId();
    }


    /**
     * Elimina una impresion dado su id.
     */
    function delete($id) {
        $db = $this->conectarDB();
        $query = $db->prepare('DELETE FROM objeto WHERE id = ?');
        $query->execute([$id]);
    }

    

}
