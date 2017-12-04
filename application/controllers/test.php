<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    
    function index(){
        
        var_dump( '' == false);
        var_dump( '' === false);
        
    }

}

/* End of file test.php */
/* Location: ./application/controllers/test.php */
