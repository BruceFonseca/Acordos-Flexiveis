<ul class="nav-acordos">

	<div class="menu-side-bar">
		<span class="glyphicon glyphicon-menu-hamburger btn-lg" aria-hidden="true"></span>
	</div>

<?php 

foreach ($menu_planta->result() as $menu): ?>
	<li class="list-plantas">
	    <a href="#" class="link-plantas" <?php echo 'ctr = "ocorrencia/retrieve_by_planta/'. $menu->id_planta. '"' ?>><?php echo ucwords($menu->dsc_planta) ?></a>
	</li>
<?php endforeach; ?>

</ul>
<script>

	$('.menu-side-bar span').on('click', function(){

		if($(this).width()==20){//se estiver recolhido, então expande
			$(this).css({
				width : '20px;',
				padding: '10px'
			});
			$('.menu-side-bar').css({
				width : '100%'
			});
			$('.nav-acordos').css({
				width : '15%'
			});
			$('.list-plantas').show();
			
		}else{//recolhe o menu
			$(this).css({
				width : '40px',
				padding: '10px'
			});
			$('.menu-side-bar').css({
				width : '40px'
			});
			$('.nav-acordos').css({
				width : '40px'
			});

			$('.list-plantas').hide();
		}

		//redimenciona a div conteudo
		resize_div_conteudo();
		// alert($('.conteudo-principal').height());
	});

	function resize_div_conteudo(){
		var w_nav =	$('.nav-acordos').width();
		var w_con = $(window).width() - w_nav;

		$('.nav.nav-tabs').css('width' , w_con);
		$('.conteudo-principal').css('width' , w_con);
	}

	$('.conteudo-principal').resize(function(){
	// $('.conteudo-principal').on('resize',function(){
		// alert('fsdgfagas');
	});

	$(".list-plantas a").click(function(){
		var controller = $(this).attr('ctr'); //este atributo será utilizado para trazer o controller da transaçãoque será utilizado para manupulkar abas (abrir fechar etc) as abas
		var desc = $(this).text() + '&nbsp'; // pega descrição do menu e utiliza nas abas que serão abertas

		//função que efetivamente criara a aba e respectivos conteudos
		criarNovaAba(controller, desc);

	});


</script>


