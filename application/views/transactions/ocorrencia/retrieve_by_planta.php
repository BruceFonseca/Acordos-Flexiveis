<?php
// pd($interpretacao);
echo '<div class="retrieve-table">';
echo '<h2> Interpretações da Planta de '. $interpretacao[0]->dsc_planta .'</h2>';   

   echo '<div class="panel panel-default">
  <!-- Table -->
  <table class="table">
  <thead>
      <tr>
      <td>Acordo</td>
      <td>Período</td>
      <td>Anexo</td>
      <td>Interpretação</td>
      </tr>
  </thead>
  <tbody>';

$ult_assunt = NULL;
foreach ($interpretacao as $linha):
  echo '<tr>';
        if($ult_assunt != $linha->dsc_assunto){
            echo  '<td colspan="" rowspan="'. $linha->cont .'" headers="">'. $linha->dsc_assunto  .'</td>';
        }
        if( strlen($linha->dsc_file)>0){
            $file = '<a target="_blank" href="'.base_url().'uploads/'. $linha->dsc_file .'" >Arquivo na Íntegra</a>';
        }else{
            $file ="Não disponível";
        }
  echo '      
        <td>'. $linha->dsc_periodo .'</td>
        <td>'. $file .'</td>
        </tr>';

        $ult_assunt = $linha->dsc_assunto;
endforeach;

  echo '</tbody></table>
</div>';

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

