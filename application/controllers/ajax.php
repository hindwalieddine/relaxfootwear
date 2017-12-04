<?php
class Ajax extends CI_Controller{
	
	
	
	public function __construct(){
		
		parent::__construct();
		
		$this->load->database();
		header('Content-Type:application/json');
	
	}
	
	function Articles(){
		
		$term = $this->input->get('term');
		$articles = $this->db
			->select('id as value, code as label')
			->like('code' ,$term ,'after')
			->get('articles')
			->result_array();
			
			
		echo json_encode($articles);			
	}
	
	function Article($id){
		$articles = $this->db
			->get_where('articles', array('id' => $id), 1)
			->row_array();
		echo json_encode($articles);
	}
	
	
	function ArticleByCode($code){
		$articles = $this->db
			->get_where('articles', array('code' => $code), 1)
			->row_array();
		echo json_encode($articles);
	}
		
}