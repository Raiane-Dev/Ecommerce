<section class="header-produto">
    <h1>Loja</h1>
</section>

<section class="filtro">

    <div class="filtro-head">
        <span>Mostrando 1-15 de 69 produtos</span>
    </div><!--filtro-head-->
   
    <div class="filtro-head">
        <span id="filtro"><i data-feather="list"></i></span>
        <span id="grade-3"><i data-feather="columns"></i></span>
        <span id="grade-5"><i data-feather="grid"></i></span>
    </div><!--filtro-head-->

</section><!--filtro-->

<div id="filtro-modal">
    <div class="filtro-modal-box">
        <div class="filtro-single">
            <input type="text">
        </div><!--filtro-single-->
        <div class="filtro-single">
            <input type="search">
        </div><!--filtro-single-->
        <div class="filtro-single">
            <input type="number">
        </div><!--filtro-single-->
    </div><!--filtro-modal-box-->
</div><!--filtro-modal-->

<section class="produtos">
    <div class="produtos-grade">

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

    </div><!--produtos-grade-->
</section>