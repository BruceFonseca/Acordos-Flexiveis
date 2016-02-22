<?php


$this->table->set_heading('Id Ocorrência','Assunto', 'Planta', 'Período', 'Descrição Acordo', 'Arquivo','Editar');


foreach ($status as $linha):
	$arquivo = '<a target="_blank" href= "'. base_url().'uploads/'. $linha->dsc_file . '">'.$linha->dsc_file.'</a>';
    $this->table->add_row(
    $linha->id_ocorrencia, 
    $linha->dsc_assunto, 
    $linha->dsc_planta, 
    $linha->dsc_periodo, 
    $linha->dsc_resumo, 
    $arquivo,
	'<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>');
endforeach;




echo '<div class="retrieve-table">';
echo '<h2>Administrar Acordos</h2>';	

$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
$this->table->set_template($tmpl);
echo $this->table->generate();

echo '</div>';

?>


<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
$('.retrieve-periodo tr td span').click(function(){

	//encontra o id do usuário que será atualizado
	var id_periodo = $(this).closest('tr').find('td[class="id-periodo"]').text();
	var desc = 'Atualizar periodo';
	var controller = 'periodo/update/'+ id_periodo;
	var numTran = numTab();

	criarNovaAbaSemConteudo(controller, desc, numTran);

	 $.ajax({
            type      : 'post',
            url       : controller, //é o controller que receberá
            data      : 'id='+ id_periodo,
            
            success: function( response ){
 					$('div[numtab="'+ numTran +'"]').append(response);
			}
        });

});



</script>

