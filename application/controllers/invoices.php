<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoices extends CI_Controller {

    function __construct() {
        parent::__construct();
        // We MUST load the model before using it.
        $this->load->model('invoices_model');
        $this->load->model('articles_model');
    }
    
    function fix1(){
        $orders = $this->db->get('orders')->result();
        foreach ($orders as $order){
            $total = $this->db->query('select SUM(quantity * sale_price) as total from order_details where order_id = ' . $order->id)->row()->total;
            $this->db->query('update orders set total = ' . $total .' where id = '. $order->id);
        }
        echo mysql_affected_rows();
    }
    function fix2(){
        $this->db->query('update order_details set sale_price = -sale_price where sale_price < 0');
        echo mysql_affected_rows();
    }
    

    function index() {
//        $data['title'] = 'Articles Ya helwin';
//        $data['order_articles'] = $this->invoices_model->get();
//
//        $this->load->view('templates/header', $data);
//        $this->load->view('invoices/index', $data);
//        $this->load->view('templates/footer', $data);

        $data['title'] = 'Invoices';
        $where = 'WHERE 1 = 1 ';
        $data['from'] = $this->input->get('from');
        $data['to'] = $this->input->get('to');

        if ($data['from']) {
            $data['from'] = $data['from'];
            $where .= "AND created >= '{$data['from']} 00:00:00'";
            //$data['from'] = $this->input->get('from');
        }

        if ($data['to']) {
            $data['to'] = $data['to'];
            $where .= "AND created <= '{$data['to']} 23:59:59'";
            // $data['to'] = $this->input->get('to');
        }


        $data['countSerie0'] = $this->getArticleCountBetween($data['from'], $data['to'], 0);
        $data['countSerie1'] = $this->getArticleCountBetween($data['from'], $data['to'], 1);
        $data['countSerie2'] = $this->getArticleCountBetween($data['from'], $data['to'], 2);
        $data['countSerie3'] = $this->getArticleCountBetween($data['from'], $data['to'], 3);
        $data['countSerie4'] = $this->getArticleCountBetween($data['from'], $data['to'], 4);
        $data['countSerie5'] = $this->getArticleCountBetween($data['from'], $data['to'], 5);
        $data['countSerie6'] = $this->getArticleCountBetween($data['from'], $data['to'], 6);
        $data['countSerie7'] = $this->getArticleCountBetween($data['from'], $data['to'], 7);
        $data['countSerie8'] = $this->getArticleCountBetween($data['from'], $data['to'], 8);
        $data['countSerie9'] = $this->getArticleCountBetween($data['from'], $data['to'], 9);
        $data['countSerie'] = $this->getArticleCountBetween($data['from'], $data['to']);

        $data['totalSerie0'] = $this->getArticleTotalBetween($data['from'], $data['to'], 0);
        $data['totalSerie1'] = $this->getArticleTotalBetween($data['from'], $data['to'], 1);
        $data['totalSerie2'] = $this->getArticleTotalBetween($data['from'], $data['to'], 2);
        $data['totalSerie3'] = $this->getArticleTotalBetween($data['from'], $data['to'], 3);
        $data['totalSerie4'] = $this->getArticleTotalBetween($data['from'], $data['to'], 4);
        $data['totalSerie5'] = $this->getArticleTotalBetween($data['from'], $data['to'], 5);
        $data['totalSerie6'] = $this->getArticleTotalBetween($data['from'], $data['to'], 6);
        $data['totalSerie7'] = $this->getArticleTotalBetween($data['from'], $data['to'], 7);
        $data['totalSerie8'] = $this->getArticleTotalBetween($data['from'], $data['to'], 8);
        $data['totalSerie9'] = $this->getArticleTotalBetween($data['from'], $data['to'], 9);
        $data['totalSerie'] = $this->getArticleTotalBetween($data['from'], $data['to']);


        $data['result'] = $this->db->query("SELECT id as FactID,customer as Customer,total as Total,created as CreatingDate FROM `orders` $where  order by id desc")->result();
        $this->_load_view('invoiceslist', $data);
    }

    function view($id) {

        $data['invoice'] = $this->invoices_model->get($id);

        if (empty($data['invoice'])) {
            show_404();
        }

        $data['title'] = $data['invoice']->title;

        $this->load->view('templates/header', $data);
        $this->load->view('invoices/view', $data);
        $this->load->view('templates/footer', $data);
    }

    function create() {
        $data['title'] = 'Create New Invoice';

        $this->form_validation->set_rules('article_id[]', 'Article', 'exact_length[7]|integer|required|is_unique[articles.code]');
        $this->form_validation->set_rules('quantity[]', 'Quanity', 'required');
        $this->form_validation->set_rules('cash[]', 'Cash', 'numeric|required');


        //var_dump($this->input->post(), $this->form_validation->run());die;



        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['invoiceId'] = $this->db->query('select (max(id) + 1) as newid from orders')->row()->newid;
            $this->_load_view('create', $data);
        } else {
            $rows = $this->input->post();
            $total = 0;

            for ($i = 0; $i < count($rows['article_id']); $i++) {
                if (!empty($rows['article_id'][$i])) {
                    $total += (float) $rows['cash'][$i];
                }
            }

            $this->db->insert('orders', array('customer' => '', 'sub_total' => '', 'total' => $total));
            $orderId = $this->db->insert_id();
            $success = true;
            reset($rows);


            for ($i = 0; $i < count($rows['article_id']); $i++) {
                $cash = $rows['cash'][$i] / $rows['quantity'][$i];
                if (!empty($rows['article_id'][$i])) {
                    $success &= $this->db->insert('order_details', array(
                        'order_id' => $orderId,
                        'article_id' => $rows['article_id'][$i],
                        'size' => $rows['size'][$i],
                        'quantity' => $rows['quantity'][$i],
                        'sale_price' => abs($cash),
                        'comment' => $rows['comment'][$i])
                    );

                    $this->db->insert('stock', array(
                        'article_id' => $rows['article_id'][$i],
                        'stock' => $rows['stock'][$i],
                        'created' => date('Y-m-d'),
                        'date' => date('Y-m-d'),
                        'action' => 3,
                        "qty" . $rows['size'][$i] => -$rows['quantity'][$i],
                        'note' => $rows['comment'][$i] . ',  OrderId:' . $orderId
                            )
                    );
                }
            }

            if ($success) {
                redirect("invoices/invoice/" . $orderId);
            } else {
                $this->_load_view('failure', $data);
            }
        }
    }

    function delete($id) {
        $data['article'] = $this->invoices_model->get($id);

        if (empty($data['article'])) {
            show_404();
        }

        $data['title'] = 'Delete ' . $data['article']->title;

        // RETURN FALSE IN 2 CASES, FIRST when loading the form for the first time,
        // ORR FAKARI In case of validation errors , y3ne btkune b34dik n3ssene bhl halee

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // THE DELETE ACTION WAAW
            $this->invoices_model->delete($id);

            /// REDIRECT
            redirect('articles');
        } else {
            $this->_load_view('confirmdelete', $data);
        }


        if ($this->form_validation->run() === FALSE) {
            
        } else {
            
        }
    }

    /**
     * Edit
     */
    function edit($id) {

        $this->form_validation->set_rules('code', 'Code', 'exact_length[7]|integer|required|is_unique[articles.code]');
        $this->form_validation->set_rules('title', 'Title', 'min_length[7]|required');
        $this->form_validation->set_rules('purchase_price', 'Purchase Price', 'numeric|required');
        $this->form_validation->set_rules('sale_price', 'Sale Price', 'numeric|required');
        $this->form_validation->set_rules('discount_price', 'Discount Price', 'numeric');





        //We take the row that have the id= $id

        $data['article'] = $this->articles_model->get($id);

        if (empty($data['article'])) {
            show_404();
        }


        //show in the title page (Edit article $code)
        $data['title'] = 'Edit ' . $data['article']->code;


        //iza awal mara 3m yefta7 el page 2aw fe error
        if ($this->form_validation->run() == FALSE) {
            $this->_load_view('edit', $data);
        } else {

            // THE EDIT ACTION
            $this->articles_model->update($id);

            /// REDIRECT
            redirect('articles');
        }
    }

    function insert() {
        $data['title'] = 'Add Articles to stock';

        $this->form_validation->set_rules('article_id', 'Article1', 'exact_length[7]|integer|required');
        $this->form_validation->set_rules('size', 'size1', 'numeric');
        $this->form_validation->set_rules('Quantity', 'Quantity1', 'numeric');
        $this->form_validation->set_rules('sale_price', 'sale_price1', 'numeric');
        $this->form_validation->set_rules('comment', 'comment1', 'numeric');



        if ($this->form_validation->run() == FALSE) {
            $this->_load_view('insert', $data);
        } else {

            // INSERT INTO DATABASEEEEEE
            // I WANT TO CALL THE MODEL


            $success = $this->invoices_model->insert();

            if ($success) {
                $this->_load_view('success_vente', $data);
            } else {
                $this->_load_view('failure', $data);
            }
        }
    }

    private function _load_view($view, $data) {
        $this->load->view('templates/header', $data);
        $this->load->view('invoices/' . $view, $data);
        $this->load->view('templates/footer', $data);
    }

    function invoiceslist($dates = -1) {
        
    }

    function invoice($id) {
        $data['title'] = 'Invoice Number ' . $id;
        // $query="SELECT `order_details`.id, order_id, article_id, size, quantity, sale_price, comment,customer FROM
        //       `orders` LEFT JOIN `order_details` ON `order_details`.`order_id` = `orders`.`id`  WHERE order_id =".$id;
        $query = "SELECT a.sale_price as orgprice,`od`.id,order_id, od.article_id, od.size, od.quantity, od.sale_price, od.comment, o.customer FROM articles AS a,order_details as od, orders as o WHERE `od`.`order_id` = `o`.`id` AND a.code=od.article_id AND order_id =" . $id;
        $data['result'] = $this->db->query($query)->result();
        $data['id'] = $id;
        $this->_load_view('invoice', $data);
    }

    private function getArticleCountBetween($from, $to, $articleId = FALSE) {

        $sql = "SELECT (SUM(quantity)) AS count
                FROM `order_details` 
                JOIN orders ON order_details.order_id = orders.id
                WHERE orders.created >= '$from 00:00:00' AND orders.created <= '$to 23:59:59'";

        if ($articleId !== FALSE) {
            $sql .= " AND article_id LIKE '$articleId%'";
        }
        $result = $this->db->query($sql)->row()->count;
        if (!$result) {
            $result = 0;
        }
        return $result;
    }
    private function getArticleTotalBetween($from, $to, $articleId = FALSE) {

        $sql = "SELECT (SUM(quantity * sale_price)) AS count
                FROM `order_details` 
                JOIN orders ON order_details.order_id = orders.id
                WHERE orders.created >= '$from 00:00:00' AND orders.created <= '$to 23:59:59'";

        if ($articleId !== FALSE) {
            $sql .= " AND article_id LIKE '$articleId%'";
        }
        $result = $this->db->query($sql)->row()->count;
        if (!$result) {
            $result = 0;
        }
        return $result;
    } 

}

/* End of file Invoices.php */
/* Location: ./application/controllers/invoices.php */
