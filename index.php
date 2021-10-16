<?php

    include('config.php');
    include('views/modelos/header.php');

    $ecommerceController = new \controladores\ecommerceController();
    $finalizarController = new \controladores\finalizarController();

    Router::get('/',function() use ($ecommerceController){
        $ecommerceController->home();
    });

    Router::get('/loja',function() use ($ecommerceController){
        $ecommerceController->loja();
    });

    Router::get('/?/?',function($arr) use ($ecommerceController){
        $ecommerceController->produto($arr);
    });

    Router::get('/finalizar',function() use ($finalizarController){
        $finalizarController->index();
    });

    Router::get('/carrinho', function() use ($finalizarController){
        $finalizarController->carrinho();
    });

    if(Router::isExecuted() == false){
        include('views/404.php');
        die();
    }
    include('views/modelos/footer.php');

?>