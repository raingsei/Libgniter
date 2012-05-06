<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bookModel
 *
 * @author chlang
 */
class BookModel extends CI_Model {
    //put your code here
    function  __construct() {
        parent::__construct();
    }

    //Get list of book
    public function getAllBooks(){
        $query = $this->db->get('books');
        if($query->num_rows>0){
            return $query->result();
        }
        return FALSE;
    }

    //Determine the number of rows
    public function countAllBooks(){
        return $this->db->count_all('books');
    }

}
?>
