<?php

function inserirPublicacao($con, $dados) {
    $stmt = $con->prepare(
        "INSERT INTO PUBLICACAO (id_usuario, legenda, imagem_url)
        VALUES (?, ?, ?) "
    );
    $stmt->execute([ $dados["id_usuario"],
                     $dados["legenda"],
                     $dados["imagem_url"],]);
    return $con->lastInsertId();
}

function listarPublicacoes($con){
    $stmt = $con->query("SELECT * FROM publicacoes");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function atualizarPublicacao($con, $id, $dados) {
    $stmt = $con->prepare(
        "UPDATE publicacoes SET legenda = ?, imagem_url = ? WHERE id_publicacao = ?"
    );
    $stmt->execute([$dados["legenda"],
                    $dados["imagem_url"],
                    $id]);
}

function removerPublicacao($con, $id) {
    $stmt = $con->prepare(
        "DELETE FROM publicacoes WHERE id_publicacao = ?"
    );
    $stmt->execute([$id]);
}