function onLinkOver(e, id)
{
    if (!dragObject.elem)
    {
        document.getElementById(id).style.color = "black";
        document.getElementById(id + "_img").style.opacity = "0.6";
    }    
}

function onLinkOut(e, id)
{
        document.getElementById(id).style.color = "grey";
        document.getElementById(id + "_img").style.opacity = "0.3";
}