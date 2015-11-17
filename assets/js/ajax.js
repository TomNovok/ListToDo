function ajaxAddPlan(id)
{
    ids = document.getElementById('dates_json').textContent;
    dd = ids.split(",");
    d = dd[id];
    var input = document.getElementById('planNewEditText_'+id).value;
    if (input == "")
    {
        alert("Поле не должно быть пустым");
        return;
    }
    var params = 'planNewEditText_'+id+'='+ input + '&_id_='+ id + '&_date_='+ d + '&time=' + getCurrentTime() + '&planNewBtnOk_'+id+'=';
    $.ajax
    (
        {
            url: "/planseditor/index/",                          
            dataType: "html",
            type: "POST",
            data: params,
            beforeSend: function (data, textStatus)
            {
                setInProgress(data, textStatus);
            },
            error: function (data, textStatus)
            {
                setError(data, textStatus);
            },
            complete: function (data, textStatus)
            {
                setDone(data, textStatus);
            },
            success: function (data, textStatus)
            {
                str = deleteCommentsHtml(data);
                parent = document.getElementById("td_"+id);
                last_child = document.getElementById("planNewHiddenDiv_"+id);
                var div = document.createElement('div');
                div.innerHTML = str;
                var elements = div.childNodes;
                idd = getIdNumFromName(elements[0].id);
                parent.insertBefore(elements[0], last_child);
                parent.insertBefore(elements[1], last_child);
                hidePlanWidgets(idd);
                hideNewPlanWidgets(id);             
                ids = document.getElementById('ids_of_plans_json').textContent;
                if (ids != "") 
                {
                    plans_ids = ids.split(",");
                    plans_ids.push(idd);
                    ids = plans_ids.join(",");
                    document.getElementById('ids_of_plans_json').textContent = ids;
                }
                else
                    document.getElementById('ids_of_plans_json').textContent = idd;
            }
        }
    );
}

function ajaxSavePlan(id)
{
    var input = document.getElementById('planEditText_'+id).value;
    if (input == "")
    {
        alert("Поле не должно быть пустым");
        return;
    }
    var params = 'planEditText_'+id+'='+ input + '&_id_='+ id + '&time=' + getCurrentTime() + '&planBtnOk_'+id+'=';
    $.ajax
    (
        {
            url: "/planseditor/index/",                          
            dataType: "html",
            type: "POST",
            data: params,
            beforeSend: function (data, textStatus)
            {
                setInProgress(data, textStatus);
            },
            error: function (data, textStatus)
            {
                setError(data, textStatus);
            },
            complete: function (data, textStatus)
            {
                setDone(data, textStatus);
            },
            success: function (data, textStatus)
            {
                var input = document.createElement('input');
                input.type='button';
                input.id='planBtnDel2_'+id;
                input.name='planBtnDel2_'+id;
                input.className='table__small-buttons';
                input.value='';
                input.title='Удалить';
                input.onclick="deleteButtonPressed(event);";
                input.style.right = "0px";
                input.style.backgroundImage = "url('../../assets/images/cross.svg')";
                document.getElementById("planDiv_"+id).textContent = document.getElementById('planEditText_'+id).value;
                document.getElementById("planDiv_"+id).appendChild(input);
                hidePlanWidgets(id);
            }
        }
    );
}

function ajaxDeletePlan(id)
{
    var params = '_id_='+ id + '&planBtnDel_'+id+'=';
    $.ajax
    (
        {
            url: "/planseditor/index/",                          
            dataType: "html",
            type: "POST",
            data: params,
            beforeSend: function (data, textStatus)
            {
                setInProgress(data, textStatus);
            },
            error: function (data, textStatus)
            {
                setError(data, textStatus);
            },
            complete: function (data, textStatus)
            {
                setDone(data, textStatus);
            },
            success: function (data, textStatus)
            {
                document.getElementById("planDiv_"+id).parentNode.removeChild(document.getElementById("planDiv_"+id));
                document.getElementById("planHiddenDiv_"+id).parentNode.removeChild(document.getElementById("planHiddenDiv_"+id));
                ids = document.getElementById('ids_of_plans_json').textContent;
                if (ids != "") 
                {
                    plans_ids = ids.split(",");
                    for (i=0; i<plans_ids.length; i++)
                    {
                        if (plans_ids[i] == id)
                        {
                            plans_ids.splice(i, 1);
                        }
                    }
                    ids = plans_ids.join(",");
                    document.getElementById('ids_of_plans_json').textContent = ids;
                }
            }
        }
    );
}

