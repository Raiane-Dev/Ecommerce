$(function(){

	var curSlide = 0;
	var maxSlide = $('.banner-single').length - 1;
	var delay = 3;


	initSlider();
	changeSlide();


	function initSlider(){
		$('.banner-single').css('opacity','0');
		$('.banner-single').eq(0).css('opacity','1');
		for(var i = 0; i < maxSlide+1; i++){
			var content = $('.bullets').html();
			if(i == 0)
				content+='<span class="active-slider"></span>';
			else
				content+='<span></span>';
			$('.bullets').html(content);
		}
	}

	function changeSlide(){
		setInterval(function(){
			$('.banner-single').eq(curSlide).animate({'opacity':'0'},2000);
			curSlide++;
			if(curSlide > maxSlide)
				curSlide = 0;
			$('.banner-single').eq(curSlide).animate({'opacity':'1'},2000);
			//Trocar bullets da navegacao do slider!
			$('.bullets span').removeClass('active-slider');
			$('.bullets span').eq(curSlide).addClass('active-slider');
		},delay * 1000);
	}


	$('body').on('click','.bullets span',function(){
		var currentBullet = $(this);
		$('.banner-single').eq(curSlide).animate({'opacity':'0'},2000);
		curSlide = currentBullet.index();
		$('.banner-single').eq(curSlide).animate({'opacity':'1'},2000);
		$('.bullets span').removeClass('active-slider');
		currentBullet.addClass('active-slider');
	});

	const botaoFiltro = document.getElementById('filtro');
	const filtro = document.getElementById('filtro-modal');
	const grade3 = document.getElementById('grade-3');
	const grade5 = document.getElementById('grade-5');
	const gradeProdutos = document.querySelector('.produtos-grade');

	botaoFiltro.addEventListener("click", (e)=>{
		filtro.style.display = 'block';
	});

	grade3.addEventListener("click", (e)=>{
		gradeProdutos.style.gridTemplateColumns = '30% 30% 30%';
	});

	grade5.addEventListener("click", (e)=>{
		gradeProdutos.style.gridTemplateColumns = '18% 18% 18% 18% 18%';
	});


	if(window.matchMedia("(max-width: 780px)").matches) {
		grade3.addEventListener("click", (e)=>{
			gradeProdutos.style.gridTemplateColumns = '48% 48%';
		});
	
		grade5.addEventListener("click", (e)=>{
			gradeProdutos.style.gridTemplateColumns = '30% 30% 30%';
		});
    }
})

