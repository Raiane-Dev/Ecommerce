$(function(){
	$('a.btn-pagamento').click(function(e){
		e.preventDefault();
		$.ajax({
			url: 'ajax/finalizarPagamento.php'
		}).done(function(data){
			console.log(data);
			var isOpenLightBox = PagSeguroLightbox({
				code:data
			},{
				//Pagamento realizado com sucesso
				success: function(transactionCode){
					console.log('O usuário foi até o final');
				},
				abort: function(){
					console.log('Fechou a Janela');
				}
			});
		})
	})
})