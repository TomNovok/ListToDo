var color1 = "white";       //фон ячеек
var color2 = "#92FCD5";
var color3 = "lightblue";   //сегодня
var color4 = "#CDFFF0";
var color5 = "#333333";
var color6 = "#C4D3EA";
var color7 = "lightblue";   //шапка с днями недели
var color8 = "#6487AE";
var color9 = "#FFF799";
//var color10 = "#0431B4";    //текущий день
var color11 = "black";       //шапка с днями недели

var updobj;

var mn=new Array('Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентрябрь','Октябрь','Ноябрь','Декабрь');
var mnn=new Array('31','28','31','30','31','30','31','31','30','31','30','31');
var mnl=new Array('31','29','31','30','31','30','31','31','30','31','30','31');
var calvalarr=new Array(42);

// Calendar script
var now = new Date;
var sccd=now.getDate();
var sccm=now.getMonth();
var sccy=now.getFullYear();
var ccm=now.getMonth();
var ccy=now.getFullYear();

// For current selected date
var selectedd, selectedm, selectedy;

function getObj(objID)
{
    if (document.getElementById) {return document.getElementById(objID);}
    else if (document.all) {return document.all[objID];}
    else if (document.layers) {return document.layers[objID];}
}

function checkClick(e)
{
	/*e?evt=e:evt=event;
	CSE=evt.target?evt.target:evt.srcElement;
	if (CSE.tagName!='SPAN')
	if (getObj('fc'))
		if (!isChild(CSE,getObj('fc')))
			getObj('fc').style.display='none';*/
}

function isChild(s,d)
{
	while(s) {
		if (s==d)
			return true;
		s=s.parentNode;
	}
	return false;
}

function Left(obj)
{
	var curleft = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curleft += obj.offsetLeft
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)
		curleft += obj.x;
	return curleft;
}

function Top(obj)
{
	var curtop = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curtop += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (obj.y)
		curtop += obj.y;
	return curtop;
}

function addEvent(elem, evType, fn)
{
    if (elem.addEventListener) {
        elem.addEventListener(evType, fn, false);
    }
    else if (elem.attachEvent) {
        elem.attachEvent('on' + evType, fn)
    }
    else {
        elem['on' + evType] = fn
    }
}

function createCalendar()
{  
    document.write('<table onmousewheel=\"onWheel(event);\" id="fc" style" cellpadding="2">');
    document.write('<tr onselectstart="return false"><td style="cursor:pointer;font-size:15px" onclick="upmonth(-1)">&laquo;</td><td colspan="5" id="mns" align="center"></td><td align="right" style="cursor:pointer;font-size:15px" onclick="upmonth(1)">&raquo;</td></tr>');
    document.write('<tr style="background:'+color7+';font-size: 12px; border: 1px solid #ccc; color:'+color11+'"><td align=center>П</td><td align=center>В</td><td align=center>С</td><td align=center>Ч</td><td align=center>П</td><td align=center>С</td><td align=center>В</td></tr>');
    addEvent(document.getElementById('fc'), 'DOMMouseScroll', function(event) {onWheel(event)});
    for(var kk=1;kk<=6;kk++)
    {
        document.write('<tr>');
        for(var tt=1;tt<=7;tt++)
        {
            num=7 * (kk-1) - (-tt);
            document.write('<td id="cv' + num + '" class=\'calendar__cell\'>&nbsp;</td>');
        }
        document.write('</tr>');
    }
    document.write('<tr><td colspan="7" align="center" style="cursor:pointer;font-size:13px;background:'+color3+'" onclick="today()">Сегодня: '+addnull(sccd,sccm+1,sccy)+'</td></tr>');
    document.write('</table>');
    //document.all?document.attachEvent('onclick',checkClick):document.addEventListener('click',checkClick,false);
    
    prepcalendar('',ccm,ccy);
}

