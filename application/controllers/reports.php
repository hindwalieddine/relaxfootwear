<?php

class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }


    private function _load_view($view , $data) {
        $this->load->view('templates/header', $data);
        $this->load->view('reports/' . $view , $data);
        $this->load->view('templates/footer', $data);
    }



    function SalesByArticle() {

        $data['title'] = 'Sales By Article';
        //$where = 'where ';
        //$and = $where;
        $and =array();
        $data['from'] = $this->input->get('from');
        $data['to'] = $this->input->get('to');
        $data['from_article'] = $this->input->get('from_article');
        $data['to_article'] = $this->input->get('to_article');

        if($data['from']){
            $and[]= " `date` >= '{$data['from']}' ";
        }
        if($data['to']){
            $and[]= " `date` <= '{$data['to']}' ";
        }

        if($data['from_article']){
            $and[]= " S1.`ARTICLE_ID` >= '{$data['from_article']}' ";
        }
        if($data['to_article']){
            $and[]= " S1.`ARTICLE_ID` <= '{$data['to_article']}' ";
        }
        $ands='';
        if(count($and))
            {
                $ands=' WHERE ( '.implode('AND', $and).' )';
            }

         $data['result'] = $this->db->query('
SELECT
	S1.ARTICLE_ID,S2.TOTAL,S1.QTY1,S1.QTY2,S1.QTY3,S1.QTY4,S1.QTY5,S1.QTY6,S1.QTY7,S1.QTY8,S1.QTY9,S1.QTY10,S1.QTY11,S1.QTY12,S1.QTY13,s2.date
FROM
	(
	SELECT
		ARTICLE_ID,date,
		-(SUM(QTY1)+SUM(QTY2)+SUM(QTY3)+SUM(QTY4)+SUM(QTY5)+SUM(QTY6)+SUM(QTY7)+SUM(QTY8)+SUM(QTY9)+SUM(QTY10)+SUM(QTY11)+SUM(QTY12)+SUM(QTY13)) AS TOTAL
	FROM
		STOCK
	WHERE
		ARTICLE_ID IN
				(
				SELECT article_id
				FROM stock
				WHERE ACTION =3
				GROUP BY article_id
				)
		AND ACTION=3
	GROUP BY ARTICLE_ID
	)
	AS S2
INNER JOIN
	(
	SELECT
		ARTICLE_ID,
		SUM(QTY1) AS qty1,
		SUM(QTY2) AS qty2,
		SUM(QTY3) AS qty3,
		SUM(QTY4) AS qty4,
		SUM(QTY5) AS qty5,
		SUM(QTY6) AS qty6,
		SUM(QTY7) AS qty7,
		SUM(QTY8) AS qty8,
		SUM(QTY9) AS qty9,
		SUM(QTY10) AS qty10,
		SUM(QTY11) AS qty11,
		SUM(QTY12) AS qty12,
		SUM(QTY13) AS qty13
	FROM
		STOCK
	WHERE
		ARTICLE_ID IN (
				SELECT ARTICLE_ID
				FROM stock
				WHERE ACTION =3
				GROUP BY article_id
				)
		GROUP BY ARTICLE_ID
	)
AS S1

ON S1.ARTICLE_ID=S2.ARTICLE_ID

'.$ands.'
')->result();

        $this->_load_view('sales_by_article', $data);

    }
   function InsertedArticlesByDate() {

        $data['title'] = 'Inserted Articles';
       // $data['actionId'] = '';
       // $where = 'WHERE action= '.$actionId;

        $data['from'] = $this->input->get('from');
        $data['to'] = $this->input->get('to');

        $where = 'where action = 1 ';

        if($data['from']){
            $where .= " AND `date` >= '{$data['from']}' ";
        }
        if($data['to']){
            $where .= " AND `date` <= '{$data['to']}' ";
        }


        $data['result'] = $this->db->query('SELECT
                id,
                article_id,
                qty1,
                qty2,
                qty3,
                qty4,
                qty5,
                qty6,
                qty7,
                qty8,
                qty9,
                qty10,
                qty11,
                qty12,
                qty13,
                date
                FROM `stock` '. $where . ' order by date,article_id')->result();

        $this->_load_view('inserted_articles_by_date', $data); 

    }

       function TransferArticlesByDate($stockId=-1) {

        $data['title'] = 'Transfered Articles';
        
        $data['from'] = $this->input->get('from');
        $data['to'] = $this->input->get('to');
        $data['stockId'] = $stockId;
        $and = '';
        if($stockId!=-1){$and = 'AND stock='.$data['stockId'];}
        

        if($data['from']){
            $and .= " AND `date` >= '{$data['from']}' ";
        }
        if($data['to']){
            $and .= " AND `date` <= '{$data['to']}' ";
        }

        
        $data['result'] = $this->db->query('SELECT 
                id,
                article_id,
                qty1,
                qty2,
                qty3,
                qty4,
                qty5,
                qty6,
                qty7,
                qty8,
                qty9,
                qty10,
                qty11,
                qty12,
                qty13,
                date
            FROM `stock`
            WHERE `action`=2 '. $and .' AND `qty1`>-1
            AND `qty2` >-1
            AND `qty3`>-1
            AND `qty4`>-1
            AND `qty5` >-1
            AND `qty6`>-1
            AND `qty1`>-1
            AND `qty8` >-1
            AND `qty9`>-1
            AND `qty10`>-1
            AND `qty11` >-1
            AND `qty12`>-1
            AND `qty13`>-1  order by date, article_id')->result();
     /*   echo "SELECT
                id,
                article_id,
                qty1,
                qty2,
                qty3,
                qty4,
                qty5,
                qty6,
                qty7,
                qty8,
                qty9,
                qty10,
                qty11,
                qty12,
                qty13,
                date
            FROM `stock`
            WHERE `action`=2 '. $and .' AND `qty1`>-1
            AND `qty2` >-1
            AND `qty3`>-1
            AND `qty4`>-1
            AND `qty5` >-1
            AND `qty6`>-1
            AND `qty1`>-1
            AND `qty8` >-1
            AND `qty9`>-1
            AND `qty10`>-1
            AND `qty11` >-1
            AND `qty12`>-1
            AND `qty13`>-1  order by date"; */
        
        $this->_load_view('transfer_articles_by_date', $data);
                }



        function ExpedierArticlesByDate() {

        $data['title'] = 'Transfered Articles';

        $data['from'] = $this->input->get('from');
        $data['to'] = $this->input->get('to');
        $and = '';

        if($data['from']){
            $and .= " AND `date` >= '{$data['from']}' ";
        }
        if($data['to']){
            $and .= " AND `date` <= '{$data['to']}' ";
        }


        $data['result'] = $this->db->query('SELECT
                id,
                article_id,
                qty1,
                qty2,
                qty3,
                qty4,
                qty5,
                qty6,
                qty7,
                qty8,
                qty9,
                qty10,
                qty11,
                qty12,
                qty13,
                date
            FROM `stock`
            WHERE `action`=4 '. $and .' AND `qty1`>-1
            AND `qty2` >-1
            AND `qty3`>-1
            AND `qty4`>-1
            AND `qty5` >-1
            AND `qty6`>-1
            AND `qty1`>-1
            AND `qty8` >-1
            AND `qty9`>-1
            AND `qty10`>-1
            AND `qty11` >-1
            AND `qty12`>-1
            AND `qty13`>-1  order by date, article_id')->result();

        $this->_load_view('expedier_articles_by_date', $data);
                }
    
}