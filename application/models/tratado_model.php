<?php

class Tratado_model extends CI_Model{
    
    public function do_insert($dados=NULL){            
        
        if ($dados != NULL):
            $this->db->insert('tratado',$dados);
            $this->session->set_flashdata('cadastrook','Cadastro efetuado com sucesso');
            redirect('tratado/create');
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

          $query = 'SELECT id_tratado, dsc_tratado FROM tratado';     
         
        return $this->db->query($query);
    }

    public function get_disp_byid($id){

          $query = 
          'SELECT id_tratado, dsc_tratado FROM tratado 
          WHERE id_tratado NOT IN (
                SELECT id_tratado FROM oc_ac_as WHERE id_ocorrencia = '. $id .'
            )';
         
        return $this->db->query($query);
    }
    
    public function get_ulti_byid($id){

          // $query = 
          // 'SELECT t.id_tratado as id_tratado, dsc_tratado, oc.dsc_file as dsc_file FROM tratado t
          // INNER JOIN oc_ac_as oc ON t.id_tratado = oc.id_tratado AND
          // WHERE t.id_tratado IN (
          //       SELECT oo.id_tratado FROM oc_ac_as oo WHERE id_ocorrencia = '. $id .'
          //   )
          //   ';

        $query = 
          'SELECT 
          oc.id_tratado as id_tratado, 
          oc.dsc_interpretacao as dsc_interpretacao, 
          t.dsc_tratado as dsc_tratado, 
          oc.dsc_file as dsc_file FROM oc_ac_as oc
          
          INNER JOIN tratado t ON oc.id_tratado = t.id_tratado
          WHERE oc.id_ocorrencia = '. $id;


        return $this->db->query($query);
    }
    
    
    public function get_byid($id) {
        $query = 'SELECT id_tratado, dsc_tratado FROM tratado 
                  WHERE id_tratado = ' . $id ; 

        return $this->db->query($query);
    }

}

