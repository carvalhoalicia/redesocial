<?php

$rota = $_GET["rota"] ?? "";
$metodo = $_SERVER["REQUEST_METHOD"];

if ($rota === "usuario") {
    switch($metodo){
        case "POST":
            createUsuario($con);
            break;
        case "GET":
            readUsuario($con);
            break;
        case "PUT":
            updateUsuario($con);
            break;
        case "DELETE":
            deleteUsuario($con);
            break;
        default:
            teste();
    }
}
else if ($rota === "publicacao") {
    switch($metodo){
        case "POST":
            createPublicacao($con);
            break;
        case "GET":
            readPublicacao($con);
            break;
        case "PUT":
            updatePublicacao($con);
            break;
        case "DELETE":
            deletePublicacao($con);
        default:
            teste();
    }
}
else if ($rota === "curtida") {
    switch($metodo){
        case "POST":
            createCurtida($con);
            break;
        case "GET":
            readCurtida($con);
            break;
        case "PUT":
            updateCurtida($con);
            break;
        case "DELETE":
            deleteCurtida($con);
        default:
            teste();
    }
}