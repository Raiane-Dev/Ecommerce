<?php
    namespace controladores;

    class ecommerceController{

        public function home(){
            if(isset($_GET['addCart'])){
                $idProduto = (int)$_GET['addCart'];
                    if(isset($_SESSION['carrinho']) == false){
                        $_SESSION['carrinho'] = array();
                    }
                    if(isset($_SESSION['carrinho'][$idProduto]) == false){
                        //É a primeira vez que estou adicionando
                        //Então eu confiro se já existe uma $_SESSION com id desse produto $idProduto no carrinho. 
                        $_SESSION['carrinho'][$idProduto] = 1;
                    }else{
                        //Caso já exista eu só incremento
                        $_SESSION['carrinho'][$idProduto]++;
                    }
                    \Painel::redirect('carrinho');
            }
            include('views/home.php');
        }
        public function loja(){
            include('views/loja.php');
        }
        public function produto(){
            include('views/produto.php');
        }
    }
?>