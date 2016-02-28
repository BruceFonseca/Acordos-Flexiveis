<div class='form'>
	

	<?php

		echo '<form method="post" action="" class="ajax_form">';

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
		echo form_textarea(array('name'=>'dsc_conceito', 'class'=>'form-control', 'id'=>"txtEditor"),  set_value('dsc_conceito',$query->dsc_conceito))."<br>";

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


		$('.ajax_form').submit(function(){
				
			// var dados = $( this ).serialize();
			var dados = $( this ).serialize();

			$.ajax({
				type: "POST",
				url: "assunto/update/"+ id_assunto,
				data: dados,
				success: function( data )
				{
					$('div[numtab="'+ numTran +'"] div').remove();
					$('div[numtab="'+ numTran +'"]').append(data);
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
		$("#txtEditor").Editor();   

		var txt = decodeURIComponent($('.form-control').val()); 
		$('.Editor-editor').append(txt);

		$('.Editor-editor').keyup( function(){

			var txt = $('.Editor-editor').html();
			$('textarea.form-control').text('');
			$('.form-control').append(txt);

		// alert($(this).text());
	});
	});
        
</script>