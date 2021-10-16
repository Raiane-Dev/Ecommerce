<!DOCTYPE html>
<html>
<head>
    <title>Ecommerce</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>estilo/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
</head>
<body>
<header>
	<div class="head">
		<div class="head-um">
			<i data-feather="shopping-cart"></i><span> Free shipping for all products</span>
		</div><!--head-um-->
		<div class="head-dois">
			<ul>
				<li>Sobre</li>
				<li>FAQs</li>
				<li>Contato</li>
				<li><i data-feather="facebook"></i></li>
				<li><i data-feather="instagram"></i></li>
				<li><i data-feather="twitter"></i></li>
			</ul>
		</div><!--head-dois-->
	</div><!--head-->
	<div class="cabecalho">
		<div class="logomarca">
			<a href="<?php echo INCLUDE_PATH; ?>"><h2>Raiane Dev</h2></a>
		</div><!--logomarca-->
		<nav id="menuNav" class="menu">
			<ul class="swipe-front nav promote-layer">
				<li><a href="<?php echo INCLUDE_PATH ?>">Home</a></li>
				<li><a href="<?php echo INCLUDE_PATH ?>loja">Loja</a></li>
				<li><a href="javascript:void(0)">Carrinho</a></li>
				<li><a href="<?php echo INCLUDE_PATH ?>finalizar">Finalizar Pedido</a></li>
			</ul>
		</nav><!--menu-->
		<div class="atalhos">
			<i data-feather="search"></i>
			<a href="<?php echo INCLUDE_PATH ?>carrinho"><i data-feather="shopping-bag"></i><span class="carrinho-contador"><?php echo \modelos\ecommerceModelo::getTotalItemsCarrinho(); ?></span></a>
			<i data-feather="user"></i>
			<i data-feather="heart"></i>
			<i id="menu" data-feather="menu"></i>
		</div><!--atalhos--->
	</div><!--cabeçalho-->
</header>
