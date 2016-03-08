
<div class='form'>
	

<?php

// pd($assuntos_disp);

for($i=0; $i < count($dados_assunto); $i++){ 
    $id = $dados_assunto[$i]['id_assunto'];
    $assuntos[$id] = $dados_assunto[$i]['dsc_assunto'];
}

for($i=0; $i < count($dados_planta); $i++){ 
    $id = $dados_planta[$i]['id_planta'];
    $plantas[$id] = $dados_planta[$i]['dsc_planta'];
}

for($i=0; $i < count($dados_periodo); $i++){ 
    $id = $dados_periodo[$i]['id_periodo'];
    $periodos[$id] = $dados_periodo[$i]['dsc_periodo'];
}

echo '<form method="post" action="" class="ajax_form_ocorrencia">';

echo form_fieldset('Adicionar interpretação');

if($flash_data):
	echo $flash_data;
endif;

echo '<div class="set_form">';

	echo '<div class="set_com">';
		echo form_label('Planta')."<br>";
		echo form_dropdown('id_planta',  $plantas);
	echo '</div>';

	echo '<div class="set_com">';
		echo form_label('Período')."<br>";
		echo form_dropdown('id_periodo',  $periodos);
	echo '</div>';
echo '</div>';

echo '<div class="set_assunto">';
	echo form_label('Acordo')."<br>";
	echo form_dropdown('id_assunto',  $assuntos);
echo '</div>';

echo '
 	<div class="set_assunto">
	<label>Assuntos Disponíveis</label>
	<br>
	<ul id="sortable1" class="connectedSortable list-group">';

  		for($i=0; $i < count($assuntos_disp); $i++){ 
		    $id = $assuntos_disp[$i]['id_tratado'];
		    $tratado = $assuntos_disp[$i]['dsc_tratado'];

		    echo 
		    '<li class="ui-state-default list-group-item" id="'. $id .'">
		    <span class="id">'. $id .'</span>
		  	<span class="name">'. $tratado .'</span>
		  	<a href="#"><span class="file">file.pdf</span></a>
		  	<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>

		    </li>';
		}
echo '</ul>';
 
 
 	echo '<label>Assuntos Utilizados</label>
	<ul id="sortable2" class="connectedSortable list-group">
	  
	</ul>

	</div>
	 ';
	 // <li class="ui-state-highlight list-group-item" id="1">
	 //  	<span class="id">ID</span>
	 //  	<span class="name">13º Décimo terceiro</span>
	 //  	<span class="file">file.pdf</span>
	 //  	<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
	 //  </li>

	 //  <li class="ui-state-highlight list-group-item" id="2">
	 //  	<span class="id">ID</span>
	 //  	<span class="name">PPR</span>
	 //  	<span class="file">file.pdf</span>
	 //  	<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
	 //  </li>
	 //  <li class="ui-state-highlight list-group-item" id="3">
	 //  	<span class="id">ID</span>
	 //  	<span class="name">PLM</span>
	 //  	<span class="file">file.pdf</span>
	 //  	<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
	 //  </li>
	 //  <li class="ui-state-highlight list-group-item" id="4>
	 //  	<span class="id">ID</span>
	 //  	<span class="name">Bolsa Idiomas</span>
	 //  	<span class="file">file.pdf</span>
	 //  	<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
	 //  </li>

	// echo form_label('Descrição da interpretação');
	// echo form_textarea(array('name'=>'dsc_resumo', 'class'=>'form-control'),  '')."<br>";

// echo form_label('Anexar arquivo');
// echo "<span><a href='#' class='atach-file'>Anexar arquivo </a> </span><span class='glyphicon glyphicon-trash' aria-hidden='true'></span>";

// echo form_input(array('name'=>'dsc_file', 'class'=>'dsc_file'),  '')."<br>";

echo form_button(array('name'=>'cadastrar', 'class'=>'submit', 'id'=>'submit','content'=>'Cadastrar', 'type'=>'submit'))."<br>";

echo form_fieldset_close();
echo form_close();

?>
</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
	
	$(".submit").click(function(event){
		// event.preventDefault();
	
		var dadosAssuntos = {};
		
		$("#sortable2 li").each(function(){
            var self = $(this);
            	dadosAssuntos[self.attr('id')] = {            
                id : self.find('.id').text(),
                name  : self.find('.name').text(),
                file  : self.find('.file').text()
            };            
        });

		var id_assunto = $("select[name='id_assunto']").val();
		var id_planta = $("select[name='id_planta']").val();
		var id_periodo = $("select[name='id_periodo']").val();
		// var dsc_file = $("input[name='dsc_file']").val();
		// var dsc_resumo = $("textarea[name='dsc_resumo']").text();
		// alert(id_periodo);

		dadosAssuntos['dados_acordo'] = {            
                id_assunto  : id_assunto,
                id_planta   : id_planta,
                id_periodo  : id_periodo
            };

		var dados = JSON.stringify(dadosAssuntos);

		var numtab = $(this).closest("div.conteudo").attr("numtab");
		
		$('.ajax_form_ocorrencia').submit(function(){

			$.ajax({
				type: "POST",
				url: "ocorrencia/create",
				data: 'data=' + dados,
				success: function( data )
				{
					$('div[numtab="'+ numtab +'"] div').remove();
					$('div[numtab="'+ numtab +'"]').append(data);
				}
			});

			return false;
		});
	});

	$('.glyphicon-trash').on('click', function(){
		$("input[name='dsc_file']").val( '' );
	});


	$('.atach-file').on('click', function(){
	    
	    var controller = 'ocorrencia/carregar';

	     $.ajax({
	            type      : 'post',
	            url       : controller, //é o controller que receberá
	            
	            success: function( response ){
	                $('.apontamento').show();

	                $('.dados_componente').css( "display", "table" );
	                $('.dados_componente').css( "position", "absolute" );
	                $('.dados_componente').append(response);
	            }
	        });
	});

	$(function() {
	    $( "#sortable1, #sortable2" ).sortable(
	    {
	      	connectWith: ".connectedSortable",
	      	start: function(event, ui) {
		        // alert('start');
		    },
			update: function (event, ui) {
					// alert('update');
			    }
	    }).disableSelection();
  	});


</script>