function ajaxMovePlan(id)
{
    var params = '_id_='+ id.id + '&time=' + getCurrentTime() + '&newDate=' + id.date;
    $.ajax
    (
        {
            url: "/planseditor/index/",                          
            dataType: "html",
            type: "POST",
            data: params,
            beforeSend: function (data, textStatus)
            {
                setInProgress(data, textStatus);
            },
            error: function (data, textStatus)
            {
                setError(data, textStatus);
            },
            complete: function (data, textStatus)
            {
                setDone(data, textStatus);
            },
            success: function (data, textStatus)
            {
                
            }
        }
    );
}

function ajaxBackWeek(id)
{
    i = +id-1;
    var params = '_id_='+ i + '&week_back=';
    $.ajax
    (
        {
            url: "/planseditor/index/",                          
            dataType: "html",
            type: "POST",
            data: params,
            beforeSend: function (data, textStatus)
            {
                setInProgress(data, textStatus);
            },
            error: function (data, textStatus)
            {
                setError(data, textStatus);
            },
            complete: function (data, textStatus)
            {
                setDone(data, textStatus);
            },
            success: function (data, textStatus)
            {
                str = deleteCommentsHtml(data);
                id--;
                document.getElementById("working_area").innerHTML = str;
                history.pushState(null, null, "/main/page/"+id);
                prepcalendar('',sccm,sccy);
            }
        }
    );
}

function ajaxFrontWeek(id)
{
    i = +id+1;
    var params = '_id_='+ i + '&week_front=';
    $.ajax
    (
        {
            url: "/planseditor/index/",                          
            dataType: "html",
            type: "POST",
            data: params,
            beforeSend: function (data, textStatus)
            {
                setInProgress(data, textStatus);
            },
            error: function (data, textStatus)
            {
                setError(data, textStatus);
            },
            complete: function (data, textStatus)
            {
                setDone(data, textStatus);
            },
            success: function (data, textStatus)
            {
                str = deleteCommentsHtml(data);
                id++;
                document.getElementById("working_area").innerHTML = str;
                history.pushState(null, null, "/main/page/"+id);
                prepcalendar('',sccm,sccy);
            }
        }
    );
}

function ajaxSaveInfo(id, handler)
{
    t = document.getElementById("text_"+id).value;
    var params = '_id_='+ id + '&text='+ t + '&btnSaveText_'+id + "=";
    $.ajax
    (
        {
            async: false,
            url: handler,                          
            dataType: "html",
            type: "POST",
            data: params,
            beforeSend: function (data, textStatus)
            {
                setInProgress(data, textStatus);
            },
            error: function (data, textStatus)
            {
                setError(data, textStatus);
            },
            complete: function (data, textStatus)
            {
                setDone(data, textStatus);
            },
            success: function (data, textStatus)
            {
                
            }
        }
    );
}

function ajaxAddMenuItem(id, handler)
{
    var input = document.getElementById('menuEditItem_'+id).value;
    if (input == "")
    {
        alert("Поле не должно быть пустым");
        return;
    }
    array = ["Ежедневник"];   
    ids = document.getElementById('ids_menu_items').textContent;
    if (ids != "") 
    {
        info = ids.split(",");
        for (i=0; i<info.length; i++)
        {
            array.push(document.getElementById("menuItemDiv_" + info[i]).textContent);
        }
    }
    if (array.indexOf(input) != -1)
    {
        alert("Вкладка с таким именем уже существует");
        return;
    }
    var params = 'menuEditItem_'+id+'='+ input + '&_id_='+ id + '&menuBtnOk_'+id+'=';
    $.ajax
    (
        {
            url: handler,                          
            dataType: "html",
            type: "POST",
            data: params,
            beforeSend: function (data, textStatus)
            {
                setInProgress(data, textStatus);
            },
            error: function (data, textStatus)
            {
                setError(data, textStatus);
            },
            complete: function (data, textStatus)
            {
                setDone(data, textStatus);
            },
            success: function (data, textStatus)
            {
                str = deleteCommentsHtml(data);
                /*parent = document.getElementById("ulul");
                var li = document.createElement('li');
                li.innerHTML = str;
                parent.appendChild(li);
                
                ids = document.getElementById('ids_menu_items').textContent;
                idd = getIdNumFromName(li.childNodes[2].id);
                ids_menu_items = ids.split(",");
                ids_menu_items.push(idd);
                ids = ids_menu_items.join(",");
                document.getElementById('ids_menu_items').textContent = ids;

                allMenuButtonsHide();*/
                location.replace(str);
            }
        }
    );
}

