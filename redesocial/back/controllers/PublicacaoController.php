<?php

require_once __DIR__ . "/../models/PublicacaoModel.php";

function teste(){
    echo json_encode([
        "mensagem" => "Back-end respodendo com sucesso!"
    ]);
    exit;
}

function receberDadosPublicacao(){
    $dados = json_decode(file_get_contents("php://input"), true);

    if(!is_array($dados)){
        http_response_code(400);
        echo json_encode([
            "erro" => "Envie um obejto JSON com os dados da publicação!"
        ]);
        return null;
    }
    foreach(["legenda", "imagem_url"] as $campo){
        if(!isset($dados[$campo]) ||
        !is_string($dados[$campo]) ||
        trim($dados[$campo]) === ""){
            http_response_code(400);
            echo json_encode([
                "erro" => "O campo $campo é obrigatório e deve ser um texto não vazio."
            ]);
            return null;
        }
    }

    return $dados;
}

function receberIdPublicacao(){
    $id = filter_var($_GET["id"] ?? null, FILTER_VALIDATE_INT,
        ["options" => ["min_range" => 1]]);
    if($id === false){
        http_response_code(400);
        echo json_encode([
            "erro" => "Informe um id de publicação válido."
        ]);
        return null;
    }
    return $id;
}

function createPublicacao($con){
    $dados = receberDadosPublicacao();
    if ($dados === null){
        return;
    }
    $id = inserirPublicacao($con,$dados);
    http_response_code(201);
    echo json_encode([
        "mensagem" => "Publicação criada com sucesso!", "id" => $id
        ]);
}

function readPublicacao($con){
    echo json_encode(listarPublicacao($con));
}

function updatePublicacao($con){
    $id = receberIdPublicacao();
    if ($id === null){
        return;
    }
    $dados = receberDadosPublicacao();
    if ($dados === null){
        return;
    }
    atualizarPublicacao($con, $id, $dados);
    echo json_encode([
        "mensagem" => "Publicação atualizada com sucesso!"
    ]);
}

function deletePublicacao($con){
    $id = receberIdPublicacao();
    if ($id === null){
        return;
    }
    removerPublicacao($con, $id);
    echo json_encode([
        "mensagem" => "Publicação removida com sucesso!"
    ]);
}