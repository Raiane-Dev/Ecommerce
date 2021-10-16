<section class="head-finalizar">
    <h2>Confira</h2>
</section><!--section-->

<section class="finalizar-pedido">
    <div class="finalizar-pedido">
        <div class="formulario-pedido">
            <h2>Detalhes de Faturamento</h2>
            <form method="post">
            <input type="text" name="primeiro-nome" placeholder="Primeiro Nome" />
            <input type="text" name="ultimo-nome" placeholder="Último Nome" />
            <input type="text" name="email" placeholder="Endereço de Email" />
            <input type="text" name="cpf" placeholder="CPF" />
            <input type="text" name="telefone" placeholder="Telefone" />
            <input type="text" name="cidade" placeholder="Cidade" />
            <input type="text" name="estado" placeholder="Estado" />
            <input type="text" name="cep" placeholder="CEP" />
            <input type="text" name="endereco" placeholder="Endereço" />
            </form>
        </div><!--formulario-pedido-->

        <div class="produtos-pedido">
            <h2>Seu Pedido</h2>
            <table>
                <tr>
                    <td>Nome do Produto</td>
                    <td>Quantidade</td>
                    <td>Valor</td>
                </tr>
                <?php
                    $itemsCarrinho = $_SESSION['carrinho'];
                    $total = 0;
                    foreach($itemsCarrinho as $key => $value){
                        $idProduto = $key;
                        $produto = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = $idProduto");
                        $produto->execute();
                        $produto = $produto->fetch();
                        $valor = $value * $produto['preco'];
                        $total+=$valor;
                ?>
                <tr>
                    <td><?php echo $produto['nome'] ?></td>
                    <td><?php echo $value ?></td>
                    <td><?php echo Painel::convertMoney($valor); ?></td>
                </tr>
                <?php } ?>
            </table>
            <h4>Subtotal <span><?php echo Painel::convertMoney($total); ?></span></h4>
            <a class="btn-pagamento" href="">Pagar Agora</a>
        </div><!--produtos-pedido-->
</div><!--finalizar-pedido-->
</section><!--finalizar-pedido-->

<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>