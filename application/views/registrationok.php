<?php require_once("header.php"); ?>
<body>
    <div class='auth__ground-table'>   
        <div class='auth__ground-table-cell'>
            <div id='registration' class='auth__login-form'> 
                <?php echo form_open(''); ?>
                    <div class='auth__message'>Вы успешно зарегистрировались. Теперь вы можете <a class='auth__link' href= "/login">Войти</a>. К вам на почту отправлены ваши данные для входа в систему.</div>
               <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<?php require_once("footer.php"); ?>