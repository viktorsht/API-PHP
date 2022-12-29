<?php
    if($acao == "" && $parametro == ""){
        echo json_encode(["ERRO" => "Caminho não encontrado!"]);
        exit;
    }
    if($acao == "delete" && $parametro == ""){
        echo json_encode(["ERRO" => "Informe parametro!"]);
        exit;
    }
    if($acao == "delete" && $parametro != ""){
        $sql = "DELETE FROM user WHERE id={$parametro}";
        $db = DB::connect();
        $query = $db->prepare($sql);
        $save = $query->execute();
        if($save){
            echo json_encode(["dados" => 'Removido!']);
        }
        else{
            echo json_encode(["ERRO" => "Não removido"]);
        }
    }