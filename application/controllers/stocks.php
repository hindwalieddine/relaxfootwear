<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stocks extends CI_Controller {

    function __construct() {
        parent::__construct();
        // We MUST load the model before using it.
        $this->load->model('stocks_model');
    }

    function index() {
        $data['title'] = 'Stock';
        $data['stocks'] = $this->stocks_model->get();

        $this->load->view('templates/header', $data);
        $this->load->view('stocks/index', $data);
        $this->load->view('templates/footer', $data);
    }

    function view($id) {

        $data['stock'] = $this->stocks_model->get($id);

        if (empty($data['stock'])) {
            show_404();
        }

        $data['title'] = $data['stock']->article_id;

        $this->load->view('templates/header', $data);
        $this->load->view('stocks/view', $data);
        $this->load->view('templates/footer', $data);
    }

    function summary($stockId = -1) {
        $data['title'] = 'Stock summary';
        $data['from_article'] = $this->input->get('from_article');
        $data['to_article'] = $this->input->get('to_article');

        $and = 'AND stock <>4';
        if ($stockId != -1) {
            $and = 'AND stock=' . $stockId . ' AND stock <>4 ';
        }


        if ($data['from_article']) {
            $and .= " AND `article_id` >= '{$data['from_article']}' ";
        }
        if ($data['to_article']) {
            $and .= "AND `article_id` <= '{$data['to_article']}' ";
        }
        $query = 'SELECT `articles`.`id` article_id, `articles`.`code` article_code, `articles`.sale_price,`articles`.purchase_price,sum(qty1) as qty1,sum(qty2) as qty2,sum(qty3) as qty3,sum(qty4) as qty4,sum(qty5) as qty5,
	  sum(qty6) as qty6,sum(qty7) as qty7,sum(qty8) as qty8,sum(qty9) as qty9,sum(qty10) as qty10,sum(qty11) as qty11,
	  sum(qty12) as qty12,sum(qty13) as qty13,stock,action FROM `stock`,`articles` WHERE `articles`.`code` = `stock`.`article_id` ' . $and . ' group by article_id';

//        die($query);
        
        $data['result'] = $this->db->query($query)->result();
        $data['stockId'] = $stockId;
        $this->_load_view('summary', $data);
    }

       function search() {
        $data['title'] = 'Stock search';
        $data['article_id'] = $this->input->get('article_id');

        $and = 'AND stock <>4';
        $andrelax = ' AND stock= 1 ';
        $anddepot = 'AND stock= 3 ';



        
            $and .= " AND `article_id` = '{$data['article_id']}' ";
                   
        $queryrelax = 'SELECT `articles`.`id` article_id, `articles`.`code` article_code, `articles`.sale_price,`articles`.purchase_price,sum(qty1) as qty1,sum(qty2) as qty2,sum(qty3) as qty3,sum(qty4) as qty4,sum(qty5) as qty5,
	  sum(qty6) as qty6,sum(qty7) as qty7,sum(qty8) as qty8,sum(qty9) as qty9,sum(qty10) as qty10,sum(qty11) as qty11,
	  sum(qty12) as qty12,sum(qty13) as qty13,stock,action FROM `stock`,`articles` WHERE `articles`.`code` = `stock`.`article_id` ' . $and  . $andrelax . ' group by article_id';
        $data['resultrelax'] = $this->db->query($queryrelax)->result();

        $querydepot = 'SELECT `articles`.`id` article_id, `articles`.`code` article_code, `articles`.sale_price,`articles`.purchase_price,sum(qty1) as qty1,sum(qty2) as qty2,sum(qty3) as qty3,sum(qty4) as qty4,sum(qty5) as qty5,
	  sum(qty6) as qty6,sum(qty7) as qty7,sum(qty8) as qty8,sum(qty9) as qty9,sum(qty10) as qty10,sum(qty11) as qty11,
	  sum(qty12) as qty12,sum(qty13) as qty13,stock,action FROM `stock`,`articles` WHERE `articles`.`code` = `stock`.`article_id` ' . $and  . ' '. $anddepot . ' group by article_id';

//        die($query);

        
        $data['resultdepot'] = $this->db->query($querydepot)->result();
        $this->_load_view('search', $data);
    }

    function transfer() {
        $data['title'] = 'Transer';
        $data['sum'] = '';

        $this->form_validation->set_rules('article_id', 'Article', 'exact_length[7]|integer|callback_rolekey_exists');
        $this->form_validation->set_rules('qty1', 'qty1', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty2', 'qty1', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty3', 'qty3', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty4', 'qty4', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty5', 'qty5', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty6', 'qty6', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty7', 'qty7', 'numeric|greater_than[-1]');
        ;
        $this->form_validation->set_rules('qty8', 'qty8', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty9', 'qty9', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty10', 'qty10', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty11', 'qty11', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty12', 'qty12', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty13', 'qty13', 'numeric|greater_than[-1]');

        $sum = $this->input->post('qty1') + $this->input->post('qty2') + $this->input->post('qty3') + $this->input->post('qty4') + $this->input->post('qty5') + $this->input->post('qty6') + $this->input->post('qty7') + $this->input->post('qty8') + $this->input->post('qty9') + $this->input->post('qty10') + $this->input->post('qty11') + $this->input->post('qty12') + $this->input->post('qty13');
        $tot = $this->input->post('tot');
        if ($sum != $tot) {
            $this->_load_view('failure_transfert', $data);
        } else {

            if ($this->form_validation->run() == FALSE) {
                $this->_load_view('transfer', $data);
            } else {

                $tdata = array(
                    'qty1' => -$this->input->post('qty1'),
                    'qty2' => -$this->input->post('qty2'),
                    'qty3' => -$this->input->post('qty3'),
                    'qty4' => -$this->input->post('qty4'),
                    'qty5' => -$this->input->post('qty5'),
                    'qty6' => -$this->input->post('qty6'),
                    'qty7' => -$this->input->post('qty7'),
                    'qty8' => -$this->input->post('qty8'),
                    'qty9' => -$this->input->post('qty9'),
                    'qty10' => -$this->input->post('qty10'),
                    'qty11' => -$this->input->post('qty11'),
                    'qty12' => -$this->input->post('qty12'),
                    'qty13' => -$this->input->post('qty13'),
                    'note' => $this->input->post('note'),
                    'stock' => $this->input->post('from'),
                    'article_id' => $this->input->post('article_id'),
                    'date' => date('Y-m-d'),
                    'action' => '2'
                );

                $success = $this->db->insert('stock', $tdata);

                $tdata = array(
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
                    'note' => $this->input->post('note'),
                    'stock' => $this->input->post('to'),
                    'article_id' => $this->input->post('article_id'),
                    'date' => date('Y-m-d'),
                    'action' => '2'
                );

                $success &= $this->db->insert('stock', $tdata);

                if ($success) {
                    //$this->_load_view('success_transfer', $data);
                    $this->_load_view('transfer', $data);
                } else {
                    $this->_load_view('failure', $data);
                }
            }
        }
    }

    function expedier() {
        $data['title'] = 'Expedier';
        $data['sum'] = '';

        $this->form_validation->set_rules('article_id', 'Article', 'exact_length[7]|integer|callback_rolekey_exists');
        $this->form_validation->set_rules('qty1', 'qty1', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty2', 'qty1', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty3', 'qty3', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty4', 'qty4', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty5', 'qty5', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty6', 'qty6', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty7', 'qty7', 'numeric|greater_than[-1]');
        ;
        $this->form_validation->set_rules('qty8', 'qty8', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty9', 'qty9', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty10', 'qty10', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty11', 'qty11', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty12', 'qty12', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty13', 'qty13', 'numeric|greater_than[-1]');

        $sum = $this->input->post('qty1') + $this->input->post('qty2') + $this->input->post('qty3') + $this->input->post('qty4') + $this->input->post('qty5') + $this->input->post('qty6') + $this->input->post('qty7') + $this->input->post('qty8') + $this->input->post('qty9') + $this->input->post('qty10') + $this->input->post('qty11') + $this->input->post('qty12') + $this->input->post('qty13');
        $tot = $this->input->post('tot');
        if ($sum != $tot) {
            $this->_load_view('failure_expedier', $data);
        } else {

            if ($this->form_validation->run() == FALSE) {
                $this->_load_view('expedier', $data);
            } else {

                $tdata = array(
                    'qty1' => -$this->input->post('qty1'),
                    'qty2' => -$this->input->post('qty2'),
                    'qty3' => -$this->input->post('qty3'),
                    'qty4' => -$this->input->post('qty4'),
                    'qty5' => -$this->input->post('qty5'),
                    'qty6' => -$this->input->post('qty6'),
                    'qty7' => -$this->input->post('qty7'),
                    'qty8' => -$this->input->post('qty8'),
                    'qty9' => -$this->input->post('qty9'),
                    'qty10' => -$this->input->post('qty10'),
                    'qty11' => -$this->input->post('qty11'),
                    'qty12' => -$this->input->post('qty12'),
                    'qty13' => -$this->input->post('qty13'),
                    'note' => $this->input->post('note'),
                    'stock' => $this->input->post('from'),
                    'article_id' => $this->input->post('article_id'),
                    'date' => date('Y-m-d'),
                    'action' => '4'
                );

                $success = $this->db->insert('stock', $tdata);

                $tdata = array(
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
                    'note' => $this->input->post('note'),
                    'stock' => '4',
                    'article_id' => $this->input->post('article_id'),
                    'date' => date('Y-m-d'),
                    'action' => '4'
                );

                $success &= $this->db->insert('stock', $tdata);

                if ($success) {
                    //$this->_load_view('success_transfer', $data);
                    $this->_load_view('expedier', $data);
                } else {
                    $this->_load_view('failure_expedier', $data);
                }
            }
        }
    }

    function insert($stockId) {

        // TODO
        // validation of the stock id 
        if ($stockId == 1) {
            $stockname = "Relax";
        }
        if ($stockId == 2) {
            $stockname = "Solderie";
        }
        if ($stockId == 3) {
            $stockname = "Depot";
        }
        $data['title'] = 'Add Articles to ' . $stockname . ' Stock';
        $data['stockId'] = $stockId;
        $data['sum'] = '';

        $this->form_validation->set_rules('article_id', 'Article', 'exact_length[7]|integer|required|callback_article_exists|callback_not_inserted_exists['.$stockId.']');
        $this->form_validation->set_rules('qty1', 'qty1', 'numeric');
        $this->form_validation->set_rules('qty2', 'qty1', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty3', 'qty3', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty4', 'qty4', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty5', 'qty5', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty6', 'qty6', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty7', 'qty7', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty8', 'qty8', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty9', 'qty9', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty10', 'qty10', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty11', 'qty11', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty12', 'qty12', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty13', 'qty13', 'numeric|greater_than[-1]');

        $sum = $this->input->post('qty1') + $this->input->post('qty2') + $this->input->post('qty3') + $this->input->post('qty4') + $this->input->post('qty5') + $this->input->post('qty6') + $this->input->post('qty7') + $this->input->post('qty8') + $this->input->post('qty9') + $this->input->post('qty10') + $this->input->post('qty11') + $this->input->post('qty12') + $this->input->post('qty13');
        $tot = $this->input->post('tot');
        if ($sum != $tot) {
            $this->_load_view('failure_insert', $data);
        } else {

            if ($this->form_validation->run() == FALSE) {
                $this->_load_view('insert', $data);
            } else {

                // INSERT INTO DATABASEEEEEE
                // I WANT TO CALL THE MODEL

                $success = $this->stocks_model->insert($stockId);

                if ($success) {
                    //$this->_load_view('success_insert', $data);
                    //$this->_load_view('insert', $data);
                    // redirect('stocks/insert/'.$stockId);
                    redirect('stocks/insert/' . $data['stockId']);
                    //echo 'stocks/insert/'.$data['stockId'];
                } else {
                    $this->_load_view('failure_insert', $data);
                }
            }
        }
    }

    private function _load_view($view, $data) {
        $this->load->view('templates/header', $data);
        $this->load->view('stocks/' . $view, $data);
        $this->load->view('templates/footer', $data);
    }

    function article_exists($key) {

        $exist = $this->db->from('articles')->where(array('code' => $key))->count_all_results() == 1;


        if (!$exist) {
            $this->form_validation->set_message('rolekey_exists', 'Article not created');
            return FALSE;
        }

        return TRUE;
    }

    function not_inserted_exists($key, $stockid) {
        $date = date('Y-m-d');
        
        $valid = $this->db->from('stock')->where(array('article_id' => $key, 'date' => $date, 'stock' => $stockid ,'action' => 1))->count_all_results() == 0;

        if (!$valid) {
            $this->form_validation->set_message('not_inserted_exists', 'You have already inserted this article');
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Edit Inserted article
     */
    function edit($id) {

        $this->form_validation->set_rules('article_id', 'Article', 'exact_length[7]|integer|required|callback_rolekey_exists');
        $this->form_validation->set_rules('qty1', 'qty1', 'numeric');
        $this->form_validation->set_rules('qty2', 'qty1', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty3', 'qty3', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty4', 'qty4', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty5', 'qty5', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty6', 'qty6', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty7', 'qty7', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty8', 'qty8', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty9', 'qty9', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty10', 'qty10', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty11', 'qty11', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty12', 'qty12', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty13', 'qty13', 'numeric|greater_than[-1]');

        $data['result'] = $this->db->query('SELECT  id,name FROM `suppliers` ')->result();

        //We take the row that have the id= $id

        $data['stock'] = $this->stocks_model->get($id);

        if (empty($data['stock'])) {
            show_404();
        }


        //show in the title page (Edit article $article_id)
        $data['title'] = 'Edit ' . $data['stock']->article_id;


        //iza awal mara 3m yefta7 el page 2aw fe error
        if ($this->form_validation->run() == FALSE) {
            $this->_load_view('edit', $data);
        } else {

            // THE EDIT ACTION
            $this->stocks_model->update($id);


            /// REDIRECT
            redirect('reports/insertedarticlesbydate');
        }
    }

    /**
     * Edit Transfer article
     */
    function edittrans($id) {

        $this->form_validation->set_rules('article_id', 'Article', 'exact_length[7]|integer|required|callback_rolekey_exists');
        $this->form_validation->set_rules('qty1', 'qty1', 'numeric');
        $this->form_validation->set_rules('qty2', 'qty1', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty3', 'qty3', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty4', 'qty4', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty5', 'qty5', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty6', 'qty6', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty7', 'qty7', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty8', 'qty8', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty9', 'qty9', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty10', 'qty10', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty11', 'qty11', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty12', 'qty12', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty13', 'qty13', 'numeric|greater_than[-1]');

        $data['result'] = $this->db->query('SELECT  id,name FROM `suppliers` ')->result();

        //We take the row that have the id= $id

        $data['stock'] = $this->stocks_model->get($id);

        if (empty($data['stock'])) {
            show_404();
        }


        //show in the title page (Edit article $article_id)
        $data['title'] = 'Edit ' . $data['stock']->article_id;


        //iza awal mara 3m yefta7 el page 2aw fe error
        if ($this->form_validation->run() == FALSE) {
            $this->_load_view('edittrans', $data);
        } else {

            // THE EDIT ACTION
            $this->stocks_model->updatetrans($id);


            /// REDIRECT
            //redirect('reports/transferarticlesbydate/'.$stock->id);
            redirect('reports/insertedarticlesbydate');
        }
    }

    /*
     * Delete Inserted article from table stock
     */

    function delete($id) {
        $data['stock'] = $this->stocks_model->get($id);

        if (empty($data['stock'])) {
            show_404();
        }

        $data['title'] = 'Delete ' . $data['stock']->article_id;

        // RETURN FALSE IN 2 CASES, FIRST when loading the form for the first time,
        // ORR FAKARI In case of validation errors , y3ne btkune b34dik n3ssene bhl halee

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // THE DELETE ACTION WAAW
            $this->stocks_model->delete($id);

            /// REDIRECT
            redirect('reports/insertedarticlesbydate');
        } else {
            $this->_load_view('confirminsertdelete', $data);
        }


        if ($this->form_validation->run() === FALSE) {
            
        } else {
            
        }
    }

    //Delete Transfer from stock table
    function deletetrans($id) {
        $data['stock'] = $this->stocks_model->get($id);

        if (empty($data['stock'])) {
            show_404();
        }

        $data['title'] = 'Delete ' . $data['stock']->article_id;

        // RETURN FALSE IN 2 CASES, FIRST when loading the form for the first time,
        // ORR FAKARI In case of validation errors , y3ne btkune b34dik n3ssene bhl halee

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // THE DELETE ACTION WAAW
            $this->stocks_model->delete($id);
            $newid = $id - 1;
            $this->stocks_model->delete($newid);

            /// REDIRECT
            redirect('reports/transferarticlesbydate/' . $data['stock']->stock);
        } else {
            $this->_load_view('confirmtransdelete', $data);
        }


        if ($this->form_validation->run() === FALSE) {
            
        } else {
            
        }
    }

    /**
     * Edit Expedier article
     */
    function editexp($id) {

        $this->form_validation->set_rules('article_id', 'Article', 'exact_length[7]|integer|required|callback_rolekey_exists');
        $this->form_validation->set_rules('qty1', 'qty1', 'numeric');
        $this->form_validation->set_rules('qty2', 'qty1', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty3', 'qty3', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty4', 'qty4', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty5', 'qty5', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty6', 'qty6', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty7', 'qty7', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty8', 'qty8', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty9', 'qty9', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty10', 'qty10', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty11', 'qty11', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty12', 'qty12', 'numeric|greater_than[-1]');
        $this->form_validation->set_rules('qty13', 'qty13', 'numeric|greater_than[-1]');

        $data['result'] = $this->db->query('SELECT  id,name FROM `suppliers` ')->result();

        //We take the row that have the id= $id

        $data['stock'] = $this->stocks_model->get($id);

        if (empty($data['stock'])) {
            show_404();
        }


        //show in the title page (Edit article $article_id)
        $data['title'] = 'Edit ' . $data['stock']->article_id;


        //iza awal mara 3m yefta7 el page 2aw fe error
        if ($this->form_validation->run() == FALSE) {
            $this->_load_view('editexp', $data);
        } else {

            // THE EDIT ACTION
            $this->stocks_model->updatetrans($id);


            /// REDIRECT
            redirect('reports/expedierarticlesbydate');
        }
    }

    //Delete Expedier from stock table
    function deleteexp($id) {
        $data['stock'] = $this->stocks_model->get($id);

        if (empty($data['stock'])) {
            show_404();
        }

        $data['title'] = 'Delete ' . $data['stock']->article_id;

        // RETURN FALSE IN 2 CASES, FIRST when loading the form for the first time,
        // ORR FAKARI In case of validation errors , y3ne btkune b34dik n3ssene bhl halee

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // THE DELETE ACTION WAAW
            $this->stocks_model->delete($id);
            $newid = $id - 1;
            $this->stocks_model->delete($newid);

            /// REDIRECT
            redirect('reports/expedierarticlesbydate/');
        } else {
            $this->_load_view('confirmexpdelete', $data);
        }


        if ($this->form_validation->run() === FALSE) {
            
        } else {
            
        }
    }

}

/* End of file Stocks.php */
/* Location: ./application/controllers/stockes.php */
