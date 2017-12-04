<?php

defined('BASEPATH') or die('No direct script access allowed');

class Stocks_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get($id = false) {
        if ($id === false) {

            // Get all stock
            $query = $this->db->get('stock');
            return $query->result();
        } else {

            // select One Supplier
            $query = $this->db->get_where('stock', array('id' => $id), 1);
            return $query->row();
        }
    }


    public function insert($stockId) {

        $data = array(
                'article_id' => $this->input->post('article_id'),
                'qty1' => $this->input->post('qty1'),
                'qty2' => $this->input->post('qty2'),
                'qty3' => $this->input->post('qty3'),
                'qty4' => $this->input->post('qty4'),
                'qty5' => $this->input->post('qty5'),
                'qty6' => $this->input->post('qty6'),
                'qty7' => $this->input->post('qty7'),
                'qty8' => $this->input->post('qty8'),
                'qty9' => $this->input->post('qty9'),
                'qty10' => $this->input->post('qty10'),
                'qty11' => $this->input->post('qty11'),
                'qty12' => $this->input->post('qty12'),
                'qty13' => $this->input->post('qty13'),
                'date' => $date=date('Y-m-d'),
                'note' => $this->input->post('note'),
                'stock' => $stockId
                     );


        return $this->db->insert('stock', $data);
    }

    /*
     * Inserted Update
     */
  public function update($id) {
        $data = array(
                'article_id' => $this->input->post('article_id'),
                'qty1' => $this->input->post('qty1'),
                'qty2' => $this->input->post('qty2'),
                'qty3' => $this->input->post('qty3'),
                'qty4' => $this->input->post('qty4'),
                'qty5' => $this->input->post('qty5'),
                'qty6' => $this->input->post('qty6'),
                'qty7' => $this->input->post('qty7'),
                'qty8' => $this->input->post('qty8'),
                'qty9' => $this->input->post('qty9'),
                'qty10' => $this->input->post('qty10'),
                'qty11' => $this->input->post('qty11'),
                'qty12' => $this->input->post('qty12'),
                'qty13' => $this->input->post('qty13')
        );

        $this->db->update('stock', $data, array('id' => $id));
    }

    /*
     * Transfer update
     */
    /*
     * Expedier update
     */
    
    public function updatetrans($id) {
        $data = array(
                'article_id' => $this->input->post('article_id'),
                'qty1' => $this->input->post('qty1'),
                'qty2' => $this->input->post('qty2'),
                'qty3' => $this->input->post('qty3'),
                'qty4' => $this->input->post('qty4'),
                'qty5' => $this->input->post('qty5'),
                'qty6' => $this->input->post('qty6'),
                'qty7' => $this->input->post('qty7'),
                'qty8' => $this->input->post('qty8'),
                'qty9' => $this->input->post('qty9'),
                'qty10' => $this->input->post('qty10'),
                'qty11' => $this->input->post('qty11'),
                'qty12' => $this->input->post('qty12'),
                'qty13' => $this->input->post('qty13')
        );

        $this->db->update('stock', $data, array('id' => $id));

                $data = array(
                'article_id' => $this->input->post('article_id'),
                'qty1' => - $this->input->post('qty1'),
                'qty2' => - $this->input->post('qty2'),
                'qty3' => - $this->input->post('qty3'),
                'qty4' => - $this->input->post('qty4'),
                'qty5' => - $this->input->post('qty5'),
                'qty6' => - $this->input->post('qty6'),
                'qty7' => - $this->input->post('qty7'),
                'qty8' => - $this->input->post('qty8'),
                'qty9' => - $this->input->post('qty9'),
                'qty10' => - $this->input->post('qty10'),
                'qty11' => - $this->input->post('qty11'),
                'qty12' => - $this->input->post('qty12'),
                'qty13' => - $this->input->post('qty13')
        );
                $newid = $id - 1;
       $this->db->update('stock', $data, array('id' => $newid));
    }
    



    public function delete($id) {
        return $this->db->delete('stock', array('id' => $id));
    }

    /*
     * Function to check if the article exist
     */
    function role_exists($key)
{
    $this->db->where('code',$key);
    $query = $this->db->get('articles');
    if ($query->num_rows() > 0){
        return true;
        
    }
    else{        
        $this->_load_view('failure_insert_no_article', $data);
        
    }
}
 
/*
 * check if the article is already inserted at the same date
 * if yes excecute an error
 */
    function role_alreadyexists($key,$date)
{  
    $this->db->where('code',$key);
    $this->db->where('inserteddate',$date);
    
    $query = $this->db->get('stock');
    if ($query->num_rows() > 0){
        return true;

    }
    else{
        $this->_load_view('failure_insert_same_article', $data);

    }
}

function get_suppliers_names() {
   $names= array();
   $query = $this->db->get('suppliers');
   if($query->num_rows() > 0) {
      foreach($query->result_array() as $name) {
         $names[] = $name;
      }
   }
   $query->free_result();
   return $names;
}

}

// load_view:   insert , success_insert , failure_insert

