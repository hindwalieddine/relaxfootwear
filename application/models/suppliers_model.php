<?php

defined('BASEPATH') or die('No direct script access allowed');

class Suppliers_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*     * *
     * GET
     * CREATE
     * UPDATE
     * OTHER QUERIES THAT I NEED
     * 
    */

    public function get($id = false) {
        if ($id === false) {

            // Get all suppliers
            $query = $this->db->get('suppliers');
            return $query->result();
        } else {

            // select One Supplier
            $query = $this->db->get_where('suppliers', array('id' => $id), 1);
            return $query->row();
        }
    }

    public function create() {

        $data = array(
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'mobile' => $this->input->post('mobile'),
                'adress' => $this->input->post('adress')
        );

        return $this->db->insert('suppliers', $data);
    }

    public function update($id) {
        $data = array(
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'mobile' => $this->input->post('mobile'),
                'adress' => $this->input->post('adress')
        );

        $this->db->update('suppliers', $data, array('id' => $id));
    }

    public function delete($id) {
        return $this->db->delete('suppliers', array('id' => $id));
    }

    public function edit($id) {
        return $this->db->edit('suppliers', array('id' => $id));
    }

}

