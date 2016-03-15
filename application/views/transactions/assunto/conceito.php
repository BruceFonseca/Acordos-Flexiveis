<div class="container-conceito">
<?php

if($this->session->flashdata('excluirok')):
    echo '<p>'.$this->session->flashdata('excluirok').'</p>';
endif;

echo '<form method="post" action="" class="ajax_form">';

echo form_fieldset('...');

echo  validation_errors('<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>','</div>');

foreach ($status as $linha):
	
	echo 
	'
		<div class="panel panel-default conceitos" ctr="assunto/imprimir/'. $linha->id_assunto .'">
		  <!-- Default panel contents -->
		  <div class="panel-heading"> '. $linha->dsc_assunto . '</div>
		  <div class="panel-body">
		    <p>'.
		    	(urldecode($linha->dsc_conceito))
		    .'</p>
		  </div>
		</div>
	';
endforeach;

echo form_fieldset_close();
echo form_close();

?>



<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>

$('.panel.panel-default.conceitos').on('click', function(){
	    
    var controller = $(this).attr('ctr');
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
$('#Conceitos span').remove();

</script>

</div>