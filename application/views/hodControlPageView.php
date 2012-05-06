<div>
    <div class="leftFloat" id="toolbar">
        <h4>Notification</h4>
    </div>
    <div class="leftFloat" id="container">
        <h4>List of books to select</h4>
        <?=  form_open('hodController/getApprovedBook');?>
        <?php //echo $this->table->generate($_data); ?>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example1">
            <thead>
                <tr>
                    <th width="70px">ISBN</th>
                    <th>Title</th>
                    <th width="70px">Price (£)</th>
                    <th width="70px">Approve</th>
                </tr>
            </thead>
            <tbody>
        <?php
            //echo $this->table->generate($_data);
            foreach ($_data->result() as $row){

                $approved = ' checked="checked" disabled="disabled" ';                
                if ($row->approved == 0){
                    $approved = '';
                }

                echo '<tr>';
                echo '<td>'.$row->isbn.'</td>';
                echo '<td>'.$row->title.'</td>';
                echo '<td>'.$row->pub_price.'</td>';
                echo '<td>'.form_checkbox('id'.$row->id,$row->id,$approved).'</td>';
                echo '</tr>';
            }

            echo '<tr>';
            echo '<td colspan="4" align="right">'.form_submit('submit', 'Submit').'</td>';
            echo '</tr>';
        ?>
            </tbody>
        </table>
        <?php echo $this->pagination->create_links(); ?>
        <?=  form_close(); ?>
        


    </div>
</div>

<div style="clear: both;" >
<?php
//$this->pagination->create_links();
//print_r($_bookList[0]->id);
print_r($_data);
?>
</div>


<script type="text/javascript" charset="utf-8">
	$('tr:odd').css('background', '#e3e3e3');
</script>
</body>
</html>
