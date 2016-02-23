<ul class="nav-acordos">

<?php foreach ($menu_planta->result() as $menu): ?>
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