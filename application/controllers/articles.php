<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Articles extends CI_Controller {

    function __construct() {
        parent::__construct();
         // We MUST load the model before using it.
        $this->load->model('articles_model');
    }

    function index() {
        $data['title'] = 'Articles Ya helwin';
        $data['articles'] = $this->articles_model->get();

        $this->load->view('templates/header', $data);
        $this->load->view('articles/index', $data);
        $this->load->view('templates/footer', $data);
    }

    function view($id) {

        $data['article'] = $this->articles_model->get($id);
        
        if( empty($data['article']) ){
            show_404();
        }
        
        $data['title'] = $data['article']->title;
        
        $this->load->view('templates/header', $data);
        $this->load->view('articles/view', $data);
        $this->load->view('templates/footer', $data);
	}
	
	
	function create(){
		$data['title'] = 'Create New Article';

		$this->form_validation->set_rules('code', 'Code' , 'exact_length[7]|integer|required|is_unique[articles.code]');
		$this->form_validation->set_rules('title', 'Title');
		$this->form_validation->set_rules('purchase_price', 'Purchase Price' , 'numeric|required');
		$this->form_validation->set_rules('sale_price', 'Sale Price' , 'numeric|required');
		$this->form_validation->set_rules('discount_price', 'Discount Price' , 'numeric');
		//$this->form_validation->set_rules('userfile', 'Image', 'upload_no_file_selected');
		$data['result'] = $this->db->query('SELECT  id,name FROM `suppliers` ')->result();
                // $result = $this->articles_model->getsuppliers();
		if ( $this->form_validation->run() == FALSE)
		{
                
			$this->_load_view('create', $data);
                     
		}
		else
		{

                 
			$success = $this->articles_model->create();
			
			if($success){
                          //$this->_load_view('success', $data);

        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|png|jpg|jpeg';
        $config['overwrite'] =  true;
        $config['remove_spaces']= true;
        $config['file_name'] = $this->input->post('code').'.jpg';
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload()){
            $error = array('error'=>$this->upload->display_errors());
            //$this->load->view(main_view,$error);

        }
        else{
           $file_data = $this->upload->data();
           $data['img'] = base_url().'/images/'.$file_data['file_name'];
           $this->load->view('upload/success_msg',$data);

        }
                         redirect('articles/create');
                         // $this->upload($this->code);
			  // $this->_load_view('create', $data);
			}
			else{
				$this->_load_view('failure', $data);
				}
			
		}
		
	}
	
	
	function delete($id)
	{
	$data['article'] = $this->articles_model->get($id);
        
        if( empty($data['article']) ){
            show_404();
        }
        
        $data['title'] = 'Delete ' . $data['article']->title;
		
		// RETURN FALSE IN 2 CASES, FIRST when loading the form for the first time,
		// ORR FAKARI In case of validation errors , y3ne btkune b34dik n3ssene bhl halee
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST'){
			// THE DELETE ACTION WAAW
			$this->articles_model->delete($id);
			
			/// REDIRECT
			redirect('articles');
			
		}else{
			$this->_load_view('confirmdelete', $data);	
		}
		
		
		if( $this->form_validation->run() === FALSE){
			
		}else{
			
			
			
		}
		
		
		
		
		
		
	}
	/**
	* Edit 
	*/
	function edit($id)
	{    
	
		$this->form_validation->set_rules('code', 'Code' , 'exact_length[7]|integer|required|is_one[articles.code]');
		$this->form_validation->set_rules('title', 'Title');
		$this->form_validation->set_rules('purchase_price', 'Purchase Price' , 'numeric|required');
		$this->form_validation->set_rules('sale_price', 'Sale Price' , 'numeric|required');
		$this->form_validation->set_rules('discount_price', 'Discount Price' , 'numeric');
		
		
		
		$data['result'] = $this->db->query('SELECT  id,name FROM `suppliers` ')->result();
		
	     //We take the row that have the id= $id
		 
		$data['article'] = $this->articles_model->get($id);
        
        if( empty($data['article']) ){
            show_404();
        }
		
		
		//show in the title page (Edit article $code)
		  $data['title'] = 'Edit ' . $data['article']->code;
		  
		  
		  //iza awal mara 3m yefta7 el page 2aw fe error
		  if ( $this->form_validation->run() == FALSE)
		{
			$this->_load_view('edit', $data);
		}
		else
		{

			// THE EDIT ACTION
			$this->articles_model->update($id);
			
			/// REDIRECT
			redirect('articles');
			
		}

		
	}
	
	function insert(){
		$data['title'] = 'Add Articles to stock';
		
		$this->form_validation->set_rules('article_id', 'Article' , 'exact_length[7]|integer|required');
		$this->form_validation->set_rules('qty1_s1', 'qty1_s1' , 'numeric');
		$this->form_validation->set_rules('qty2_s1', 'qty1_s1' , 'numeric');
		$this->form_validation->set_rules('qty3_s1', 'qty3_s1' , 'numeric');
		$this->form_validation->set_rules('qty4_s1', 'qty4_s1' , 'numeric');
		$this->form_validation->set_rules('qty5_s1', 'qty5_s1' , 'numeric');
		$this->form_validation->set_rules('qty6_s1', 'qty6_s1' , 'numeric');
		$this->form_validation->set_rules('qty7_s1', 'qty7_s1' , 'numeric');
		$this->form_validation->set_rules('qty8_s1', 'qty8_s1' , 'numeric');
		$this->form_validation->set_rules('qty9_s1', 'qty9_s1' , 'numeric');
		$this->form_validation->set_rules('qty10_s1', 'qty10_s1' , 'numeric');
		$this->form_validation->set_rules('qty11_s1', 'qty11_s1' , 'numeric');
		$this->form_validation->set_rules('qty12_s1', 'qty12_s1' , 'numeric');
		$this->form_validation->set_rules('qty13_s1', 'qty13_s1' , 'numeric');
		$this->form_validation->set_rules('qty1_s2', 'qty1_s2' , 'numeric');
		$this->form_validation->set_rules('qty2_s2', 'qty1_s2' , 'numeric');
		$this->form_validation->set_rules('qty3_s2', 'qty3_s2' , 'numeric');
		$this->form_validation->set_rules('qty4_s2', 'qty4_s2' , 'numeric');
		$this->form_validation->set_rules('qty5_s2', 'qty5_s2' , 'numeric');
		$this->form_validation->set_rules('qty6_s2', 'qty6_s2' , 'numeric');
		$this->form_validation->set_rules('qty7_s2', 'qty7_s2' , 'numeric');
		$this->form_validation->set_rules('qty8_s2', 'qty8_s2' , 'numeric');
		$this->form_validation->set_rules('qty9_s2', 'qty9_s2' , 'numeric');
		$this->form_validation->set_rules('qty10_s2', 'qty10_s2' , 'numeric');
		$this->form_validation->set_rules('qty11_s2', 'qty11_s2' , 'numeric');
		$this->form_validation->set_rules('qty12_s2', 'qty12_s2' , 'numeric');
		$this->form_validation->set_rules('qty13_s2', 'qty13_s2' , 'numeric');
		$this->form_validation->set_rules('qty1_s3', 'qty1_s3' , 'numeric');
		$this->form_validation->set_rules('qty2_s3', 'qty1_s3' , 'numeric');
		$this->form_validation->set_rules('qty3_s3', 'qty3_s3' , 'numeric');
		$this->form_validation->set_rules('qty4_s3', 'qty4_s3' , 'numeric');
		$this->form_validation->set_rules('qty5_s3', 'qty5_s3' , 'numeric');
		$this->form_validation->set_rules('qty6_s3', 'qty6_s3' , 'numeric');
		$this->form_validation->set_rules('qty7_s3', 'qty7_s3' , 'numeric');
		$this->form_validation->set_rules('qty8_s3', 'qty8_s3' , 'numeric');
		$this->form_validation->set_rules('qty9_s3', 'qty9_s3' , 'numeric');
		$this->form_validation->set_rules('qty10_s3', 'qty10_s3' , 'numeric');
		$this->form_validation->set_rules('qty11_s3', 'qty11_s3' , 'numeric');
		$this->form_validation->set_rules('qty12_s3', 'qty12_s3' , 'numeric');
		$this->form_validation->set_rules('qty13_s3', 'qty13_s3' , 'numeric');
                
		
		
		if ( $this->form_validation->run() == FALSE)
		{
			$this->_load_view('insert', $data);
		}
		else
		{
			//insert into the database
			$success = $this->articles_model->insert();
			
			if($success){
                           
				$this->_load_view('success_insert', $data);
			}
			else{
				$this->_load_view('failure', $data);
				}
			
		}
		
	}

		
	
	private function _load_view($view , $data){
	$this->load->view('templates/header', $data);
        $this->load->view('articles/' . $view , $data);
        $this->load->view('templates/footer', $data);		
	}


function do_upload()
	{
                $url= base_url();
		$config['upload_path'] = base_url().'uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);
		}
	}

       
    public function upload(){ // upload function for image  .'uploads/';
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|png|jpg|jpeg';
        $config['overwrite'] =  true;
        $config['remove_spaces']= true;

        $this->load->library('upload',$config);
        if(!$this->upload->do_upload()){
            $error = array('error'=>$this->upload->display_errors());
            $this->load->view(main_view,array('error'=>''));
    }

    }
}

/* End of file Articles.php */
/* Location: ./application/controllers/Articles.php */
