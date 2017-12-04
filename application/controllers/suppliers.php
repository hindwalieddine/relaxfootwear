<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suppliers extends CI_Controller {

    function __construct() {
        parent::__construct();
        // We MUST load the model before using it.
        $this->load->model('suppliers_model');
    }

    function index() {
        $data['title'] = 'Suppliers';
        $data['suppliers'] = $this->suppliers_model->get();

        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/index', $data);
        $this->load->view('templates/footer', $data);
    }

    function view($id) {

        $data['supplier'] = $this->suppliers_model->get($id);

        if( empty($data['supplier']) ) {
            show_404();
        }

        $data['name'] = $data['supplier']->name;

        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/view', $data);
        $this->load->view('templates/footer', $data);
    }


    function create() {
        $data['title'] = 'Create New Supplier';

        $this->form_validation->set_rules('name', 'Name' , 'required|is_unique[suppliers.name]');
        $this->form_validation->set_rules('phone', 'Phone' , 'numeric');
        $this->form_validation->set_rules('mobile', 'Mobile' , 'numeric');
        $this->form_validation->set_rules('adress', 'Adress');
        //$this->form_validation->set_rules('discount_price', 'Discount Price' , 'numeric');




        if ( $this->form_validation->run() == FALSE) {
            $this->_load_view('create', $data);
        }
        else {

            // INSERT INTO DATABASEEEEEE
            // I WANT TO CALL THE MODEL
            // YA WAYLIKKKKKKK

            $success = $this->suppliers_model->create();

            if($success) {
                //$this->_load_view('success', $data);
                redirect('suppliers/create');
		//$this->_load_view('create', $data);
            }
            else {
                $this->_load_view('failure', $data);
            }

        }

    }


    function delete($id) {

        $data['supplier'] = $this->suppliers_model->get($id);

        if( empty($data['supplier']) ) {
            show_404();
        }

        $data['title'] = 'Delete ' . $data['supplier']->name;

        // RETURN FALSE IN 2 CASES, FIRST when loading the form for the first time,
        // ORR in case of validation errors

        if( $_SERVER['REQUEST_METHOD'] == 'POST') {
            // THE DELETE ACTION
            $this->suppliers_model->delete($id);

            /// REDIRECT
            redirect('suppliers');
			

        }else {
            $this->_load_view('confirmdelete', $data);
        }


        if( $this->form_validation->run() === FALSE) {

        }else {



        }






    }

    /**
     * Edit
     */
    function edit($id) {

        $this->form_validation->set_rules('name', 'Name' , 'required|is_one[suppliers.name]');
        $this->form_validation->set_rules('phone', 'Phone' , 'numeric');
        $this->form_validation->set_rules('mobile', 'Mobile' , 'numeric');
        $this->form_validation->set_rules('adress', 'Adress');
        //$this->form_validation->set_rules('discount_price', 'Discount Price' , 'numeric');

        //We take the row that have the id= $id

        $data['supplier'] = $this->suppliers_model->get($id);

        if( empty($data['supplier']) ) {
            show_404();
        }


        //show in the title page (Edit supplier $name)
        $data['title'] = 'Edit ' . $data['supplier']->name;


        //iza awal mara 3m yefta7 el page 2aw fe error
        if ( $this->form_validation->run() == FALSE) {
            $this->_load_view('edit', $data);
        }
        else {

            // THE EDIT ACTION
            $this->suppliers_model->update($id);

            /// REDIRECT
            redirect('suppliers');

        }


    }

    private function _load_view($view , $data) {
        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/' . $view , $data);
        $this->load->view('templates/footer', $data);
    }


}

/* End of file suppliers.php */
/* Location: ./application/controllers/suppliers.php */
