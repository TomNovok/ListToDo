<?php $attributes = array('class' => 'information__form'); ?>
<?php echo form_open('/information/$url_name', $attributes); ?>
    <textarea name='text_<?php echo $id_m ?>'
              id='text_<?php echo $id_m ?>'
              tabindex='1'
              onkeyup="KeyPressInTextarea('edit', event);"
              class='information__textarea'><?php echo $content ?></textarea>
    <!--input type='button'
           value='Сохранить'
           name='btnSaveText_<?php echo $id_m ?>'
           id='btnSaveText_<?php echo $id_m ?>'
           tabindex='2'
           class='information__button'
           onclick="makeRequest('saveInfo', '<?php echo $id_m ?>', '/information/infoeditor/<?php echo $url_name ?>');"
    >
    <input type='reset'
           value='Отменить'
           name='btnCancelText_<?php echo $id_m ?>'
           id='btnCancelText_<?php echo $id_m ?>'
           tabindex='3'
           class='information__button'
           onclick=''
    -->
<?php echo form_close(); ?>