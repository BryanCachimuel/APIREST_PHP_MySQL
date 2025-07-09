<?php

    class Categoria extends Conectar {
       
        public function get_categoria() {
             $conectar = parent::Conexion();
             parent::set_names();
             $sql = "SELECT * FROM tm_categoria WHERE cat_estado=1";
             $sql = $conectar->prepare($sql);
             $sql->execute();
             $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
             return $resultado;
        }

        public function get_categoria_por_id($cat_id) {
             $conectar = parent::Conexion();
             parent::set_names();
             $sql = "SELECT * FROM tm_categoria WHERE cat_estado=1 AND cat_id = ?";
             $sql = $conectar->prepare($sql);
             $sql->bindValue(1, $cat_id);
             $sql->execute();
             $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
             return $resultado;
        }

        public function insert_categoria($cat_nombre, $cat_observacion) {
             $conectar = parent::Conexion();
             parent::set_names();
             $sql = "INSERT INTO tm_categoria(cat_id,cat_nombre,cat_observacion,cat_estado) VALUES(NULL,?,?,'1')";
             $sql = $conectar->prepare($sql);
             $sql->bindValue(1, $cat_nombre);
             $sql->bindValue(2, $cat_observacion);
             $sql->execute();
             $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
             return $resultado;
        }

    }