
<div class='form'>
    
    <?php 
    if ($status->dsc_file) {
        echo 
        '
        <a target="_blank" href= "'. base_url().'uploads/'. $status->dsc_file . '">
        
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> Anexo
            </button>   
            
        </a>

        ';
    }

    
    echo 
        '
        <a target="_blank" href= "'. base_url().'assunto/print_page/'. $status->id_assunto . '">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir
            </button>
        </a>
        ';

 ?>
    <button type="button" class="btn btn-default" id="fechar-apontamento-componente">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Fechar
    </button>	

<?php

if($this->session->flashdata('excluirok')):
    echo '<p>'.$this->session->flashdata('excluirok').'</p>';
endif;

echo '<form class="ajax_form">';

echo form_fieldset('COE - Flexibilidade  <img id="" src=" '. base_url('img/sistema/logotipo/logo.png' ).'"/>');

echo  validation_errors('<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>','</div>');

    echo 
    '
        <div class="" ctr="assunto/imprimir/'. $status->id_assunto .'">
          <!-- Default panel contents -->
          <div class=""> '. $status->dsc_assunto . '</div>
          <div class="">
            <p>'.
                strip_tags(urldecode($status->dsc_conceito))
            .'</p>
          </div>
        </div>
    ';

echo form_fieldset_close();
echo form_close();

?>

</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>                    

    $('#fechar-apontamento-componente').on('click', function(){
        var name_file= $('input[name="atach-file"]').val();
		$('.apontamento').hide();
		$('.dados_componente').hide();
		$('.dados_componente .form').remove();
		// $('.dados_componente .body-table-abastecimento').remove();
		$('.dados_componente script').remove();
        $('.dsc_file').val(name_file);
	});
	
</script>