<!DOCTYPE html>
<html lang="en">
<head>
    <meta content=""  charset="utf-8">
    <title>Welcome to Library</title>

<style type="text/css">
    .leftFloat{
        width: 150px;
        float: left;
        margin: auto;
    }
    .rightFloat{
        float: right;
    }
    #toolbar{
        width: 150px;
        margin: auto;
        font-family: helvetica, arial;
    }
    #container {
     width: 600px;
     margin: auto;
     font-family: helvetica, arial;
    }

    table {
     width: 600px;
     margin-bottom: 10px;
    }

    td {
     border-right: 1px solid #aaaaaa;
     padding: 1em;
    }

    td:last-child {
     border-right: none;
    }

    th {
     text-align: left;
     padding-left: 1em;
     background: #cac9c9;
    border-bottom: 1px solid white;
    border-right: 1px solid #aaaaaa;
    }

    #pagination a, #pagination strong {
     background: #e3e3e3;
     padding: 4px 7px;
     text-decoration: none;
    border: 1px solid #cac9c9;
    color: #292929;
    font-size: 13px;
    }

    #pagination strong, #pagination a:hover {
     font-weight: normal;
     background: #cac9c9;
    }
</style>
</head>
<body>
    <div>
        <p>Hello Lecturer!!! <?=anchor ('loginController/logout','Logout')?></p>
    </div>
    <div>
        <div class="leftFloat" id="toolbar">
            <h4>Notification</h4>
        </div>

        <div class="leftFloat" id="container">
            <h4>List of books to select</h4>
            <?php echo $this->table->generate($_data); ?>
            <?php echo $this->pagination->create_links(); ?>
            
        </div>
    </div>

    <div style="clear: both;" >
<?php
    //$this->pagination->create_links();
    //print_r($_bookList[0]->id);
?>
    </div>
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
	$('tr:odd').css('background', '#e3e3e3');
</script>
</body>
</html>
