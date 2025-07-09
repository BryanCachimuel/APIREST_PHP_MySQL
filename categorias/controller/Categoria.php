<?php

    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/Categoria.php");

    // instancia de la clase categoria
    $categoria = new Categoria();

    $body = json_decode(file_get_contents("php://input"), true);

    switch ($_GET["opcion"]) {
        case "GetAll":
            $datos = $categoria->get_categoria();
            echo json_encode($datos);
            break;
        
        case "GetId":
            $datos = $categoria->get_categoria_por_id($body["cat_id"]);
            echo json_encode($datos);
            break;

        case "Insert":
            $datos = $categoria->insert_categoria($body["cat_nombre"], $body["cat_observacion"]);
            echo json_encode("Registro Correcto");
            break;

        case "Update":
            $datos = $categoria->update_categoria($body["cat_nombre"], $body["cat_observacion"], $body["cat_id"]);
            echo json_encode("Registro Actualizado Correctamente");
            break;
        
        
    }