<?php

class Oc_ac_as_model extends CI_Model{
    
    public function do_insert($dados=NULL){            
        
        if ($dados != NULL):
            $this->db->insert('oc_ac_as',$dados);
        endif;
            
    }
    
    public function do_update($dados=NULL, $condicao=NULL){


        if ($dados != NULL && $condicao != NULL):
            // não está utilizando a variavel condição
        // pd($dados['id_assunto']);

        $sql =  'UPDATE planta 
                    SET dsc_planta = ' . "'" . $dados['dsc_planta'] . "'" .
                ' WHERE id_planta = ' . $dados['id_planta'];

                $this->db-> query($sql);

            $this->session->set_flashdata('edicaook','Acordo atualizado com sucesso');
            redirect(current_url());
        endif;
    }
    
    public function get_all(){

          $query = 'SELECT id_planta, dsc_planta FROM planta';     
         
        return $this->db->query($query);
    }
    
    
    public function get_byid($id) {
        $query = 'SELECT id_planta, dsc_planta FROM planta 
                  WHERE id_planta = ' . $id ; 

        return $this->db->query($query);
    }

}

