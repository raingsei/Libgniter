<div>
    <div class="leftFloat" id="toolbar">
        <h4>Notification</h4>
    </div>

    <div class="leftFloat" id="container">
        <h4>List of books to select</h4>
        <?=  form_open('userController/getSelectedBook');?>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example1">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Price (£)</th>
                    <th>Select</th>
                </tr>
            </thead>
        <?php
            //echo $this->table->generate($_data);
            foreach ($_data->result() as $row){
                $selected = ' checked="checked"';
                $disabled = ' disabled="disabled"';
                if ($row->selected == 0){
                    $selected = '';
                    $disabled = '';
                }
                echo '<tr>';
                echo '<td>'.$row->isbn.'</td>';
                echo '<td>'.$row->title.'</td>';
                echo '<td>'.$row->pub_price.'</td>';
                echo '<td><input name="id'.$row->id.
                        '" type="checkbox"'.$disabled.' '.
                        $selected.' value="'.
                        $row->id.'" />';
                //.form_checkbox('id'.$row->id,$row->id,$selected,'disabled');
                echo '</td>';
                echo '</tr>';
            }

            echo '<tr>';
            echo '<td colspan="4" align="right">';
            echo form_submit('submit', 'Submit');
            echo '</td>';
            echo '</tr>';
        ?>
        </table>
        <?php echo $this->pagination->create_links(); ?>

        <?=  form_close(); ?>

    </div>
</div>

<div style="clear: both;" >
<?php
//$this->pagination->create_links();
//print_r($_bookList[0]->id);
//print_r($_data);
echo "<br />";
print_r($_selected->result());
?>
</div>
    

<script type="text/javascript" charset="utf-8">
	$('tr:odd').css('background', '#e3e3e3');
</script>
</body>
</html>
