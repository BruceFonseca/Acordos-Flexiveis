<?php


$this->table->set_heading('Id Ocorrência', 'Planta','Assunto', 'Período', 'Integra' ,'Editar');


foreach ($status as $linha):
    $id = array('data'=> $linha->id_ocorrencia, 'class'=>'id-ocorrencia');
    $file = '<a target="_blank" href= "'. base_url().'uploads/'. $linha->dsc_file. '">'. $linha->dsc_file . '</a>';
    $this->table->add_row(
    $id, 
    $linha->dsc_planta, 
    $linha->dsc_assunto, 
    $linha->dsc_periodo, 
    $file, 
	'<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>');
endforeach;




echo '<div class="retrieve-table">';
echo '<h2> Interpretações Planta de '. $linha->dsc_planta .'</h2>';	

$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
$this->table->set_template($tmpl);
echo $this->table->generate();

echo '</div>';

?>


<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
$('.retrieve-table tr td span').click(function(){

	//encontra o id do usuário que será atualizado
	var id_ocorrencia = $(this).closest('tr').find('td[class="id-ocorrencia"]').text();
	var desc = 'Atualizar Interpretação';
	var controller = 'ocorrencia/update/'+ id_ocorrencia;
	var numTran = numTab();

	criarNovaAbaSemConteudo(controller, desc, numTran);

	 $.ajax({
            type      : 'post',
            url       : controller, //é o controller que receberá
            data      : 'id='+ id_ocorrencia,
            
            success: function( response ){
 					$('div[numtab="'+ numTran +'"]').append(response);
			}
        });

});



</script>

