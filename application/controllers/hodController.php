<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hodController
 *
 * @author chlang
 */
class HodController extends CI_Controller {
    //put your code here
    public function  __construct() {
        parent::__construct();

        //Check if the user already login
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in != true){
            //$this->load->view('login');
            redirect('loginController');
        }

        //load database model
        $this->load->model('SubmittedListModel');
        // $this->load->helper('url');
        // $this->load->library('pagination');
        // $this->load->library('table');
    }

    public function index(){
		
		//Config
        $config['base_url'] = site_url()."/hodController/index";
        $config['total_rows'] = $this->db->get('submitted_list')->num_rows();
        $config['num_links'] = 4;
        $config['per_page'] = 7;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';
		
		$this->pagination->initialize($config);
		
		//select from database
		$this->db->select('books.id, books.isbn,books.title,books.pub_price,submitted_list.approved');
        $this->db->from('books');
        $this->db->join('submitted_list','books.id=submitted_list.book_id');
		$this->db->where('books.id = submitted_list.book_id');
		$this->db->limit($config['per_page'],$this->uri->segment(3));
		
		$data['_data'] = $this->db->get();
		
		
        $this->load->view('inc/header');
        $this->load->view('hodControlPageView',$data);
    }

    //Get approved list submitted
    public function getApprovedBook(){

        //$this->resetApproved();

        //update the approvedList in database
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
                $this->db->insert('approved_list',$data);
            $i++;
            }//if
        }
        $this->index();



        //print_r ($_POST);
    }

    //Reset
    function resetApproved(){
        //reset books.selected
        $data = array(
            'approved' => '0'
        );
        $this->db->update('submitted_list', $data);
        //$this->db->where('id',1);
    }

    public function refreshBookApproved(){
        $this->resetSelected();
        //Get the submitted_list
        $this->db->select('books.id');
        $this->db->from('books');
        $this->db->join('approved_list',' books.id = submitted_list.book_id');
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

}
?>
