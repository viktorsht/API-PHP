<?php
    if($acao == "" && $parametro == ""){
        echo json_encode(["ERRO" => "Caminho não encontrado!"]);
        exit;
    }
    if($acao == "adciona" && $parametro == ""){
        $sql = "INSERT INTO user (";
        $sql .= "";
        $contador=1;
        foreach(array_keys($_POST) as $indice){
            if(count($_POST) > $contador){
                $sql .= "{$indice},";
            }
            else{
                $sql .= "{$indice}";
            }
            $contador++;
        }
        $sql .= ") VALUES (";
        $contador=1;
        foreach(array_values($_POST) as $valor){
            if(count($_POST) > $contador){
                $sql .= "'{$valor}',";
            }
            else{
                $sql .= "'{$valor}'";
            }
            $contador++;
        }
        $sql .= ")";
        
        $db = DB::connect();
        $query = $db->prepare($sql);
        $save = $query->execute();
        if($save){
            echo json_encode(["dados" => 'Dados inseridos!']);
        }
        else{
            echo json_encode(["dados" => "Dados não inseridos"]);
        }
    }