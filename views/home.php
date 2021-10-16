<section class="banner">
        <div id="slider" class="slider">
            <img src="http://landing.engotheme.com/html/zoa/demo/img/slide/slider-1-home-1.png" />
        </div><!--banner-->
</section><!--banner-->

<section class="colecao-produtos">
    <div class="colecao-principal">
        <img src="http://landing.engotheme.com/html/zoa/demo/img/home1/trend.png" />
    </div><!--colecao-principal-->
    <div class="produtos-colecao">

    <?php
    $items = \modelos\ecommerceModelo::getLojaItems();
    foreach($items as $key => $value){
        $imagem = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id]");
        $imagem->execute();
        $imagem = $imagem->fetch()['imagem'];
    ?>
        <div class="produto-single">
            <div class="single-imagem">
                <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagem ?>" />
            <div class="compre">
                <div class="icones">
                <a class="cart" href="<?php echo INCLUDE_PATH ?>/?addCart=<?php echo $value['id'] ?>"><i data-feather="shopping-bag"></i></a>
                <a href="<?php INCLUDE_PATH ?>loja/produto?id=<?php echo $value['id']; ?>"><i data-feather="heart"></i></a>
                <a href="<?php echo INCLUDE_PATH ?>loja/produto/?id=<?php echo $value['id'] ?>"><i data-feather="eye"></i></a>
                </div>
            </div>
            </div>
                <div class="single-descricao">
                <h4><?php echo $value['nome']; ?></h4>
                <p>R$<?php echo Painel::convertMoney($value['preco']) ?></p>
            </div>
        </div><!--produto-single-->
    <?php  } ?>

    </div><!--produtos-colecao-->
</section><!--colecao-produtos-->

<section class="oferta">
    <div class="imagem-oferta">
        <div class="box-borda">
        <div class="box-oferta">
            <h4>TODA A COLEÇÃO COM DESCONTE ATÉ</h4>
            <h2>-50%<h2>
        </div><!--box-oferta-->
        </div><!--box-oferta-->
    </div><!--imagem-oferta-->
</section><!--oferta-->

<section class="assinantes">
    <div class="assinantes">
        <div class="assinantes-texto">
        <i data-feather="arrow-right"></i><span>entrar em contato</span>
        <p>Inscreva-se para obter as últimas notícias e promoções (venda de 35%)</p>
        </div><!--assinantes-texto-->
        <div class="assine-aqui">
            <form method="post">
                <input type="email" name="email" placeholder="Seu melhor email" />
                <input type="submit" name="acao" />
            </form>
        </div>
    </div><!--assinantes-->
</section><!--assinantes-->

<section class="marketing">
    <div class="marketing">

        <div class="single-marketing">
            <i data-feather="truck"></i> <span>Envio Grátis</span>
            <p>em todos os pedidos acima de $ 49,00</p>
        </div><!--single-marketing-->

        <div class="single-marketing">
            <i data-feather="refresh-cw"></i> <span>15 dias de retorno</span>
            <p>garantia de devolução de dinheiro</p>
        </div><!--single-marketing-->

        <div class="single-marketing">
            <i data-feather="credit-card"></i> <span>Check-out seguro</span>
            <p>100% protegido por Paypal</p>
        </div><!--single-marketing-->

        <div class="single-marketing">
            <i data-feather="tag"></i> <span>Garantia 100% grátis</span>
            <p>garantia de devolução do dinheiro</p>
        </div><!--single-marketing-->

    </div><!--marketing-->
</section>