<?php echo form_open(''); ?>
    <div class='cabinet__container'>
        <?php
            if ($what_m == "1")
            {
                $h1='cabinet__table';
                $h2='cabinet__none';
                $h3='cabinet__link-form-active';
                $h4='';
            }
            else
            {
                $h1='cabinet__none';
                $h2='cabinet__table';
                $h4='cabinet__link-form-active';
                $h3='';
            }
        ?>
        <div class='cabinet__link-container'>
            <a class='cabinet__link-form <?php echo $h3; ?>' onclick='chooseData(event);' id='a1'>Личные данные</a>
            <a class='cabinet__link-form <?php echo $h4; ?>' onclick='chooseData(event);' id='a2'>Сменить пароль</a>
        </div>
        <div id='data_login' class='cabinet__data-login <?php echo $h1; ?>'>
            <div id='f1'>
                <label for="full_name" class='cabinet__labellabel'><div class='cabinet__label'>Полное имя</div>
                    <input id="full_name" class='cabinet__input' name="full_name" type="text" value="<?php if ($is_press=='yes') echo set_value('full_name'); if ($is_press=='no') echo $user_info['name']; ?>" autocomplete='off'>
                <?php echo form_error('full_name', '<div class="error_style">', '</div>'); ?>
                </label>
            </div>
            <div id='f2'>
                <label for="email" class='cabinet__labellabel'><div class='cabinet__label'>Email</div>
                    <input id="email" class='cabinet__input' name="email" type="text" value="<?php if ($is_press=='yes') echo set_value('email'); if ($is_press=='no') echo $user_info['email']; ?>" autocomplete='off'>
                <?php
                    if (isset ($err_email))
                        echo "<div class='error_style'>$err_email</div>";
                    else
                        echo form_error('email', '<div class="error_style">', '</div>');
                ?>
                </label>
            </div>
            <div id='f3'>
                <label for="username" class='cabinet__labellabel'><div class='cabinet__label'>Логин</div>
                    <input id="username" class='cabinet__input' name="username" type="text" value="<?php if ($is_press=='yes') echo set_value('username'); if ($is_press=='no') echo $user_info['login']; ?>" autocomplete='off'>
                <?php
                    if (isset ($err_login))
                        echo "<div class='error_style'>$err_login</div>";
                    else
                        echo form_error('username', '<div class="error_style">', '</div>');
                ?>
                </label>
            </div>
            <div class='cabinet__buttons-container'>
                <input type='submit'
                       value='Изменить'
                       name='btnSaveUserInfo'
                       id='btnSaveUserInfo'
                       class='cabinet__button'
                >
                <input type='reset'
                       value='Отмена'
                       name='btnCancelUserInfo'
                       id='btnCancelUserInfo'
                       class='cabinet__button'
                >
            </div>      
        </div>
        <div id='data_password' class='cabinet__data-password <?php echo $h2; ?>'>
            <div id='f4'>
                <label for="cpassword" class='cabinet__labellabel'><div class='cabinet__label'>Текущий пароль</div>
                    <input id="cpassword" class='cabinet__input' name="cpassword" type="password" value="<?php if (!isset($ans)) echo set_value('cpassword'); ?>">
                <?php
                    if (isset ($err))
                        echo "<div class='error_style'>$err</div>";
                    else
                        echo form_error('cpassword', '<div class="error_style">', '</div>');
                ?>
                </label>
            </div>
            <div id='f5'>
                <label for="password" class='cabinet__labellabel'><div class='cabinet__label'>Новый пароль</div>
                    <input id="password" class='cabinet__input' name="password" type="password" value="<?php if (!isset($ans)) echo set_value('password'); ?>">
                <?php echo form_error('password', '<div class="error_style">', '</div>'); ?>
                </label>
            </div>
            <div id='f6'>
                <label for="passconf" class='cabinet__labellabel'><div class='cabinet__label'>Подтверждение</div>
                    <input id="passconf" class='cabinet__input' name="passconf" type="password" value="<?php if (!isset($ans)) echo set_value('passconf'); ?>">
                <?php echo form_error('passconf', '<div class="error_style">', '</div>'); ?>
                </label>
            </div>
            <div class='cabinet__buttons-container'>
                <input type='submit'
                       value='Изменить'
                       name='btnChangeUserPassword'
                       id='btnChangeUserPassword'
                       class='cabinet__button'
                >
                <input type='reset'
                       value='Отмена'
                       name='btnCancelUserInfo'
                       id='btnCancelUserInfo'
                       class='cabinet__button'
                >
            </div>
        </div>
        <div class='cabinet__info-message'><?php if (isset($ans)) echo $ans; ?></div>
    </div>
<?php echo form_close(); ?>