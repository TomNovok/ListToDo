<a  onmouseover='onMenuItemMouseOver(<?php echo $id_info ?>, event);'
    onmouseout='onMenuItemMouseOut(<?php echo $id_info ?>, event);'
    ondragstart = 'return false;'
    tabindex='-1'
    id = 'link_a_<?php echo $id_info ?>'
    href='<?php echo "/information/".$url_name ?>'
    class='menu__list-item-link <?php echo $cl ?> newlinks'>
    <div    class='menu__list-item-div'
            id='menuItemDiv_<?php echo $id_info ?>'
            onclick=""><?php echo $info ?></div>
    <input  type='button'
            name='button_edit_<?php echo $id_info ?>'
            id='button_edit_<?php echo $id_info ?>'
            class='menu__small-buttons'
            onclick='onPencilClicked(<?php echo $id_info ?>, event);'
            value=''
            title='Изменить'
            style="right: 0px; background-image: url('../../assets/images/edit.svg');">
</a>
<div class='menu__edit-widgets-div' id='editWidgetsDiv_<?php echo $id_info ?>'>
    <input  type='text'
            maxlength='19'
            autocomplete='off'
            name='menuEditItem_<?php echo $id_info ?>'
            id='menuEditItem_<?php echo $id_info ?>'
            value='<?php echo $info ?>'
            class='menu__edit-tab'
            onkeyup="KeyPressInMenuItem('edit', <?php echo $id_info ?>, event);">
    <input  type='button'
            name='menuEditItemBtnOk_<?php echo $id_info ?>'
            id='menuEditItemBtnOk_<?php echo $id_info ?>'
            onclick="ajaxSaveMenuItem('<?php echo $id_info ?>', '<?php echo $handler ?>');"
            class='menu__small-buttons'
            value=''
            title='Сохранить'
            style="right: 32px; background-image: url('../../assets/images/save.svg');">
    <input  type='button'
            name='menuEditItemBtnDel_<?php echo $id_info ?>'
            id='menuEditItemBtnDel_<?php echo $id_info ?>'
            onclick="ajaxDelMenuItem('<?php echo $id_info ?>', '<?php echo $handler ?>');"
            class='menu__small-buttons'
            value=''
            title='Удалить'
            style="right: 16px; background-image: url('../../assets/images/trash.svg');">
    <input  type='reset'
            onclick='allMenuButtonsHide();'
            name='menuEditItemBtnCancel_<?php echo $id_info ?>'
            id='menuEditItemBtnCancel_<?php echo $id_info ?>'
            class='menu__small-buttons'
            value=''
            title='Отменить'
            style="right: 0px; background-image: url('../../assets/images/block.svg');">
</div>