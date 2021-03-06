<?php

class Tratado_model extends CI_Model{
    
    public function do_insert($dados=NULL, $tela = NULL){            
        
        if ($dados != NULL):
            $this->db->insert('tratado',$dados);
            $this->session->set_flashdata('cadastrook','Cadastro efetuado com sucesso');

            if ($tela != NULL) {
            //se não é nulo então retorna msg informando que foi cadastrado com sucesso
            //só utilizado quando esta cadastrando um novo assundo direto da tela de "Interpretaçoes"
              $return = '<div class="alert alert-success" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        Assunto cadastrado com sucesso!!!</div>';
              return $return;
            }else{
              redirect('tratado/create');
            }
        endif;
            
    }
    
    public function do_update($dados=NULL, $condicao=NULL){


        if ($dados != NULL && $condicao != NULL):

        $sql =  'UPDATE tratado 
                    SET dsc_tratado = ' . "'" . $dados['dsc_tratado'] . "'" .
                ' WHERE id_tratado = ' . $dados['id_tratado'];

                $this->db-> query($sql);

            $this->session->set_flashdata('edicaook','Acordo atualizado com sucesso');
            redirect(current_url());
        endif;
    }
    
    public function get_all(){

          $query = 'SELECT id_tratado, dsc_tratado FROM tratado ORDER BY dsc_tratado';     
         
        return $this->db->query($query);
    }

    public function get_last(){

          $query = 'SELECT id_tratado, dsc_tratado FROM tratado ORDER BY id_tratado DESC LIMIT 1';     
         
        return $this->db->query($query);
    }

    public function get_disp_byid($id){

          $query = 
          'SELECT id_tratado, dsc_tratado FROM tratado 
          WHERE id_tratado NOT IN (
                SELECT id_tratado FROM oc_ac_as WHERE id_ocorrencia = '. $id .'
            ) ORDER BY dsc_tratado';
         
        return $this->db->query($query);
    }
    
    public function get_ulti_byid($id){
        $query = 
          'SELECT 
          oc.id_tratado as id_tratado, 
          oc.dsc_interpretacao as dsc_interpretacao, 
          t.dsc_tratado as dsc_tratado, 
          oc.dsc_file as dsc_file FROM oc_ac_as oc
          
          INNER JOIN tratado t ON oc.id_tratado = t.id_tratado
          WHERE oc.id_ocorrencia = '. $id . ' ORDER BY t.dsc_tratado';


        return $this->db->query($query);
    }
    
    
    public function get_byid($id) {
        $query = 'SELECT id_tratado, dsc_tratado FROM tratado 
                  WHERE id_tratado = ' . $id ; 

        return $this->db->query($query);
    }

}

