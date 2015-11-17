var dragObject = {};
var dropElem = {};
var dropElemPrev = {};
var previusColor;
var previusContent;

document.onmousedown = function(e)
{
  if (e.which != 1) { // если клик правой кнопкой мыши
    return; // то он не запускает перенос
  }

  var elem = e.target.closest('.draggable');

  if (!elem) return; // не нашли, клик вне draggable-объекта

  // запомнить переносимый объект
  dragObject.elem = elem;

  // запомнить координаты, с которых начат перенос объекта
  dragObject.downX = e.pageX;
  dragObject.downY = e.pageY;
}

document.onmousemove = function(e)
{
  if (!dragObject.elem) return; // элемент не зажат

  if ( !dragObject.avatar ) { // если перенос не начат...

    // посчитать дистанцию, на которую переместился курсор мыши
    var moveX = e.pageX - dragObject.downX;
    var moveY = e.pageY - dragObject.downY;
    if ( Math.abs(moveX) < 3 && Math.abs(moveY) < 3 )
    {
      return; // ничего не делать, мышь не передвинулась достаточно далеко
    }

    dragObject.avatar = createAvatar(e); // захватить элемент
    if (!dragObject.avatar)
    {
      dragObject = {}; // аватар создать не удалось, отмена переноса
      return; // возможно, нельзя захватить за эту часть элемента
    }

    // аватар создан успешно
    // создать вспомогательные свойства shiftX/shiftY
    var coords = getCoords(dragObject.avatar);
    dragObject.shiftX = dragObject.downX - coords.left;
    dragObject.shiftY = dragObject.downY - coords.top;

    startDrag(e); // отобразить начало переноса
  }

  // отобразить перенос объекта при каждом движении мыши
  dragObject.avatar.style.left = e.pageX - dragObject.shiftX + 'px';
  dragObject.avatar.style.top = e.pageY - dragObject.shiftY + 'px';

  dropElem = findDroppable(e);
  if (dropElem)
  {
    if (dropElem == dropElemPrev)
    {
      dropElem.style.backgroundColor = "#CEF6EC";
      //dropElem.innerHTML = "Сюда";
     dragObject.avatar.style.cursor = "move";
     dragObject.elem.style.cursor = "move";
    }
    else
    {
      //previusColor = dropElemPrev.style.backgroundColor;
      dropElemPrev.style.backgroundColor = previusColor;
      //dropElemPrev.innerHTML = previusContent;
      previusColor = dropElem.style.backgroundColor;
      //previusContent = dropElem.innerHTML;
      dropElemPrev = dropElem;
    }
    //dropElem.onmouseout = function(){dropElem.style.backgroundColor = "transparent";
  }
  else
  {
      dropElemPrev.style.backgroundColor = previusColor;
      dragObject.avatar.style.cursor = "no-drop";
     // dropElemPrev.innerHTML = previusContent;
  }  
  return false;
}

function createAvatar(e) {

  // запомнить старые свойства, чтобы вернуться к ним при отмене переноса
  var avatar = dragObject.elem;
  var old = {
    parent: avatar.parentNode,
    nextSibling: avatar.nextSibling,
    position: avatar.position || '',
    left: avatar.left || '',
    top: avatar.top || '',
    zIndex: avatar.zIndex || ''
  };

  // функция для отмены переноса
  avatar.rollback = function() {
    old.parent.insertBefore(avatar, old.nextSibling);
    avatar.style.position = old.position;
    avatar.style.left = old.left;
    avatar.style.top = old.top;
    avatar.style.zIndex = old.zIndex
  };

  return avatar;
}

function startDrag(e)
{
  var avatar = dragObject.avatar;
  
  w = avatar.clientWidth;
  //document.body.style.opacity = "0.2";

  document.body.appendChild(avatar);
  avatar.style.zIndex = 9999;
  avatar.style.position = 'absolute';
  if (avatar.clientWidth > w)
  {
    avatar.style.width = w + 'px';
  }
  
  dropElemPrev = findDroppable(e);
  previusColor = dropElemPrev.style.backgroundColor;
  _id = getIdNumFromName(dragObject.elem.id);
  document.getElementById("planBtnDel2_"+_id).style.display = "none";
  avatar.style.paddingRight = "2px";
  //previusContent = dropElemPrev.innerHTML;
}

document.onmouseup = function(e)
{
  // (1) обработать перенос, если он идет
  if (dragObject.avatar)
  {
    finishDrag(e);
  }

  // в конце mouseup перенос либо завершился, либо даже не начинался
  // (2) в любом случае очистим "состояние переноса" dragObject
  dragObject = {};
}

function findDroppable(event)
{
  // спрячем переносимый элемент
  dragObject.avatar.style.display = "none";

  // получить самый вложенный элемент под курсором мыши
  var elem = document.elementFromPoint(event.clientX, event.clientY);

  // показать переносимый элемент обратно
  dragObject.avatar.style.display = "block";

  if (elem == null)
  {
    // такое возможно, если курсор мыши "вылетел" за границу окна
    return null;
  }

  return elem.closest('.droppable');
}

function finishDrag(e)
{
  dropElem = findDroppable(e);
  dragObject.elem.style.cursor = "pointer";

  if (!dropElem)
  {
    dragObject.avatar.rollback();
  }
  else
  {
    dropElem.style.backgroundColor = previusColor;
   //dropElem.innerHTML = previusContent;
    dragObject.elem.style.position = "relative";
    dragObject.elem.style.left = "0px";
    dragObject.elem.style.top = "0px";
    dragObject.elem.style.paddingRight = "15px";
    num = getIdNumFromName(dropElem.id); 
    id = getIdNumFromName(dragObject.elem.id);
    document.getElementById("planDiv_"+id).style.backgroundColor = "transparent";
    dropElem.insertBefore(document.getElementById("planHiddenDiv_"+id), document.getElementById("planNewHiddenDiv_"+num));
    dropElem.insertBefore(dragObject.elem, document.getElementById("planHiddenDiv_"+id));
    ids = document.getElementById('dates_json').textContent;
    dates_json = ids.split(",");
    var obj = {};
    obj.id = id;
    obj.date = dates_json[num];
    ajaxMovePlan(obj);
  }
}

function getCoords(elem)
{
    // (1)
    var box = elem.getBoundingClientRect();
    
    var body = document.body;
    var docEl = document.documentElement;
    
    // (2)
    var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
    var scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;
    
    // (3)
    var clientTop = docEl.clientTop || body.clientTop || 0;
    var clientLeft = docEl.clientLeft || body.clientLeft || 0;
    
    // (4)
    var top = box.top + scrollTop - clientTop;
    var left = box.left + scrollLeft - clientLeft;
    
    return {top: top, left: left};
}