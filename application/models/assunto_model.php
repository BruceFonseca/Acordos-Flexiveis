<?php

class Assunto_model extends CI_Model{
    
    public function do_insert($dados=NULL){            
        
        if ($dados != NULL):
            $this->db->insert('assunto',$dados);
            $this->session->set_flashdata('cadastrook','Cadastro efetuado com sucesso');
            redirect('assunto/create');
        endif;
            
    }
    
    public function do_update($dados=NULL, $condicao=NULL){


        if ($dados != NULL && $condicao != NULL):
            // não está utilizando a variavel condição
        // pd($dados['id_assunto']);

        $sql =  'UPDATE assunto 
                    SET dsc_assunto = ' . "'" . $dados['dsc_assunto'] . "'" .
                ' WHERE id_assunto = ' . $dados['id_assunto'];

                $this->db-> query($sql);

            $this->session->set_flashdata('edicaook','Acordo atualizado com sucesso');
            redirect(current_url());
        endif;
    }
    
    public function get_all(){
          $query = 'SELECT id_assunto, dsc_assunto FROM assunto';     
         
        return $this->db->query($query);
    }
    
    
    public function get_byid($id) {
        $query = 'SELECT id_assunto, dsc_assunto FROM assunto
                  WHERE id_assunto = ' . $id ; 

        return $this->db->query($query);
    }

}

