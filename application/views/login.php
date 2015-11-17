<?php require_once("header.php"); ?>
<body>
    <div class='auth__ground-table'>   
        <div class='auth__ground-table-cell'>
            <div id='login' class='auth__login-form'>
                <?php echo form_open(''); ?>
                    <div>
                        <label for="username"><div class='auth__label'>Логин</div>
                            <input id="username" class='auth__input-text' maxlength='30' name="username" type="text" value="<?php echo set_value('username'); ?>" autocomplete='off'>
                        <?php echo form_error('username', '<div class="error_style">', '</div>'); ?>
                        </label>
                    </div>
                    <div>
                        <label for="password"><div class='auth__label'>Пароль</div>
                            <input id="password" class='auth__input-text' maxlength='30' name="password" type="password" value="<?php echo set_value('password'); ?>">
                        <?php echo form_error('password', '<div class="error_style">', '</div>'); ?>
                        </label>
                    </div>
                    <div class="error_style"><?php if (isset($error_info)) echo $error_info; ?></div>
                    <input name="login" class='auth__button' type= "submit" value="Войти">
                    <div class='auth__question'>Еще не зарегистрированы?<br><a tabindex='-1' class='auth__link' href="registration">Регистрация</a></div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<?php require_once("footer.php"); ?>