<?php
    if($acao == "" && $parametro == ""){
        echo json_encode(["ERRO" => "Caminho não encontrado!"]);
        exit;
    }
    if($acao == "lista" && $parametro == ""){

        $db = DB::connect();
        $query = $db->prepare("SELECT * FROM user ORDER BY nome");
        $query->execute();
        $object = $query->fetchAll(PDO::FETCH_ASSOC);
        if($object){
            echo json_encode(["dados" => $object]);
        }
        else{
            echo json_encode(["dados" => "não encontrado"]);
        }
    }
    if($acao == "lista" && $parametro != ""){

        $db = DB::connect();
        $query = $db->prepare("SELECT * FROM user WHERE id={$parametro}");
        $query->execute();
        $object = $query->fetchObject();
        if($object){
            echo json_encode(["dados" => $object]);
        }
        else{
            echo json_encode(["dados" => "não encontrado"]);
        }
    }