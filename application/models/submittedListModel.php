<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of submittedListModel
 *
 * @author chlang
 */
class SubmittedListModel extends CI_Model {
    //put your code here

    //Select the submitted book from the list
    //Join table selection
    public function getSubmittedBook(){
        $this->db->select("id, isbn, title, pub_price");
        $this->db->from('books');
        $this->db->join('submitted_list','submited_list.book_id=books.id');
        $query = $this->db->get();
        if ($query->num_rows>0)
            return $query;
        return FALSE;
    }
}
?>
