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
        //session_start();
		parent::__construct();
        $this->is_logged_in(); 
        //load database model
        $this->load->model('bookModel');
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->library('table');
    }

    public function index(){
        //$this->table->set_heading('ISBN','Title', 'Price (£)');
        $this->refreshBookSelected();
        
        //Config
        $config['base_url'] = site_url()."/userController/index";
        $config['total_rows'] = $this->db->get('books')->num_rows();
        $config['num_links'] = 4;
        $config['per_page'] = 7;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        //Initial
        $this->pagination->initialize($config);

        $this->db->select('id, isbn, title, pub_price, selected');
        $_data = $this->db->get('books', $config['per_page'], $this->uri->segment(3));

        $this->db->select('books.id');
        $this->db->from('books');
        $this->db->join('submitted_list',' books.id = submitted_list.book_id');
        $this->db->where('books.id = submitted_list.book_id');
        
        $_selected = $this->db->get();

        $data = array(
            '_data' => $_data,
            '_selected' => $_selected
        );

        $this->load->view('inc/header');
        $this->load->view('userControlPageView', $data);


        ///Testing area
        //print_r($numberOfBooks);
        //$this->load->view('userControlPageView');
    }

    //Refresh the selected option in books.selected
    function resetSelected(){
        //reset books.selected
        $data = array(
            'selected' => '0'
        );
        $this->db->update('books', $data);
        //$this->db->where('id',1);
    }
    public function refreshBookSelected(){              
        $this->resetSelected();
        //Get the submitted_list
        $this->db->select('books.id');
        $this->db->from('books');
        $this->db->join('submitted_list',' books.id = submitted_list.book_id');
        $this->db->where('books.id = submitted_list.book_id');
        $_selected = $this->db->get();

        //update books.selected base on submitted_list
        foreach ($_selected->result() as $row){
            $data = array(
                'selected' => '1'
            );
            $this->db->where('id',$row->id);
            $this->db->update('books',$data);
        }
//print_r($_selected->row()->id);


    }

    public function getSelectedBook(){
        //TODO Submit selected book to Database.
        //print_r($_POST);

        //Get id of the user via email_address
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('users.email_address',$this->session->userdata("email_address"));
        //print_r($this->db->get()->result());
        $user_id = $this->db->get()->row();
//        print_r($user_id);
        //echo $user_id->id;
        //print_r($this->input->post());
        $i=1;
        foreach ($this->input->post() as $row){
            if($i<sizeof($this->input->post())){
                $data = array(
                    'book_id' => $row,
                    'user_id' => $user_id->id
                );
                $this->db->insert('submitted_list',$data);

                //update selected in books table
                $this->db->where ('id',$row);
                $data = array(
                    'selected' => '1'
                );
                if($this->db->update('books',$data))
                    echo "Selected books are submitted";
                else
                    echo "Fail";
            }
            $i++;
        }

        $this->index();

        //print_r($data);
        //$this->db->insert();


        //echo $this->session->userdata('email_address');
    }

    function is_logged_in(){
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in != true){
            //$this->load->view('login');
            redirect('loginController');
        }
        
    }

}//end class
?>
