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
            // não está utilizando a variavel condição
        // pd($dados['id_assunto']);

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
    
    
    public function get_byid($id) {
        $query = 'SELECT id_tratado, dsc_tratado FROM tratado 
                  WHERE id_tratado = ' . $id ; 

        return $this->db->query($query);
    }

}

