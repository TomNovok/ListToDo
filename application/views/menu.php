<?php $handler = "/menueditor/index/$id_m" ?>
<div class='menu__container'>
    <ul id='ulul' class='menu__list'>
        <?php
            if ($id_m == "-1")
                $cl=" menu__selected";
            else
                $cl="";
            echo "<li><a href='/' id = 'link_a_ezh' tabindex='-1' ondragstart = 'return false;' onmouseover=\"onMenuItemMouseOver('ezh', event);\" onmouseout=\"onMenuItemMouseOut('ezh', event);\" class='menu__list-item-link$cl'>";
            echo "<div class='menu__list-item-div' id='menuItemDiv_ezh'>Ежедневник</div>";
            if ($status_menu == "menu_hide")
            {
                echo "<i class='fa fa-arrow-circle-right menu__small-buttons-i' id='menu_open'></i>";
                echo "<i class='fa fa-arrow-circle-left menu__small-buttons-i' id='menu_hide' style='display: none;'></i>";
            }
            else
            {
                echo "<i class='fa fa-arrow-circle-right menu__small-buttons-i' id='menu_open' style='display: none;'></i>";
                echo "<i class='fa fa-arrow-circle-left menu__small-buttons-i' id='menu_hide'></i>";
            }
            echo "</a></li>";
            $str = array();
            foreach ($navigation_arr as $index => $el)
            {
                $str[]=$el['id_info'];
            }
            $ids_menu_items = implode(",", $str);
            foreach ($navigation_arr as $index => $el)
            {
                $id_info = $el['id_info'];
                $info = $el['title'];
                $url_name = $el['url_name'];
                if ($id_info == $id_m)
                    $cl="menu__selected";
                else
                    $cl="";
                echo "<li class='menu__items $addition3'>";
                require("onemenuitem.php"); 
                echo "</li>";
            }
            if (count($navigation_arr)>=20)
                $hid = " menu__hidden";
            else
                $hid="";
        ?> 
        <li class='<?php echo $hid." ".$addition3 ?> menu__items'>
            <a  class='menu__list-item-link'
                id = 'link_a_plus'
                tabindex='-1' 
                onclick='onPlusClicked(plus);'
                onmouseover="onMenuItemMouseOver('plus', event);"
                onmouseout="onMenuItemMouseOut('plus', event);">
                <div class='menu__list-item-div' id='menuItemDiv_plus'></div>
                <input  type='button'
                        id='button_plus'
                        class='menu__button-plus'
                        title='Добавить'
                        style="background-image: url('../../assets/images/squared-plus.svg');">
                <!--i class="fa fa-plus-square"></i-->
            </a>
            <div class='menu__edit-widgets-div' id='editWidgetsDiv_plus'>
                <input  type='text'
                        maxlength='19'
                        autocomplete='off'
                        name='menuEditItem_plus'
                        id='menuEditItem_plus'
                        class='menu__edit-tab'
                        onkeyup="KeyPressInMenuItem('add', '', event);">
                <input  type='button'
                        name='menuBtnOk_plus'
                        id='menuBtnOk_plus'
                        onclick="ajaxAddMenuItem('plus', '<?php echo $handler ?>');"
                        class='menu__small-buttons'
                        value=''
                        title='Сохранить'
                        style="right: 16px; background-image: url('../../assets/images/save.svg');">
                <input  type='reset'
                        onclick='onCancelClick(event);'
                        name='menuBtnCancel_plus'
                        id='menuBtnCancel_plus'
                        class='menu__small-buttons'
                        value=''
                        title='Отменить'
                        style="right: 0px; background-image: url('../../assets/images/block.svg');">
            </div>
        </li>
    </ul>
    <div id='ids_menu_items' style='display: none'><?php echo $ids_menu_items ?></div>
</div>