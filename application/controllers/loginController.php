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
class LoginController extends CI_Controller {
    //put your code here
    public function  __construct() {
        session_start();
        parent::__construct();
    }

    public function index(){
        //echo sha1("password"); die();
        //if(!isset($_SESSION['username'])){
            //TODO: Check here again WHY?
            //redirect('loginController');
           //$this->load->view('login');
        //}
        //else $this->load->view('login');

        $this->load->library('session');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email_address', 'Email Address', 'valid_email|required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

        if ( $this->form_validation->run() !== false ) {
            // then validation passed. Get from db
            $this->load->model('adminModel');
            $res = $this
                  ->adminModel
                  ->verifyUser(
                    $this->input->post('email_address'),
                    $this->input->post('password')
              );

            if ( $res !== false ) { //user login successfully
                //$_SESSION['username'] = $this->input->post('email_address');
                $data = array(
                            'email_address' => $this->input->post('email_address'),
                            'is_logged_in' => true
			);
		$this->session->set_userdata($data);

                //Check what type of user
                //print_r($res);
                //print_r($res->id);
                if($res->isAdmin == FALSE && $res->isHOD == FALSE){
                    redirect('userController');
                }
                else if($res->isHOD == TRUE && $res->isAdmin==FALSE){ // if he is HOD
                    redirect ('hodController');
                }
                else{
                    redirect('adminController');
                }
                //redirect('welcome');
             }
        }
        $this->load->view('login');

    }//Index

    public function logout(){
        $this->session->sess_destroy();
        $this->load->view('login');
        //redirect('loginController');
    }
}
?>
