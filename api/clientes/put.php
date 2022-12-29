<?php
    if($acao == "" && $parametro == ""){
        echo json_encode(["ERRO" => "Caminho não encontrado!"]);
        exit;
    }
    if($acao == "update" && $parametro == ""){
        echo json_encode(["ERRO" => "Informe parametro!"]);
        exit;
    }
    if($acao == "update" && $parametro != ""){
        array_shift($_POST);
        $sql = "UPDATE user SET ";
        $contador=1;
        foreach(array_keys($_POST) as $indice){
            if(count($_POST) > $contador){
                $sql .= "{$indice} = '{$_POST[$indice]}', ";
            }
            else{
                $sql .= "{$indice} = '{$_POST[$indice]}' ";
            }
            $contador++;
        }
        $sql .= "WHERE id={$parametro}";
        $db = DB::connect();
        $query = $db->prepare($sql);
        $save = $query->execute();
        if($save){
            echo json_encode(["dados" => 'Dados atualizados!']);
        }
        else{
            echo json_encode(["dados" => "Dados não atualizados"]);
        }
    }