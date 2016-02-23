<?php

class Ocorrencia_model extends CI_Model{
    
    public function do_insert($dados=NULL){            
        
        if ($dados != NULL):
            $this->db->insert('ocorrencia',$dados);
            $this->session->set_flashdata('cadastrook','<span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                                 <span class="sr-only">Error:</span>     Acordo atualizado com sucesso!!!');
            redirect('ocorrencia/create');
        endif;
            
    }
    
    public function do_update($dados=NULL, $condicao=NULL){


        if ($dados != NULL && $condicao != NULL):
            // não está utilizando a variavel condição
        // pd($dados['id_assunto']);

        $sql =  'UPDATE periodo 
                    SET dsc_periodo = ' . "'" . $dados['dsc_periodo'] . "'" .
                ' WHERE id_periodo = ' . $dados['id_periodo'];

                $this->db-> query($sql);

            $this->session->set_flashdata('edicaook','Período atualizado com sucesso!!!');
            redirect(current_url());
        endif;
    }
    
    public function get_all(){

          $query = '
                SELECT 
                o.id_ocorrencia as id_ocorrencia,
                o.id_assunto as id_assunto,
                a.dsc_assunto as dsc_assunto,
                o.id_planta as id_planta,
                p.dsc_planta as dsc_planta,
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo,
                o.dsc_resumo as dsc_resumo,
                o.dsc_file as dsc_file
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
            ';     
         
        return $this->db->query($query);
    }
    
    
    public function get_byid($id) {
        $query = 'SELECT id_periodo, dsc_periodo FROM periodo 
                  WHERE id_periodo = ' . $id ; 

        return $this->db->query($query);
    }

    public function get_menu_planta(){
        $query = '
                SELECT DISTINCT
                o.id_planta as id_planta,
                p.dsc_planta as dsc_planta
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
            '; 

        return $this->db->query($query);

    }

    public function get_submenu_periodo(){
        $query = '
                SELECT DISTINCT
                o.id_planta as id_planta,
                o.id_periodo as id_periodo,
                pe.dsc_periodo as dsc_periodo
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
            ';

        return $this->db->query($query);

    }

    public function get_submenu_ocorrencia(){
        $query = '
                SELECT DISTINCT
                o.id_planta as id_planta,
                o.id_periodo as id_periodo,
                o.id_assunto as id_assunto,
                a.dsc_assunto as dsc_assunto
                FROM ocorrencia o
                INNER JOIN assunto a ON o.id_assunto = a.id_assunto
                INNER JOIN planta p ON o.id_planta = p.id_planta
                INNER JOIN periodo pe ON o.id_periodo = pe.id_periodo
            ';

        return $this->db->query($query);

    }

}

