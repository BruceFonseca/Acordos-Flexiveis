<?php

class Oc_ac_as_model extends CI_Model{
    
    public function do_insert($data=NULL, $id_ocorrencia){        

    //transforma o objeto em array
    if (is_object($data)) {
            $dados = get_object_vars($data);
            unset($dados['dados_acordo']);
    }

    foreach ($dados as $linha):

        $sql = ' INSERT INTO oc_ac_as (id_ocorrencia, id_tratado, dsc_file)
                VALUES('. $id_ocorrencia .', '. $linha->id . ', "'. $linha->file .'")';

        $this->db-> query($sql);
    endforeach;

    }

    


}

