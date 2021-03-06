<div class='form'>
	

	<?php

		echo '<form method="post" action="" class="ajax_form_update">';

		echo form_fieldset('Atualizar Assunto');
			
		if($flash_data):
	        echo $flash_data;
	    endif;

		echo  validation_errors('<div class="alert alert-danger" role="alert">
	  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	  <span class="sr-only">Error:</span>','</div>');

		echo '<div class="set_assunto">';
		echo form_label('Código do Acordo')."<br>";
		echo form_input(array('name'=>'id_assunto', 'class'=>'id-assunto'),  set_value('id', $query->id_assunto),'bloqued')."<br>";

		
		echo form_label('Título do Acordo');
		echo form_input(array('name'=>'dsc_assunto'),  set_value('dsc_assunto',$query->dsc_assunto))."<br>";
		echo '</div>';

		echo form_label('Conceito do Acordo')."<br>";
		echo form_textarea(array('name'=>'dsc_conceito', 'class'=>'form-control-update txtEditor', 'id'=>""),  set_value('dsc_conceito',$query->dsc_conceito))."<br>";

		echo "<span><a href='#' class='atach-file'>Anexar arquivo </a> </span><span class='glyphicon glyphicon-trash' aria-hidden='true'></span>";

		echo form_input(array('name'=>'dsc_file', 'class'=>'dsc_file'),  set_value('dsc_file',$query->dsc_file))."<br>";

		echo form_button(array('name'=>'cadastrar', 'class'=>'submit', 'id'=>'submit','content'=>'Salvar', 'type'=>'submit'));

		echo form_fieldset_close();
		echo form_close();

	?>

</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>

	$(".submit").click(function(){

		var id_assunto = $(this).closest('fieldset').find('input.id-assunto').val();
		var thisTab    = $(this).closest('.conteudo').attr('numtab'); //numero da tab atual

		$('.ajax_form_update').submit(function(){
				
			var dados = $( this ).serialize();

			$.ajax({
				type: "POST",
				url: "assunto/update/"+ id_assunto,
				data: dados,
				success: function( data )
				{
					$('div[numtab="'+ thisTab +'"] div').remove();
					$('div[numtab="'+ thisTab +'"]').append(data);
					$('body,html').animate({scrollTop:0},600);
					update_container_conceito();
				}
			});

			return false;
		});
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

	$(document).ready( function() {
		$(".txtEditor").Editor();   

		var txt = decodeURIComponent($('.form-control-update').val());
		var thisTab = $(".txtEditor").closest('.conteudo').attr('numtab'); //numero da tab atual
		// alert(thisTab);
		$('div[numtab="'+ thisTab +'"] .Editor-editor').append(txt);
		// $('.Editor-editor').append(txt);

		$('.Editor-editor').keyup( function(){
			moveToTextArea();
		});

		$('.Editor-editor').click( function(){
				moveToTextArea();
		});
		
		$('.row-fluid').click( function(){
				moveToTextArea();
		});
	});
	


	function moveToTextArea(){
		var txt = encodeURIComponent($('.Editor-editor').html());
		$('textarea.form-control-update').text('');
		$('.form-control-update').append(txt);
	}
        
</script>