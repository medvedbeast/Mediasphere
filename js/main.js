function OnPopularItemMouseOver(sender)
{
    $(sender).find(".back").addClass("visible");
}

function OnPopularItemMouseOut(sender)
{
    $(sender).find(".back").removeClass("visible");
}

function OnSearchClicked()
{
    var text = $("#search").val();
    window.location.href = "search.php?category=celebrities&query=" + encodeURIComponent(text);
}