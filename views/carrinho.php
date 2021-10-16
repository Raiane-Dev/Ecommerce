<section class="carrinho">
    <table>
        <tr>
            <td>Imagem</td>
            <td>Nome</td>
            <td>Valor</td>
        </tr>
        <?php
            $itemsCarrinho = $_SESSION['carrinho'];
            $total = 0;
            foreach($itemsCarrinho as $key => $value){
                $idProduto = $key;
                $produto = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE  id = $idProduto");
                $produto->execute();
                $produto = $produto->fetch();
                $valor = $value * $produto['preco'];
                $total+=$valor;
                $imagem = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $idProduto");
                $imagem->execute();
                $imagem = $imagem->fetch()['imagem'];
        ?>
        <tr>
            <td><img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagem; ?>" /></td>
            <td><?php echo $produto['nome']; ?></td>
            <td><?php echo Painel::convertMoney($valor); ?></td>
        </tr>
        <?php } ?>
    </table>
</section>

<section class="total-produtos">
    <div class="total-produtos">
        <div class="calcular-frete">
            <h4>Calcular Frete</h4>
            <form>
                <input type="text" placeholder="Código Postal" />
                <input type="submit" value="Calcular" />
            </form>
        </div>
        <div class="info-pagamento">
            <h4>Subtotal<span><?php echo Painel::convertMoney($total); ?></h4></span>
            <a href="<?php echo INCLUDE_PATH?>finalizar">Finalizar Compra</a>
        </div>
    </div>
</section>