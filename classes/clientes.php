<?php

class Clientes{
    public function listarTodos(){
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
    public function listarUnico(){
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
    public function adcionar(){
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
    public function atualizar(){
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
    public function deletar(){
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
}