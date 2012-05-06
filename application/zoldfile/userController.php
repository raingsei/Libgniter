<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userController
 *
 * @author chlang
 */
class UserController extends CI_Controller {
    //put your code here
    public function  __construct() {
//        session_start();
        parent::__construct();

        //load database model
        $this->load->model('bookModel');
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->library('table');
    }

    public function index(){
        $this->table->set_heading('ISBN','Title', 'Price (£)');
        //Config
        $config['base_url'] = site_url()."/userController/index";
        $config['total_rows'] = $this->db->get('books')->num_rows();
        $config['num_links'] = 4;
        $config['per_page'] = 5;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        //Initial
        $this->pagination->initialize($config);

        $this->db->select('isbn, title, pub_price');
        $data ['_data'] = $this->db->get('books', $config['per_page'], $this->uri->segment(3));

        $this->load->view('userControlPageView', $data);


        ///Testing area
        //print_r($numberOfBooks);
        //$this->load->view('userControlPageView');
    }

}//end class
?>