function ajaxSaveMenuItem(id, handler)
{
    var input = document.getElementById('menuEditItem_'+id).value;
    if (input == "")
    {
        alert("Поле не должно быть пустым");
        return;
    }
    array = ["Ежедневник"];   
    ids = document.getElementById('ids_menu_items').textContent;
    if (ids != "") 
    {
        info = ids.split(",");
        for (i=0; i<info.length; i++)
        {
            array.push(document.getElementById("menuItemDiv_" + info[i]).textContent);
        }
    }
    if (array.indexOf(input) != -1)
    {
        alert("Вкладка с таким именем уже существует");
        return;
    }
    var params = 'menuEditItem_'+id+'='+ input + '&_id_='+ id + '&menuEditItemBtnOk_'+id+'=';
    $.ajax
    (
        {
            url: handler,                          
            dataType: "html",
            type: "POST",
            data: params,
            beforeSend: function (data, textStatus)
            {
                setInProgress(data, textStatus);
            },
            error: function (data, textStatus)
            {
                setError(data, textStatus);
            },
            complete: function (data, textStatus)
            {
                setDone(data, textStatus);
            },
            success: function (data, textStatus)
            {
                str = deleteCommentsHtml(data);
                location.replace(str);
                /*o1 = document.getElementById("menuItemDiv_"+id);
                o2 = document.getElementById("menuEditItem_"+id);
                o1.textContent = o2.value;
                allMenuButtonsHide();
                history.pushState(null, null, "/information/"+str);*/
            }
        }
    );
}

function ajaxDelMenuItem(id, handler)
{
    var params = '_id_='+ id + '&menuEditItemBtnDel_'+id+'=';
    $.ajax
    (
        {
            url: handler,                          
            dataType: "html",
            type: "POST",
            data: params,
            beforeSend: function (data, textStatus)
            {
                setInProgress(data, textStatus);
            },
            error: function (data, textStatus)
            {
                setError(data, textStatus);
            },
            complete: function (data, textStatus)
            {
                setDone(data, textStatus);
            },
            success: function (data, textStatus)
            {
                str = deleteCommentsHtml(data);
                location.replace(str);
            }
        }
    );
}


function ajaxSetMenuStatus(status)
{
    var params = '_status_='+ status;
    $.ajax
    (
        {
            url: "/ajaxcontroller/index/",                          
            dataType: "html",
            type: "POST",
            data: params,
            beforeSend: function (data, textStatus)
            {
                setInProgress(data, textStatus);
            },
            error: function (data, textStatus)
            {
                setError(data, textStatus);
            },
            complete: function (data, textStatus)
            {
                setDone(data, textStatus);
            },
            success: function (data, textStatus)
            {
            }
        }
    );
}

function ajaxChangePage(url, event)
{
    event.preventDefault ? event.preventDefault() : (event.returnValue=false); //не переходить по ссылке а
    $.ajax
    (
        {
            url: url,                          
            dataType: "html",
            type: "POST",
            beforeSend: function (data, textStatus)
            {
                setInProgress(data, textStatus);
            },
            error: function (data, textStatus)
            {
                setError(data, textStatus);
            },
            complete: function (data, textStatus)
            {
                setDone(data, textStatus);
            },
            success: function (data, textStatus)
            {
                $("body").fadeOut(100, function()
                    {
                        document.documentElement.innerHTML = data;
                        $("body").fadeIn(300);
                        history.pushState(null, null, url);
                    });
            }
        }
    );
}

function deleteCommentsHtml(string)
{
    b = string.indexOf("<!--");
    e = string.lastIndexOf("-->");
    if (b!=-1 && e!=-1)
    {
        str = string.substring(0, b) + string.substring(e+3);
    }
    else
        str = string;
    return str;
}

function setInProgress(data, textStatus)
{
    document.getElementById("alt").innerHTML = "Загрузка <i class='fa fa-spinner fa-spin'></i>";
    $('#alt').fadeIn(300);
}

function setDone(data, textStatus)
{
    document.getElementById("alt").textContent = "Завершено";
    $('#alt').fadeIn(300);
    setTimeout(function() { $('#alt').fadeOut(300); }, 500);
}

function setError(data, textStatus)
{
    document.getElementById("alt").textContent = "Ошибка";
    $('#alt').fadeIn(300);
    setTimeout(function() { $('#alt').fadeOut(300); window.location = location.href; location.reload();}, 1000);
}

function getCurrentTime()
{
    now = new Date();
    month = now.getMonth()+1;
    return now.getFullYear() + "-" + month + "-" + now.getDate() + " " + now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
}