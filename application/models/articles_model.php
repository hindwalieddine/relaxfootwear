<?php

defined('BASEPATH') or die('No direct script access allowed');

class Articles_model extends CI_Model {


    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*     * *
     * GET
     * CREATE
     * UPDATE
     * OTHER QUERIES THAT I NEED YA MANKOUSHAT CHA3RI
     * 
    */

    public function get($id = false) {
        if ($id === false) {

            // Get all articles
            $this->db->select('*');
            $this->db->from('articles');
            $this->db->order_by('code', 'asc');
            $query = $this->db->get();

            //$query = $this->db->get('articles');
            return $query->result();
        } else {

            // select One Article
            $query = $this->db->get_where('articles', array('id' => $id), 1);
            return $query->row();
        }
    }

    public function create() {

        $data = array(
                'code' => $this->input->post('code'),
                'title' => $this->input->post('title'),
                'purchase_price' => $this->input->post('purchase_price'),
                'sale_price' => $this->input->post('sale_price'),
                'discount_price' => $this->input->post('discount_price'),
                'in_discount' => $this->input->post('in_discount'),
                'image' => $this->input->post('image'),
                'description' => $this->input->post('description'),
                'supp_id' => $this->input->post('supp_id')
        );

        return $this->db->insert('articles', $data);
    }

    public function update($id) {
        $data = array(
                'code' => $this->input->post('code'),
                'title' => $this->input->post('title'),
                'purchase_price' => $this->input->post('purchase_price'),
                'sale_price' => $this->input->post('sale_price'),
                'discount_price' => $this->input->post('discount_price'),
                'in_discount' => $this->input->post('in_discount'),
                'image' => $this->input->post('image'),
                'description' => $this->input->post('description'),
                'supp_id' => $this->input->post('supp_id')
        );

        $this->db->update('articles', $data, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('articles', array('id' => $id));
    }

    /***
	Insert into stock
	***/

    public function insert() {

        $data = array(
                'article_id' => $this->input->post('article_id'),
                'qty1_s1' => $this->input->post('qty1_s1'),
                'qty2_s1' => $this->input->post('qty2_s1'),
                'qty3_s1' => $this->input->post('qty3_s1'),
                'qty4_s1' => $this->input->post('qty4_s1'),
                'qty5_s1' => $this->input->post('qty5_s1'),
                'qty6_s1' => $this->input->post('qty6_s1'),
                'qty7_s1' => $this->input->post('qty7_s1'),
                'qty8_s1' => $this->input->post('qty8_s1'),
                'qty9_s1' => $this->input->post('qty9_s1'),
                'qty10_s1' => $this->input->post('qty10_s1'),
                'qty11_s1' => $this->input->post('qty11_s1'),
                'qty12_s1' => $this->input->post('qty12_s1'),
                'qty13_s1' => $this->input->post('qty13_s1'),
                'qty1_s2' => $this->input->post('qty1_s2'),
                'qty2_s2' => $this->input->post('qty2_s2'),
                'qty3_s2' => $this->input->post('qty3_s2'),
                'qty4_s2' => $this->input->post('qty4_s2'),
                'qty5_s2' => $this->input->post('qty5_s2'),
                'qty6_s2' => $this->input->post('qty6_s2'),
                'qty7_s2' => $this->input->post('qty7_s2'),
                'qty8_s2' => $this->input->post('qty8_s2'),
                'qty9_s2' => $this->input->post('qty9_s2'),
                'qty10_s2' => $this->input->post('qty10_s2'),
                'qty11_s2' => $this->input->post('qty11_s2'),
                'qty12_s2' => $this->input->post('qty12_s2'),
                'qty13_s2' => $this->input->post('qty13_s2'),
                'qty1_s3' => $this->input->post('qty1_s3'),
                'qty2_s3' => $this->input->post('qty2_s3'),
                'qty3_s3' => $this->input->post('qty3_s3'),
                'qty4_s3' => $this->input->post('qty4_s3'),
                'qty5_s3' => $this->input->post('qty5_s3'),
                'qty6_s3' => $this->input->post('qty6_s3'),
                'qty7_s3' => $this->input->post('qty7_s3'),
                'qty8_s3' => $this->input->post('qty8_s3'),
                'qty9_s3' => $this->input->post('qty9_s3'),
                'qty10_s3' => $this->input->post('qty10_s3'),
                'qty11_s3' => $this->input->post('qty11_s3'),
                'qty12_s3' => $this->input->post('qty12_s3'),
                'qty13_s3' => $this->input->post('qty13_s3'),
                'supp_id' => $this->input->post('supplier_name')
        );

        return $this->db->insert('stock', $data);
    }

    public function get_most_ordered() {
        throw new Exception("NOT YET IMPLEMENTED");
    }

    public function get_high_prices() {
        throw new Exception("NOT YET IMPLEMENTED");
    }


}

/* End of file articles_model.php */
/* Location: ./application/models/articles_model.php */