function lcs(ielem)
{
	updobj=ielem;
	getObj('fc').style.left=Left(ielem)+'px';
	var h = ielem.offsetHeight-230;
	getObj('fc').style.top=Top(ielem)+h+'px';
	getObj('fc').style.display='';

	// First check date is valid
	curdt=ielem.value;
	curdtarr=curdt.split('-');
	isdt=true;
	for(var k=0;k<curdtarr.length;k++) {
		if (isNaN(curdtarr[k]))
			isdt=false;
	}
	if (isdt&(curdtarr.length==3)) {
		ccm=curdtarr[1]-1;
		ccy=curdtarr[2];

		selectedd=parseInt ( curdtarr[0], 10 );
		selectedm=parseInt ( curdtarr[1]-1, 10 );
		selectedy=parseInt ( curdtarr[2], 10 );

		prepcalendar(curdtarr[0],curdtarr[1]-1,curdtarr[2]);
	}

}

function evtTgt(e)
{
	var el;
	if(e.target)el=e.target;
	else if(e.srcElement)el=e.srcElement;
	if(el.nodeType==3)el=el.parentNode; // defeat Safari bug
	return el;
}

function EvtObj(e)
{
    if(!e)
        e=window.event;
    return e;
}

function cs_over(e)
{
	evtTgt(EvtObj(e)).style.color = "blue";
}

function cs_out(e)
{
	evtTgt(EvtObj(e)).style.color = "black";
}

function cs_click(e)
{
	//updobj.value=calvalarr[evtTgt(EvtObj(e)).id.substring(2,evtTgt(EvtObj(e)).id.length)];
	//getObj('fc').style.display='none';
	var str = calvalarr[evtTgt(EvtObj(e)).id.substring(2,evtTgt(EvtObj(e)).id.length)];
	var str2 = addnull(now.getDate(),now.getMonth()+1,now.getFullYear());
	myFunction(str2, str);
}

function f_cps(obj)
{
	obj.style.background=color1;
	obj.style.fontSize='10px';
	obj.style.color=color5;
	obj.style.textAlign='center';
	obj.style.textDecoration='none';
	obj.style.border='1px solid #ccc';//'1px solid #606060';
	obj.style.cursor='pointer';
}

function f_cpps(obj)
{
	obj.style.background=color6;
	obj.style.fontSize='10px';
	obj.style.fontWeight="700";
	obj.style.textAlign='center';
	obj.style.textDecoration='line-through';
	obj.style.border='1px solid ' + color8;
	obj.style.cursor='default';
}

function f_hds(obj)
{
	obj.style.background=color9;
	obj.style.color=color5;
	obj.style.textAlign='center';
	obj.style.border='1px solid ' + color8;
	obj.style.cursor='pointer';
}

// day selected
function prepcalendar(hd,cm,cy)
{
	now=new Date();
	sd=now.getDate();
	td=new Date();
	td.setDate(1);
	td.setFullYear(cy);
	td.setMonth(cm);
	cd=td.getDay();
	if (cd==0)cd=6; else cd--;
	getObj('mns').innerHTML=mn[cm]+'&nbsp;<span style="cursor:pointer" onclick="upmonth(-12)">&lt;</span>'+cy+'<span style="cursor:pointer" onclick="upmonth(12)">&gt;</span>';
	marr=((cy%4)==0)?mnl:mnn;
	for(var d=1;d<=42;d++) {
		cv=getObj('cv'+parseInt(d));
		f_cps(cv);
		if ((d >= (cd -(-1)))&&(d<=cd-(-marr[cm]))) {
			dip=((d-cd < sd)&&(cm==sccm)&&(cy==sccy));
			htd=((hd!='')&&(d-cd==hd));

			cv.onmouseover=cs_over;
			cv.onmouseout=cs_out;
			cv.onclick=cs_click;

			// if today
			if (sccm == cm && sccd == (d-cd) && sccy == cy)
				cv.style.fontWeight="700";
            else
                cv.style.fontWeight="100";

			// if selected date
			if (cm == selectedm && cy == selectedy && selectedd == (d-cd) )
			{
				cv.style.background=color4;
				//cv.style.color='#e0d0c0';
				//cv.style.fontSize='1.1em';
				//cv.style.fontStyle='italic';
				//cv.style.fontWeight='bold';

				// when use style.background
				cv.onmouseout=null;
			}

			cv.innerHTML=d-cd;

			calvalarr[d]=addnull(d-cd,cm-(-1),cy);
            
            checkAndFill(cv, calvalarr[d]);
		}
		else
        {
			cv.innerHTML='&nbsp;';
			cv.onmouseover=null;
			cv.onmouseout=null;
			cv.onclick=null;
			cv.style.cursor='default';
		}
	}
}

