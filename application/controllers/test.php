<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author chlang
 */
class Test extends CI_Controller{
    //put your code here

    public function  __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index(){
        echo site_url();
    }

}
?>
