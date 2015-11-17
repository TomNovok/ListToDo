window.onkeyup = function (event)
{
};

$(window).load(function() {
    setTimeout(function() {
        $(window).on('popstate', function (e) {
                window.location = location.href;
        });
    }, 0);
});

function deleteButtonPressed(e)
{
    evt = window.event || e;
    evt.preventDefault ? evt.preventDefault() : (evt.returnValue=false);
    evt.stopPropagation();
    target = (evt.currentTarget) ? evt.currentTarget : evt.srcElement;
    _id = getIdNumFromName(target.id);
    ajaxDeletePlan(_id);
}

function allEditPlansHide()
{
    ids = document.getElementById('ids_of_plans_json').textContent;
    if (ids != "") 
    {
        plans_ids = ids.split(",");
        for (i=0; i<plans_ids.length; i++)
        {
            id = plans_ids[i];
            hidePlanWidgets(id);
        }
    }
    for (i=0; i<14; i++)
    {
        hideNewPlanWidgets(i);
    }
}

function openPlanWidgets(e)
{
    evt = window.event || e;
    target = (evt.currentTarget) ? evt.currentTarget : evt.srcElement;
    _id = getIdNumFromName(target.id);
    allEditPlansHide();
    planDiv = window.document.getElementById("planDiv_"+_id);
    planHiddenDiv = window.document.getElementById("planHiddenDiv_"+_id);
    planEditText = window.document.getElementById("planEditText_"+_id);
    planBtnOk = window.document.getElementById("planBtnOk_"+_id);
    planBtnDel = window.document.getElementById("planBtnDel_"+_id);
    planBtnCancel = window.document.getElementById("planBtnCancel_"+_id);
    
    planDiv.style.display = "none";
    planHiddenDiv.style.display = "block";
    planEditText.style.display = "inline";
    planBtnOk.style.display = "inline";
    planBtnDel.style.display = "inline";
    planBtnCancel.style.display = "inline";
    
    planEditText.value = planDiv.textContent;
    planEditText.focus();
    planEditText.selectionStart = planEditText.value.length;
}

function hidePlanWidgets(id)
{
    planDiv = window.document.getElementById("planDiv_"+id);
    planHiddenDiv = window.document.getElementById("planHiddenDiv_"+id);
    planEditText = window.document.getElementById("planEditText_"+id);
    planBtnOk = window.document.getElementById("planBtnOk_"+id);
    planBtnDel = window.document.getElementById("planBtnDel_"+id);
    planBtnCancel = window.document.getElementById("planBtnCancel_"+id);
       
    planDiv.style.display = "block";
    planHiddenDiv.style.display = "none";
    planEditText.style.display = "none";
    planBtnOk.style.display = "none";
    planBtnDel.style.display = "none";
    planBtnCancel.style.display = "none";
}

function openNewPlanWidgets(e)
{
    evt = window.event || e;
    target = (evt.currentTarget) ? evt.currentTarget : evt.srcElement;
    _id = getIdNumFromName(target.id);
    allEditPlansHide();
    planNewHiddenDiv = window.document.getElementById("planNewHiddenDiv_"+_id);
    planNewEditText = window.document.getElementById("planNewEditText_"+_id);
    planNewBtnOk = window.document.getElementById("planNewBtnOk_"+_id);
    planNewBtnCancel = window.document.getElementById("planNewBtnCancel_"+_id);

    planNewHiddenDiv.style.display = "block";
    planNewEditText.style.display = "inline";
    planNewBtnOk.style.display = "inline";
    planNewBtnCancel.style.display = "inline";
    
    planNewEditText.focus();
}

function hideNewPlanWidgets(id)
{
    planNewHiddenDiv = window.document.getElementById("planNewHiddenDiv_"+id);
    planNewEditText = window.document.getElementById("planNewEditText_"+id);
    planNewBtnOk = window.document.getElementById("planNewBtnOk_"+id);
    planNewBtnCancel = window.document.getElementById("planNewBtnCancel_"+id);

    planNewHiddenDiv.style.display = "none";
    planNewEditText.style.display = "none";
    planNewBtnOk.style.display = "none";
    planNewBtnCancel.style.display = "none";
    planNewEditText.value = "";
}

function KeyPressInPlansEditItem(w, e)
{    
    var keycode;
    evt = window.event || e;
    target = (evt.currentTarget) ? evt.currentTarget : evt.srcElement;
    _id = getIdNumFromName(target.id);
    if (evt.keyCode) keycode = evt.keyCode; // IE
    else if(evt.which) keycode = evt.which; // all browsers
    if (w=="add")
    {
        if (keycode=='27') //esc
        {
            document.getElementById("planNewBtnCancel_"+_id).click();
        }
        if (keycode=='13') //enter
        {
            document.getElementById("planNewBtnOk_"+_id).click();
        }
    }
    if (w=="edit")
    {
        if (keycode=='27') //esc
        {
            document.getElementById("planBtnCancel_"+_id).click();
        }
        if (keycode=='13') //enter
        {
            document.getElementById("planBtnOk_"+_id).click();
        }
        if (keycode=='46' && event.ctrlKey==true) //del
        {
            document.getElementById("planBtnDel_"+_id).click();
        }
    }
}
function KeyPressInTextarea(w, e)
{
    var keycode;
    evt = window.event || e;
    target = (evt.currentTarget) ? evt.currentTarget : evt.srcElement;
    _id = getIdNumFromName(target.id);
    if (evt.keyCode) keycode = evt.keyCode; // IE
    else if(evt.which) keycode = evt.which; // all browsers
    if (w=="edit")
    {
        if (keycode=='27') //esc
        {
            document.getElementById("btnCancelText_"+_id).click();
        }
        if (keycode=='13' && event.ctrlKey==true) //enter
        {
            document.getElementById("btnSaveText_"+_id).click();
        }
    }
}
function getIdNumFromName(id_name)
{
    id = id_name.substring(id_name.indexOf("_")+1); 
    //object = document.getElementById(id_name);
    //id = object.id.substring(object.id.indexOf("_")+1);
    return id;
}

function onPlanMouseOver(e)
{
    if (!dragObject.elem)
    {
        evt = window.event || e;
        target = (evt.currentTarget) ? evt.currentTarget : evt.srcElement;
        _id = getIdNumFromName(target.id);
        if (document.getElementById("planDiv_"+_id) != null)
        {
            document.getElementById("planDiv_"+_id).style.backgroundColor = "#E0E6F8";
            document.getElementById("planBtnDel2_"+_id).style.display = "inline";
        }
    }
}
function onPlanMouseOut(e)
{
    if (!dragObject.elem)
    {
        evt = window.event || e;
        target = (evt.currentTarget) ? evt.currentTarget : evt.srcElement;
        _id = getIdNumFromName(target.id);
        if (document.getElementById("planDiv_"+_id) != null)
        {
            document.getElementById("planDiv_"+_id).style.backgroundColor = "transparent";
            document.getElementById("planBtnDel2_"+_id).style.display = "none";
        }
    }
}