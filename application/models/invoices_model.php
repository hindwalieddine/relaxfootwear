<?php

defined('BASEPATH') or die('No direct script access allowed');

class Invoices_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*     * *
     * GET
     * CREATE
     * OTHER QUERIES THAT I NEED
     * 
     */

    public function get($id = false) {
        if ($id === false) {

            // Get all articles
            $query = $this->db->get('order_articles');
            return $query->result();
        } else {

            // select One Article
            $query = $this->db->get_where('order_articles', array('id' => $id), 1);
            return $query->row();
        }
    }

    public function create() {

        $data = array(
            'article_id' => $this->input->post('article_id'),
            'size' => $this->input->post('size'),    
	    'Quantity' => $this->input->post('Quantity'),
            'sale_price' => $this->input->post('sale_price'),
            'comment' => $this->input->post('comment')
        );

        return $this->db->insert('order_articles', $data);
    }

    public function update($id) {
        $data = array(
            'article_id' => $this->input->post('article_id'),
            'size' => $this->input->post('size'),    
 	    'Quantity' => $this->input->post('Quantity'),
            'sale_price' => $this->input->post('sale_price'),
            'comment' => $this->input->post('comment')
        );

        $this->db->update('order_articles', $data, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('order_articles', array('id' => $id));
    }
    
	/***  
	Insert into stock
	***/
	
	    public function insert() {

        $data = array(
            'article_id' => $this->input->post('article_id'),
            'size' => $this->input->post('size'),    
	    'Quantity' => $this->input->post('Quantity'),
            'sale_price' => $this->input->post('sale_price'),
            'comment' => $this->input->post('comment')
        );

        return $this->db->insert('order_articles', $data);
    }
        
    public function get_sum_sale_price(){
        $query = "SELECT SUM( total ) as tot FROM orders  ";
        return $query->result1();
    }

    public function get_high_prices(){
        throw new Exception("NOT YET IMPLEMENTED");
    }

    public function get_the_size($data){

        $sizes[1]=array(16,17,18,19,20,21,22,23,24,25,26,27,28);
        $sizes[2]=array(27,28,29,30,31,32,33,34,35,36,37,38,39);
        $sizes[3]=array(35,36,37,38,39,40,41,42);
        $sizes[4]=array(35,36,37,38,39,40,41,42);
        $sizes[5]=array(35,36,37,38,39,40,41,42);
        //$sizes[6]=array(Accessories);
        $sizes[7]=array(39,40,41,41.5,42,42.5,43,43.5,44,45,46,47,48);
        //$sizes[8]=array(Bag);
        $sizes[9]=array('BB',0,2,4,6,8,10,10.5,11,12,14);
        $data['article']=substr($data['article'],0,1);
        $data['size']=$data['size']-1;
        if($data['article']==6){return "Accessories";}
        if($data['article']==8){return "Bag";}
        else return $sizes[ $data['article'] ][ $data['size'] ];
         
    }

}

/* End of file articles_model.php */
/* Location: ./application/models/articles_model.php */
