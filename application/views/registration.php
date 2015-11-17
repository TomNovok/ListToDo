<?php require_once("header.php"); ?>
<body>
    <div class='auth__ground-table'>   
        <div class='auth__ground-table-cell'>
            <div id='registration' class='auth__login-form'> 
                <?php echo form_open(''); ?>
                    <div>
                        <label for="full_name"><div class='auth__label'>Полное имя</div>
                            <input id="full_name" class='auth__input-text' maxlength='30' name="full_name" type="text" value="<?php echo set_value('full_name'); ?>" autocomplete='off'>
                        </label>
                        <?php echo form_error('full_name', '<div class="error_style">', '</div>'); ?>
                    </div>
                    <div>
                        <label for="email"><div class='auth__label'>Email</div>
                            <input id="email" class='auth__input-text' maxlength='30' name="email" type="text" value="<?php echo set_value('email'); ?>" autocomplete='off'>
                        </label>
                        <?php echo form_error('email', '<div class="error_style">', '</div>'); ?>
                    </div>
                    <div>
                        <label for="username"><div class='auth__label'>Логин</div>
                            <input id="username" class='auth__input-text' maxlength='30' name="username" type="text" value="<?php echo set_value('username'); ?>" autocomplete='off'>
                        </label>
                        <?php echo form_error('username', '<div class="error_style">', '</div>'); ?>
                    </div>
                    <div>
                        <label for="password"><div class='auth__label'>Пароль</div>
                            <input id="password" class='auth__input-text' maxlength='30' name="password" type="password" value="<?php echo set_value('password'); ?>">
                        </label>
                        <?php echo form_error('password', '<div class="error_style">', '</div>'); ?>
                    </div>
                    <div>
                        <label for="passconf"><div class='auth__label'>Подтверждение пароля</div>
                            <input id="passconf" class='auth__input-text' name="passconf" type="password" value="<?php echo set_value('passconf'); ?>">
                        </label>
                        <?php echo form_error('passconf', '<div class="error_style">', '</div>'); ?>
                    </div>
                    <input name="registrate" class='auth__button' type= "submit" value="Зарегистрироваться">
                    <div class='auth__question'>Уже зарегистрированы?<br><a tabindex='-1' class='auth__link' href= "/login">Войти</a></div>
               <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<?php require_once("footer.php"); ?>