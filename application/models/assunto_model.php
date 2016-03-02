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
        // pd($condicao);

        $sql =  'UPDATE assunto 
                    SET 
                    dsc_assunto = ' . "'" . $dados['dsc_assunto'] . "' ," .
                   ' dsc_conceito = ' . "'" . $dados['dsc_conceito'] . "' ," .
                   ' dsc_file = ' . "'" . $dados['dsc_file'] . "'" .
                ' WHERE id_assunto = ' . $condicao['id'];
// pd($sql);
                $this->db-> query($sql);

            $this->session->set_flashdata('edicaook','Acordo atualizado com sucesso');
            redirect(current_url());
        endif;
    }
    
    public function get_all(){
          $query = 'SELECT id_assunto, dsc_assunto FROM assunto';     
         
        return $this->db->query($query);
    }

    public function get_conceitos(){
          $query = 'SELECT 
                    id_assunto, 
                    dsc_assunto,
                    dsc_conceito,
                    dsc_file
                    FROM assunto';     
         
        return $this->db->query($query);
    }
    
    public function get_conceito_by_id($id){
          $query = 'SELECT 
                    id_assunto, 
                    dsc_assunto,
                    dsc_conceito,
                    dsc_file
                    FROM assunto WHERE id_assunto = ' . $id ;     
         
        return $this->db->query($query);
    }
    
    
    public function get_byid($id) {
        $query = 'SELECT id_assunto, dsc_assunto, dsc_conceito, dsc_file FROM assunto
                  WHERE id_assunto = ' . $id ; 

        return $this->db->query($query);
    }

}

