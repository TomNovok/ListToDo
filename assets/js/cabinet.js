function chooseData(e)
{
    evt = window.event || e;
    id = evt.currentTarget.id;
    if (id == "a1")
    {
        document.getElementById("data_login").style.display = "table";
        document.getElementById("data_password").style.display = "none";
        document.getElementById("a1").style.color = "#0431B4";
        document.getElementById("a2").style.color = "black";
        document.getElementById("a1").classList.add("cabinet__link-form-active");
        document.getElementById("a2").classList.remove("cabinet__link-form-active");
    }
    else if (id == "a2")
    {
        document.getElementById("data_password").style.display = "table";
        document.getElementById("data_login").style.display = "none";
        document.getElementById("a1").style.color = "black";
        document.getElementById("a2").style.color = "#0431B4";
        document.getElementById("a2").classList.add("cabinet__link-form-active");
        document.getElementById("a1").classList.remove("cabinet__link-form-active");
    }
}