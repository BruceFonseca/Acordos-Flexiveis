<ul class="nav-acordos">

	<div class="menu-side-bar">
		<span class="glyphicon glyphicon-menu-hamburger btn-lg" aria-hidden="true"></span>
	</div>

	
<?php 

foreach ($menu_planta->result() as $menu): ?>
	<li class="list-plantas">
	    <a href="#" class="link-plantas"><?php echo ucwords($menu->dsc_planta) ?><span class="caret"></span></a>
	    <ul class="">
	        <?php foreach ($submenu_periodo->result() as $submenu): ?>
	            <?php if($menu->id_planta == $submenu->id_planta):?>
	                <li>
                        <ul class="list-periodos">
	                    <a href="#"  ctr= '<?php echo $submenu->controller ?>'><?php echo ucwords($submenu->dsc_periodo) ?><span class="caret"></span></a>
					        <?php foreach ($submenu_ocorrencia->result() as $sub_submenu): ?>
					            <?php if($submenu->id_planta == $sub_submenu->id_planta and  $submenu->id_periodo == $sub_submenu->id_periodo ):?>
					                <li>
					                    <a href="#"  ctr= '<?php echo $submenu->controller ?>'><?php echo ucwords($sub_submenu->dsc_assunto) ?></a>
					                    <!-- <li role="separator" class="divider"></li> -->
					                </li>
					            <?php endif;?>
					        <?php endforeach; ?>
					    </ul>
	                    <!-- <li role="separator" class="divider"></li> -->
	                </li>
	            <?php endif;?>
	        <?php endforeach; ?>
	    </ul>
	</li>
<?php endforeach; ?>

</ul>

<script>
	$('.list-periodos li').hide();
	$('.list-plantas ul').hide();



	$('.list-periodos').on('click', function(){
		// alert('agaga');
		// $(this).toggle();
		$('li' , this).toggle();
	});

	$('.link-plantas').on('click', function(){
		pai = $(this).parent();

		$('ul' , pai).toggle();
	});

	$( window ).resize(function() {
  		$('.nav-acordos').css('height','100%');
	});

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
		}

		//redimenciona a div conteudo
		resize_div_conteudo();
	});

	function resize_div_conteudo(){
		var w_nav =	$('.nav-acordos').width();
		var w_con = $(window).width() - w_nav - 1;

		$('.nav.nav-tabs').css('width' , w_con);
		$('.conteudo-principal').css('width' , w_con);
	}


	// $('.list-plantas').on('click', function(){
	// 	// alert('agaga');
	// 	// $(this).toggle();
	// 	$('ul li' , this).toggle();
	// });

	// $('.list-periodos').on('click', function(){
	// 	// alert('agaga');
	// 	// $(this).toggle();
	// 	$('.list-periodos ul li a' , this).toggle();
	// });


	// $('.list-acordos').on('click', function(){
	// 	// alert('agaga');
	// 	// $(this).toggle();
	// 	$('.list-plantas li' , this).toggle();
	// });

</script>