
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Authorization</title>
    <link type='text/css' rel='stylesheet' href='<?=base_url()?>css/login.css'>
    <script type="text/javascript" src="<?=base_url()?>js/jquery-1.5.1.min.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){
                    $("input[name='email_address']").focus();
                    $("input").keypress(function(e){
                            if(e.which == 13) $('form').submit();
                    });
                    $('input').click(function(){
                            $(this).select();
                    });
            });
    </script>
</head>
<body id="login-screen">
    <?
        $err = validation_errors();
        if(!empty($err)) echo "<div class='error'>$err</div>";
    ?>
    <?=form_open('loginController')?>
    <img alt="logo"  id="logo" src="<?=base_url()?>img/logo.gif" /><br />
    <h1>Library Books Selection</h1>
    <?php
        echo form_label('Email:', 'email_address');
        echo form_input('email_address',set_value('email_address'),'id="email_address" autofocus');
        echo "<br />";
        echo form_label('Password:', 'password');
        echo form_password('password','','id="password"');
        echo "<br /> <br />";
        echo form_label('&nbsp;', 'submit');
        echo form_submit('submit', 'Login');
        echo '<br style="clear:both;" />';
        echo form_close();
     ?>


    
    <div id="copyright">
        <p>Library version 1.0 beta </p>
        <p>&copy; <?php echo('2012'); ?> <a href="#" target="_blank">Universiti Teknologi PETRONAS</a></p>
    </div>
</body>
</html>
