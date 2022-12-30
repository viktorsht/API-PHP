<?php

class Rotas{
    
    private $listaRotas = [''];
    private $listaCallback = [''];
    private $listaProtecao = [''];

    
    public function add($metodo, $rota, $callback, $protecao)
    {
        $this->listaRotas[] = strtoupper($metodo).':'.$rota;
        $this->listaCallback[] = $callback;
        $this->listaProtecao[] = $protecao;

        return $this;
    }
    public function ir($rota){

        $param = "";
        $callback = "";
        $protecao = "";
        $metodoServer = $_SERVER['REQUEST_METHOD'];
        $metodoServer = isset($_POST['_method']) ? $_POST['_method'] : $metodoServer;
        $rota = $metodoServer.":/".$rota;
        var_dump($rota);

        if(substr_count($rota,"/") >= 3){
            $param = substr($rota,strrpos($rota,"/")+1);
            $rota = substr($rota,0,strrpos($rota,"/"))."/[PARAMETRO]";
            var_dump($param);
        }

        $indice = array_search($rota, $this->listaRotas);
        if($indice > 0){
            $callback = explode("::",$this->listaCallback[$indice]);
            $protecao = $this->listaProtecao[$indice];
        }

        $class = isset($callback[0]) ? $callback[0] : '';
        $method = isset($callback[1]) ? $callback[1] : '';

        if(class_exists($class)){
            if(method_exists($class,$method)){
                $instanciaClasse = new $class();
                if($protecao){
                    $verificacao = new Usuarios();
                    if($verificacao->verificar()){
                        return call_user_func_array(array($instanciaClasse, $method),array($param));
                    }
                }
                else{
                    return call_user_func_array(array($instanciaClasse, $method),array($param));
                }
            }
            else{var_dump(" ROTA NÃO EXISTE!");}
        }
        else{var_dump(" ROTA NÃO EXISTE!");}
    }
}