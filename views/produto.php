<?php
    $id = (int)$_GET['id'];
    $produtoInfo = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ?");
    $produtoInfo->execute(array($id));
    $produtoInfo = $produtoInfo->fetchAll();
    foreach($produtoInfo as $key => $value){
?>

<section class="produto">
    <div class="produto">
        <div class="imagem-produto">
            <?php 
            $imagem = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
            $imagem->execute();
            $imagem = $imagem->fetchAll();
            foreach($imagem as $key => $value2){
            ?>
            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value2['imagem']; ?>" />
            <?php } ?>
        </div><!--imagem-produto-->
        <div class="descricao-produto">
            <h1><?php echo $value['nome']; ?></h1>
            <h3><?php echo $value['preco']; ?></h3>
            <p><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i> (2 avaliações)</p>
            <p><?php echo $value['descricao']; ?></p>
            <div class="atributos">
                <form>
                <input type="number" value="1" />
                <a class="adicionar" href="<?php echo INCLUDE_PATH ?>?addCart=<?php echo $value['id'] ?>">Adicionar ao Carrinho</a>
                </form>
            </div><!--atributos-->
            <div class="divisao"></div>
            <p class="atributo">Largura: <span><?php echo $value['largura']; ?>cm</span></p>
            <p class="atributo">Altura: <span><?php echo $value['altura']; ?></span></p>
            <p class="atributo">Comprimento: <span><?php echo $value['comprimento']; ?></span></p>
        </div><!--descricao-produto-->
    </div><!--produto-->
</section><!--produto-->

<section class="info-produto">
    <nav class="tabs">
        <ul>
            <li id="tab-descricao">Descrição</li>
            <li id="tab-avaliacao">Avaliação</li>
        </ul>
        <ul>
            <li id="conteudo-descricao"><?php echo $value['descricao']; ?></li>

            <li id="conteudo-avaliacao">

                <div class="respostas-single">
                    <div class="box-respostas">
                        <h6>Nome da pessoa <span><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i><i data-feather="star"></i></span></h6>
                        <p>Free shipping on orders over 150€ within Europe and North America. Place your order today and receive it within 48 hours. And now, free and easy returns within Europe.</p>
                    </div><!--box-resposta-->
                </div><!--resposta-single-->
                <div class="comentar">
                    <form method="post">
                        <input type="text" name="nome" placeholder="Nome" />
                        <input type="text" name="email" placeholder="Email" />
                        <textarea name="mensagem"></textarea>
                        <input type="submit" name="comentar" value="Enviar">
                    </form>
                </div><!--comentar-->

            </li>
        </ul>
    </nav><!--tabs-->
</section><!--info-produto-->

<div class="clear"></clear>

<section class="semelhantes">
    <h2>Produtos relacionados</h2>
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
<?php } ?>
