function toggleVisible(id)
{
    var element = document.getElementById(id);

    if(element.display.style === "none")
    {
        element.style.display = "block";
    }
    else
    {
        element.style.display = "none";
    }
}