<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ocorrencia extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
       $this->load->helper('url');
       $this->load->helper('form');
       $this->load->helper('array');//ajuda a passar dados para o model
       $this->load->library('form_validation');
       $this->load->library('session');
       $this->load->database();//carrega o banco de dados para fazer operações no banco
       $this->load->library('table');//carrega tabela 
       $this->load->model('ocorrencia_model');//carrega o model
       $this->load->model('assunto_model');//carrega o model
       $this->load->model('planta_model');//carrega o model
       $this->load->model('periodo_model');//carrega o model
        date_default_timezone_set('America/Sao_Paulo');//define o timezone
    }
    
   
    public function  create(){

        // if(isset($_POST['data'])) {
        //     $data = json_decode($_POST['data']);
        //     pd($data);
        // }        
        // validação dos dados recebidos do formulário
        $this->form_validation->set_rules('dsc_resumo', 'Descrição do Acordo','trim|required');
        // $this->form_validation->set_rules('dsc_name','Nome','trim|required|max_lenght[100]|strtoupper');
        // $this->form_validation->set_rules('dsc_matricula','Matrícula','trim|required|max_lenght[45]|strtoupper');

        // se existe uma validação, envia os dados para o model inserir
        if ($this->form_validation->run()==TRUE){

            $validacao = TRUE;
            $dados = elements(array(
                                    'id_assunto',
                                    'id_planta',
                                    'id_periodo',
                                    'dsc_resumo',
                                    'dsc_file',
                                    ), $this->input->post());
            $this->ocorrencia_model->do_insert($dados);
        }

        $dados = array(
            'validacao'=> TRUE,
            'tela'=> 'create',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'dados_assunto'=> $this->assunto_model->get_all()->result_array(),
            'dados_planta'=> $this->planta_model->get_all()->result_array(),
            'dados_periodo'=> $this->periodo_model->get_all()->result_array(),
             );
        
        $this->load->view('conteudo', $dados );
    }
    
    public function retrieve() {

        $dados = array(
            'tela'=> 'retrieve',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->ocorrencia_model->get_all()->result(),
             );
        
        $this->load->view('conteudo', $dados);
    }
    

    public function  update(){   

    $flash_data = NULL;

    if($this->session->flashdata('edicaook')):
        $flash_data = '<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    Acordo atualizado com sucesso!!!
    </div>';
    endif;
      
        // recebe o id do usuário através da URL
        $id = $this->uri->segment(3);
            

        if($this->input->post('dsc_periodo')){
            
            //o $id é setado novamente quando vem por POST 
            $id = $this->input->post('id_periodo');

            // pd($id);

            $this->form_validation->set_rules('dsc_periodo','dsc_periodo','trim');

            if ($this->form_validation->run()==TRUE):


                $dados = elements(array(
                                        'id_periodo',
                                        'dsc_periodo'
                                        ), $this->input->post());

                $this->periodo_model->do_update($dados, array('id_periodo'=> $id));
            endif;

        }//fim do if

        $dados = array(
            'tela'=> 'update',
            'pasta'=> 'periodo',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'query'=> $this->periodo_model->get_byid($id)->row(),
            'flash_data'=> $flash_data,
         );
        
        $this->load->view('conteudo', $dados );

        // $id = $this->input->post('id');

        // pd($id);
    }//fim update


    function importar() {
        
        // Detect form submission.
        if($this->input->post('submit')){
        
            $path = './uploads/';
            $this->load->library('upload');
                        
            // Define file rules
            $this->upload->initialize(array(
                "upload_path"       =>  $path,
                "allowed_types"     =>  'text/plain|text|doc|docx|pdf|csv',
                // "max_size"          =>  '1000',
                // "max_width"         =>  '1024',
                // "max_height"        =>  '768'
            ));
            
            if($this->upload->do_multi_upload("uploadfile")){
               
                $data['upload_data'] = $this->upload->get_multi_upload_data();
                
                $arquivo = $data['upload_data'][0]["file_name"];

                echo '<div class="alert alert-success">'
                . '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span> '
                . ' Arquivo carregado com sucesso.</div>  '
                . '<input type="hidden" name ="atach-file" value= "' . $arquivo .'">';
                
            } else {    
                
                // Output the errors
                $errors = $this->upload->display_errors('<div class="alert alert-danger" role="alert">
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                        <span class="sr-only">Error:</span>', '<br>Favor inserir um arquivo com extensão <strong>.csv</strong></div>');              
                echo $errors;
            }
            exit();
        } 

        $dados = array(
            'tela'=> 'importar',
            'pasta'=> 'estrutura_produto',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
        );
        
        $this->load->view('conteudo', $dados );
        
    }

    public function carregar(){
        // carrega os arquivos de acordos

        $this->output->enable_profiler(FALSE);//MODO NATIVO DE DEBUG CODEIGNITER. MUDE PARA "TRUE" PARA HABILITAR


        $dados = array(
            'tela'=> 'carregar',
            'pasta'=> 'ocorrencia',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
             );

        $this->load->view('conteudo', $dados);
        
    }



       
}//fim da classe    
