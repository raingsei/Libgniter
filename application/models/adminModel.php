<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminModel
 *
 * @author chlang
 */
class AdminModel extends CI_Model {
    //put your code here
    function  __construct() {
        parent::__construct();
    }

    public function verifyUser($email, $password){
        $query = $this->db->where('email_address', $email)
                ->where('password',  sha1($password))
                ->limit(1)
                ->get('users');

        if($query->num_rows>0){
            return $query->row();
        }
        return false;
    }

    function validate(){
        $this->db->where('email_address', $this->input->post('email_address'));
        $this->db->where('password', sh1($this->input->post('password')));
        $query = $this->db->get('users');
        if($query->num_rows == 1){
            return true;
        }
        return false;
    }

    function getUsers($a, $b){
        $this->db->select('first_name, last_name,email_address,isHOD');
        if($this->db->get('users'))
            return $this->db->get('users',$a,$b);
        return false;

    }

}//end class
?>
