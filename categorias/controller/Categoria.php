<?php

    require_once("../config/conexion.php");
    require_once("../models/Categoria.php");

    // instancia de la clase categoria
    $categoria = new Categoria();

    switch ($_GET["opcion"]) {
        case "GetAll":
            $datos = $categoria->get_categoria();
            echo json_encode($datos);
            break;
        
        
    }