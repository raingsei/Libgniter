<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Datagrid
 *
 * @author chlang
 */
class Datagrid {
    //put your code here
    /*
     * Fields
     */
    private $hide_pk_col = true;
    private $hide_cols = array();
    private $tbl_name = '';
    private $pk_col = '';
    private $headings = array();
    private $tbl_fields = array();

    /*
     *
     */

    public function __construct($tbl_name, $pk_col = 'id'){
       $this->CI =& get_instance();
       $this->CI->load->database();
       $this->tbl_fields = $this->CI->db->list_fields($tbl_name);
       if(!in_array($pk_col,$this->tbl_fields)){
          throw new Exception("Primary key column '$pk_col' not found in table '$tbl_name'");
       }
       $this->tbl_name = $tbl_name;
       $this->pk_col = $pk_col;
       $this->CI->load->library('table');
    }

    public function setHeadings (array $headings){
        $this -> headings = array_merge($this->headings, $headings);
    }

    public function ignoreFields(array $fields){
        foreach($fields as $f){
            if($f!=$this->pk_col)
            $this->hide_cols[] = $f;
        }
    }

    public function hidePkCol($bool){
        $this->hide_pk_col = (bool)$bool;
    }

    private function _selectFields(){
       foreach($this->tbl_fields as $field){
          if(!in_array($field,$this->hide_cols)){
             $this->CI->db->select($field);
             // hide pk column heading?
             if($field==$this->pk_col && $this->hide_pk_col) continue;
                $headings[]= isset($this->headings[$field]) ? $this->headings[$field] : ucfirst($field);
          }
       }
       if(!empty($headings)){
          // prepend a checkbox for toggling
          array_unshift($headings,"<input type='checkbox' class='check_toggler'>");
          $this->CI->table->set_heading($headings);
       }

    }//instance function

}
?>
