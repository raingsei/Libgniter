<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminController
 *
 * @author chlang
 */
class AdminController extends CI_Controller {
    //put your code here
    public function  __construct() {
        parent::__construct();
        //$this->load->library('session');
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in != true){
            //$this->load->view('login');
            redirect('loginController');
        }
    }

    public function index(){
        //$data['_data']=$this->session->userdata('email_address');
        //echo $this->uri->segment(1); //Controller

        switch($this->uri->segment(3)){
            case 'nonParticipatedUsers':
                //$this->nonParticipatedUsers();
                break;

            case 'uploadBookList':
                echo 'hekkoc';
                //$this->uploadBookList();
                break;

            case 'viewApprovedList':
                //$this->viewApprovedList();
                break;

            case 'viewAllUsers':
               // $this->viewAllUsers();
                break;

            case 'participatedUsers':
                //$this->participatedUsers();
                break;

            default :
                echo 'default Swicth case';
                //$this->load->view('inc/header');
                $this->load->view('adminControlPageView');
                break;
        }
    }

    public function uploadBookList(){
        //TODO Excel to mySQL tool
        
        $this->index();
    }

    public function viewApprovedList(){

    }

    //Display List of all user in Database
    public function viewAllUsers(){
        //Pagination again
        //config
        $config['base_url'] = site_url().'/adminController/users';
        $config['total_rows'] = $this->db->get('users')->num_rows();
        $config['num_links'] = 4;
        $config['per_page'] = 7;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        //Initial
        $this->pagination->initialize($config);

        //Get users
        $this->db->select('first_name, last_name,email_address,isHOD');
        $data['_data'] = $this->db->get('users',$config['per_page'], $this->uri->segment(3));

        $this->load->view('adminView/adminHeaderView');
        $this->load->view('adminView/adminToolbarView');
        $this->load->view('adminView/AllUsersView',$data);

    }

    public function participatedUsers(){
        //Pagination again        

        //config
        $config['base_url'] = site_url().'/adminController/participatedUsers';
        //$config['total_rows'] = $this->db->get('users')->num_rows();
        $config['num_links'] = 4;
        $config['per_page'] = 117;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        //Initial
        $this->pagination->initialize($config);

        //Get users
        $this->db->select('users.id, users.first_name, users.last_name, users.email_address, users.isHOD');
        $this->db->from ('users');
        $this->db->join ('submitted_list','users.id = submitted_list.user_id');
        $this->db->where('users.id = submitted_list.user_id');
        $this->db->limit($config['per_page'],$this->uri->segment(3));

        $data['_data'] = $this->db->get();

        $this->load->view('adminView/adminHeaderView');
        $this->load->view('adminView/adminToolbarView');
        $this->load->view('adminView/participatedLecturerView',$data);
    }

    public function nonParticipatedUsers(){
        
    }


}
?>
