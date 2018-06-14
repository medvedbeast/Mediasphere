var items_per_page = 12;
var user_id;

function OnBodyLoaded(user)
{
    user_id = user;
    LoadContacts(1);
}

function LoadContacts(page)
{
    var keywords = $("#keywords_input").val();
    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "CountOwnedContacts",
                id: user_id,
                keywords: keywords
            },
            success: function (data)
            {
                var pages = Math.ceil(parseInt(data) / items_per_page);
                $(".page_controlls").attr("current_page", page);
                $(".page_controlls").attr("total_pages", pages);
                $(".page_controlls .text").html("Сторінка " + page + " / " + pages);
            },
            error: function (data)
            {
                alert("При завантаженні даних сталася помилка!");
                console.log(data);
            }
        });
    request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "GetOwnedContacts",
                index: (page - 1) * items_per_page,
                id: user_id,
                quantity: items_per_page,
                keywords: keywords
            },
            success: function (data)
            {
                $("#results").html(data);
            },
            error: function (data)
            {
                alert("При завантаженні даних сталася помилка!");
                console.log(data);
            }
        });
}

function OnPreviousPageClicked()
{
    var current = parseInt($(".page_controlls").attr("current_page"));
    if (current - 1 > 0)
    {
        LoadContacts(current - 1);
    }
}

function OnNextPageClicked()
{
    var current = parseInt($(".page_controlls").attr("current_page"));
    var total = parseInt($(".page_controlls").attr("total_pages"));
    if (current + 1 <= total)
    {
        LoadContacts(current + 1);
    }
}