function upmonth(s)
{
	marr=((ccy%4)==0)?mnl:mnn;

	ccm+=s;
	if (ccm>=12)
	{
		ccm-=12;
		ccy++;
	}
	else if(ccm<0)
	{
		ccm+=12;
		ccy--;
	}
	prepcalendar('',ccm,ccy);
}

function today()
{
	//updobj.value=addnull(now.getDate(),now.getMonth()+1,now.getFullYear());
	//addnull(now.getDate(),now.getMonth()+1,now.getFullYear());
	//getObj('fc').style.display='none';
	var str = addnull(now.getDate(),now.getMonth()+1,now.getFullYear());
    
    ccd=now.getDate();
    ccm=now.getMonth();
    ccy=now.getFullYear();

	prepcalendar('',ccm,ccy);
	//myFunction(str, str);
}

function addnull(d,m,y)
{
	var d0='',m0='';
	if (d<10)d0='0';
	if (m<10)m0='0';

	return ''+d0+d+'-'+m0+m+'-'+y;
}

function myFunction(date_today, date)
{
		var arr = date.split('-');
		var Date1 = new Date(parseInt(arr[2]), parseInt(arr[1]-1), parseInt(arr[0]));
		var arr = date_today.split('-');
		var Date2 = new Date(parseInt(arr[2]), parseInt(arr[1]-1), parseInt(arr[0]));
		var Days = Date2.getDay() + Math.floor((Date1.getTime() - Date2.getTime())/(1000*60*60*24)) - 1;
		var Weeks = Days/7;
		var abs = Math.abs(Math.floor(Weeks));
        abs--;
		if (Weeks >= 0)
        {
            //makeRequest('frontWeek',  abs, '/planseditor/index/');
            location = "/main/page/"+abs;
        }
		else
        {
            //makeRequest('backWeek',  '-'+abs, '/planseditor/index/');
            location = "/main/page/-"+abs;
        }
}

function onWheel(e)
{
    e?evt=e:evt=window.event;
    e=evt;
    e.preventDefault ? e.preventDefault() : (e.returnValue = false);
    if (e.wheelDelta)
    {
        // IE, Opera, safari, chrome - кратность дельта равна 120
        delta = Math.round(e.wheelDelta/120);
    }
    else if (e.detail)
    {
        // Mozilla, кратность дельта равна 3
        delta = -Math.round(e.detail/3);
    }
    while (delta < -12)
        delta+=12;
	upmonth(-delta);
}

function printTime()
{
   name_month=new Array ("января","февраля","марта", "апреля","мая", "июня","июля","августа","сентября", "октября","ноября","декабря");
   name_day=new Array ("Воскресенье","Понедельник", "Вторник","Среда","Четверг", "Пятница","Суббота");
   var time=new Date();
   time_sec=time.getSeconds();
   time_min=time.getMinutes();
   time_hours=time.getHours();
   var time_wr=((time_hours<10)?"0":"")+time_hours;
   time_wr+=":";
   time_wr+=((time_min<10)?"0":"")+time_min;
   time_wr+=":";
   time_wr+=((time_sec<10)?"0":"")+time_sec;
   time_wr=name_day[time.getDay()]+", "+time.getDate()+" "+name_month[time.getMonth()]+" "+time.getFullYear()+" г. время "+time_wr;
   document.getElementById('clock').innerHTML = time_wr;
}

function checkAndFill(elem, date)
{
    dates1 = document.getElementById('dates_json');
    if (dates1)
    {
        dd_arr = date.split("-");
        dd_arr = dd_arr.reverse();
        date = dd_arr.join("-");
        dates_arr = dates1.textContent.split(",");
        for (i=0; i<dates_arr.length; i++)
        {
            if (dates_arr[i] == date)
            {
                elem.style.backgroundColor = "#E6E6E6";
            }
        }
    }
}