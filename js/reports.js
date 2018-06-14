var items_per_page = 12;

function OnBodyLoaded()
{
    LoadReports(1);
}

function LoadReports(page)
{
    var keywords = $("#keywords_input").val();
    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "CountReports",
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
                function: "GetReports",
                index: (page - 1) * items_per_page,
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
    var current = parseInt($(sender).parent().attr("current_page"));
    if (current - 1 > 0)
    {
        if (action == 1)
        {
            LoadContacts(current - 1);
        }
        else
        {
            LoadMaterials(current - 1);
        }
    }
}

function OnNextPageClicked()
{
    var current = parseInt($(sender).parent().attr("current_page"));
    var total = parseInt($(sender).parent().attr("total_pages"));
    if (current + 1 <= total)
    {
        if (action == 1)
        {
            LoadContacts(current + 1);
        }
        else
        {
            LoadMaterials(current + 1);
        }
    }
}

function OnInputChanged()
{
    LoadReports(1);
}