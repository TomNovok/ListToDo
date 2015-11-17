<div class='contacts__container'>
    <div class='contacts__text'><?php echo $content ?></div>
    <div class='contacts__feedback'>
        <?php echo form_open(''); ?>
            <div>
                <label for="full_name" class='contacts__labellabel'><div class='contacts__label'>Имя отправителя</div>
                    <input id="full_name" class='contacts__input' name="full_name" type="text" value="<?php if ($is_press=='yes') echo set_value('full_name'); if ($is_press=='no') echo $user_info['name']; ?>" autocomplete='off'>
                <?php echo form_error('full_name', '<div class="error_style">', '</div>'); ?>
                </label>
            </div>
            <div>
                <label for="email" class='contacts__labellabel'><div class='contacts__label'>Контактный email</div>
                    <input id="email" class='contacts__input' name="email" type="text" value="<?php if ($is_press=='yes') echo set_value('email'); if ($is_press=='no') echo $user_info['email']; ?>" autocomplete='off'>
                <?php echo form_error('email', '<div class="error_style">', '</div>'); ?>
                </label>
            </div>
            <div>
                <label for="subject" class='contacts__labellabel'><div class='contacts__label'>Тема сообщения</div>
                <?php
                    if ($s == "Ошибка в работе сайта")
                        $s1 = "selected";
                    else
                        $s1 = "";
                    if ($s == "Предложение по улучшению сайта")
                        $s2 = "selected";
                    else
                        $s2 = "";
                    if ($s == "Другой вопрос")
                        $s3 = "selected";
                    else
                        $s3 = "";
                ?>
                <select class='contacts__input' id="subject" name="subject">
                    <option value="Ошибка в работе сайта" <?php echo $s1; ?>>Ошибка в работе сайта</option>
                    <option value="Предложение по улучшению сайта" <?php echo $s2; ?>>Предложение по улучшению сайта</option>
                    <option value="Другой вопрос" <?php echo $s3; ?>>Другой вопрос</option>
                </select>
                </label>
            </div>
            <div>
                <label for="message" class='contacts__labellabel'><div class='contacts__label'>Текст сообщения</div>
                    <textarea id="message" class='contacts__textarea' name="message" type="text" autocomplete='off'><?php echo set_value('message'); ?></textarea>
                <?php echo form_error('message', '<div class="error_style">', '</div>'); ?>
                </label>
            </div>
            <div class='contacts__buttons-container'>
                <input type='submit'
                       value='Отправить'
                       name='btnSendQuestion'
                       id='btnSendQuestion'
                       class='contacts__button'
                >
                <input type='reset'
                       value='Отмена'
                       name='btnCancelSendQuestion'
                       id='btnCancelSendQuestion'
                       class='contacts__button'
                >
            </div>
            <div class='contacts__info-message' id='info_message'><?php if (isset($ans)) echo $ans; ?></div>
        <?php echo form_close(); ?>
    </div>
</div>