
    <div class="leftFloat" id="container">
        <table>
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>HOD?</th>
            </thead>
        <?php
            if(isset($_data)){
                foreach ($_data->result() as $row){
                    echo '<tr>';
                    echo '<td>';
                    echo $row->first_name;
                    echo '</td>';

                    echo '<td>';
                    echo $row->last_name;
                    echo '</td>';

                    echo '<td>';
                    echo $row->email_address;
                    echo '</td>';

                    echo '<td>';
                    if ($row->isHOD) echo 'Yes'; else echo'No';
                    echo '</td>';
                    echo '</tr>';
                }
            }
        ?>
            <tr></tr>
        </table>
        <?php echo $this->pagination->create_links(); ?>
    <?php
        if(isset($_data))
            //echo $this->table->generate($_data);
    ?>
    </div>
    <br style="clear: both;" />
    <?php
        if(isset($_data))
        print_r($_data);
    ?>

<script type="text/javascript" charset="utf-8">
	$('tr:odd').css('background', '#e3e3e3');
</script>
</body>
</html>
