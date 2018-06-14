var items_per_page = 5;

function OnBodyLoaded()
{
    LoadContacts(1);
    LoadMaterials(1);
}

function LoadContacts(page)
{
    var keywords = $("#pending_contacts input").val();
    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "CountPendingContacts",
                keywords: keywords
            },
            success: function (data)
            {
                var pages = Math.ceil(parseInt(data) / items_per_page);
                $("#pending_contacts .page_controlls").attr("current_page", page);
                $("#pending_contacts .page_controlls").attr("total_pages", pages);
                $("#pending_contacts .page_controlls .text").html("Сторінка " + page + " / " + pages);
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
                function: "GetPendingContacts",
                index: (page - 1) * items_per_page,
                quantity: items_per_page,
                keywords: keywords
            },
            success: function (data)
            {
                $("#pending_contacts .content").html(data);

            },
            error: function (data)
            {
                alert("При завантаженні даних сталася помилка!");
                console.log(data);
            }
        });
}

function LoadMaterials(page)
{
    var keywords = $("#pending_materials input").val();
    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "CountPendingMaterials",
                keywords: keywords
            },
            success: function (data)
            {
                var pages = Math.ceil(parseInt(data) / items_per_page);
                $("#pending_materials .page_controlls").attr("current_page", page);
                $("#pending_materials .page_controlls").attr("total_pages", pages);
                $("#pending_materials .page_controlls .text").html("Сторінка " + page + " / " + pages);
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
                function: "GetPendingMaterials",
                index: (page - 1) * items_per_page,
                quantity: items_per_page,
                keywords: keywords
            },
            success: function (data)
            {
                $("#pending_materials .content").html(data);

            },
            error: function (data)
            {
                alert("При завантаженні даних сталася помилка!");
                console.log(data);
            }
        });
}

function OnPreviousPageClicked(sender, action)
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

function OnNextPageClicked(sender, action)
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

function OnInputChanged(action)
{
    if (action == 1)
    {
        LoadContacts(1);
    }
    else
    {
        LoadMaterials(1);
    }
}