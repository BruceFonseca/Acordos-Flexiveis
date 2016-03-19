<?php


$this->table->set_heading('Item', 'Descrição', 'Anexo');


foreach ($interpretacao as $linha):

    if( strlen($linha->dsc_file)>0){
            $file = '<a target="_blank" href="'.base_url().'uploads/'. $linha->dsc_file .'" >Arquivo na Íntegra</a>';
    }else{
        $file ="-";
    }

    $this->table->add_row(
    $linha->dsc_tratado, 
    $linha->dsc_interpretacao, 
    $file 
    );
endforeach;

echo '<div class="retrieve-table">';

if ($interpretacao) {
    echo '<h2> Interpretação - '. $interpretacao[0]->dsc_assunto . ' - '.$interpretacao[0]->dsc_planta . ' - '. $interpretacao[0]->dsc_periodo .'</h2>';	
}else{
    echo '<h2>Não Disponivel</h2>';   
}

$tmpl = array ( 'table_open'  => '<table width = "100%" border="1" cellpadding="2" cellspacing="1" class="table">' );
$this->table->set_template($tmpl);

echo $this->table->generate();

echo '</div>';

?>


