<?php

class Ocorrencia_model extends CI_Model{
    
    public function do_insert($dados=NULL){            
        
        if ($dados != NULL):
            $this->db->insert('ocorrencia',$dados);
            $this->session->set_flashdata('cadastrook','<span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                                 <span class="sr-only">Error:</span>     Acordo atualizado com sucesso!!!');
            // redirect('ocorrencia/create');
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
    public function get_last(){
        $query = '
                SELECT 
                MAX(id_ocorrencia) as last
                FROM ocorrencia
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

    public function valida_ocorrencia($id_assunto, $id_planta, $id_periodo){
    // verifica o número de vezes que o registro está cadastrado no banco

        $query = '
            SELECT COUNT(*) as cont FROM ocorrencia
            WHERE 
                id_assunto= ' . $id_assunto . ' AND
                id_planta= '  . $id_planta  . ' AND
                id_periodo= ' . $id_periodo  ;

        //transforma o resultado da query em um objeto para utiliza-lo
        $cont = $this->db->query($query)->row()->cont;

        if ($cont >= 1) {
            // se já está cadastrado, retorna FALSE
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function msg_validacao($msg){

        if($msg == 'cadastro_duplicado'){
             
            $return = ' <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>Esta Interpretação já está cadastrada com 
                        o mesmo <strong>Acordo</strong>, <strong>Planta</strong> e <strong>Período</strong></div>';

        }elseif ($msg == 'cadastrado_sucesso') {
            $return = '<div class="alert alert-success" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        Interpretação cadastrada com sucesso!!!</div>';
        }

        return $return;
    }
    

}

