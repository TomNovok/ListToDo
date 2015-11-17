function allMenuButtonsHide()
{
    ids = document.getElementById('ids_menu_items').textContent;
    if (ids != "") 
    {
        info = ids.split(",");
        for (i=0; i<info.length; i++)
        {
            id = info[i];
            menuItemDiv = window.document.getElementById('menuItemDiv_'+id);
            editWidgetsDiv =  window.document.getElementById('editWidgetsDiv_'+id);
            menuItemDiv.style.display = "block";
            editWidgetsDiv.style.display = "none";
        }
    }
    button = window.document.getElementById('button_plus');
    menuItemDiv = window.document.getElementById('menuItemDiv_plus');
    editWidgetsDiv = window.document.getElementById('editWidgetsDiv_plus');
    menuItemDiv.style.display = "block";
    button.style.display = "inline";
    editWidgetsDiv.style.display = "none";
}

function onPlusClicked(id)
{
    allMenuButtonsHide();
    menuItemDiv = window.document.getElementById('menuItemDiv_plus');
    button = window.document.getElementById('button_plus');
    editWidgetsDiv = window.document.getElementById('editWidgetsDiv_plus');
    menuEditItem =  window.document.getElementById('menuEditItem_plus');
    menuBtnOk =  window.document.getElementById('menuBtnOk_plus');
    menuBtnCancel =  window.document.getElementById('menuBtnCancel_plus');
    menuItemDiv.style.display = "none";
    button.style.display = "none";
    editWidgetsDiv.style.display = "block";
    menuEditItem.style.display = "inline";
    menuBtnOk.style.display = "inline";
    menuBtnCancel.style.display = "inline";
    menuEditItem.focus();
}
function onPencilClicked(id, event)
{
    event.preventDefault ? event.preventDefault() : (event.returnValue=false); //не переходить по ссылке а
    allMenuButtonsHide();
    menuItemDiv = window.document.getElementById('menuItemDiv_'+id);
    editWidgetsDiv = window.document.getElementById('editWidgetsDiv_'+id);
    menuEditItem =  window.document.getElementById('menuEditItem_'+id);
    menuEditItemBtnOk =  window.document.getElementById('menuEditItemBtnOk_'+id);
    menuEditItemBtnDel =  window.document.getElementById('menuEditItemBtnDel_'+id);
    menuEditItemBtnCancel =  window.document.getElementById('menuEditItemBtnCancel_'+id);
    menuItemDiv.style.display = "none";
    editWidgetsDiv.style.display = "block";
    menuEditItem.style.display = "inline";
    menuEditItemBtnOk.style.display = "inline";
    menuEditItemBtnDel.style.display = "inline";
    menuEditItemBtnCancel.style.display = "inline";
    menuEditItem.value = menuItemDiv.textContent;
    menuEditItem.focus();
    menuEditItem.selectionStart = menuEditItem.value.length;
    event.stopPropagation();
}

function onMenuItemMouseOver(id, e)
{
    evt = window.event || e;
    btns = evt.buttons || evt.button;
    if (!dragObject.elem && btns == 0)
    {
        button = document.getElementById('button_edit_'+id);
        if (button)
        {
            button.style.display = 'inline';
        }
        document.getElementById('link_a_'+id).style.backgroundColor = "#AEF6D8";
        if (id == 'plus')
        {
            plus = window.document.getElementById('button_plus');
            plus.style.opacity = 0.5;
        }
    }
}

function onMenuItemMouseOut(id, e)
{
    evt = window.event || e;
    btns = evt.buttons || evt.button;
    if (!dragObject.elem && btns == 0)
    {
        button = document.getElementById('button_edit_'+id);
        if (button)
        {
            button.style.display = 'none';
        }
        document.getElementById('link_a_'+id).style.backgroundColor = "transparent";
        if (id == 'plus')
        {
            plus = window.document.getElementById('button_plus');
            plus.style.opacity = 0.2;
        }
    }
}

function onCancelClick(event)
{
    window.document.getElementById('menuEditItem_plus').value = '';
    allMenuButtonsHide();
}

function KeyPressInMenuItem(w, id, event)
{    
    var keycode;
    if(!event) var event = window.event;
    if (event.keyCode) keycode = event.keyCode; // IE
    else if(event.which) keycode = event.which; // all browsers
    if (w=="add")
    {
        if (keycode=='27') //esc
        {
            document.getElementById("menuBtnCancel_plus").click();
        }
        if (keycode=='13') //enter
        {
            document.getElementById("menuBtnOk_plus").click();
        }
    }
    if (w=="edit")
    {
        if (keycode=='27') //esc
        {
            document.getElementById("menuEditItemBtnCancel_"+id).click();
        }
        if (keycode=='13') //enter
        {
            document.getElementById("menuEditItemBtnOk_"+id).click();
        }
        if (keycode=='46' && event.ctrlKey==true) //del
        {
            document.getElementById("menuEditItemBtnDel_"+id).click();
        }
    }
}

$(document).ready(function()
{
    $("#menu_hide").click(function(event)
    {
        event.preventDefault ? event.preventDefault() : (event.returnValue=false); //не переходить по ссылке а
        event.stopPropagation();
        //$(".main__middle").animate({"margin-left": "-=232px"}, "slow");
        $(".main__middle").animate({"margin-left": "-=232px", "width": "+=232px"}, "slow", function()
                                         {
                                            $(".main__middle").removeAttr("style");
                                            $(".main__middle").addClass("main__middle-with-hide");
                                            $(".main__calendar").addClass("hide");
                                            ajaxSetMenuStatus("menu_hide");
                                         });
        $(".main__calendar").fadeOut(500);
        $(".menu__items").fadeOut(500);
        $("#menu_hide").fadeOut(100);
        $("#menu_open").fadeIn(100);
        
    });
    $("#menu_open").click(function(event)
    {
        event.preventDefault ? event.preventDefault() : (event.returnValue=false); //не переходить по ссылке а
        event.stopPropagation();
        //$(".main__middle").animate({"margin-left": "+=232px"}, "slow");
        $(".main__middle").animate({"margin-left": "+=232px", "width": "-=232px"}, "slow", function()
                                         {
                                            $(".main__working-area").removeAttr("style");
                                            $(".main__middle").removeClass("main__middle-with-hide");
                                            $(".main__calendar").removeClass("hide");
                                            ajaxSetMenuStatus("menu_open");
                                         });
        $(".main__calendar").fadeIn(500);
        $(".menu__items").fadeIn(500);
        $("#menu_open").fadeOut(100);
        $("#menu_hide").fadeIn(100);
        
    });
});