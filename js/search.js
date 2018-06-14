var contacts_per_page = 12;
var materials_per_page = 6;

function OnBodyLoaded()
{
    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "GetSphereList"
            },
            success: function (data)
            {
                $("#scope_output").html(data);
            },
            error: function (data)
            {
                alert("При завантаженні даних сталася помилка! Будь-ласка, спробуйте пізніше.");
                console.log(data);
            }
        });
    var action = $(".categories .item.selected").attr("category_id");
    if (action != 6)
    {
        LoadContacts(1);
    }
    else
    {
        LoadMaterials(1);
    }
}

function OnCheckBoxClicked(sender)
{
    var value = $(sender).attr("state");
    if (value == 0)
    {
        $(sender).find(".icon").html("check_box");
        $(sender).attr("state", 1);
    }
    else
    {
        $(sender).find(".icon").html("check_box_outline_blank");
        $(sender).attr("state", 0);
    }

    var action = $(".categories .item.selected").attr("category_id");
    if (action != 6)
    {
        LoadContacts(1);
    }
    else
    {
        LoadMaterials(1);
    }
}

function OnCategoryClicked(sender)
{
    $(".categories .item").each(function ()
    {
        $(this).removeClass("selected");
    });
    $(sender).addClass("selected");


    var url = $(sender).attr("url");
    window.history.pushState({}, null, "search.php?category=" + url);

    var action = $(".categories .item.selected").attr("category_id");
    if (action != 6)
    {
        LoadContacts(1);
    }
    else
    {
        LoadMaterials(1);
    }
}

function OnFilterExpandClicked(sender)
{
    $(sender).addClass("hidden");
    $(sender).parent().find(".scope").addClass("visible");
    $(sender).parent().find(".skills").addClass("visible");
}

function LoadContacts(page)
{
    var keywords = $("#keywords_input").val();
    var category = $(".categories .item.selected").attr("category_id");
    var index = 0;
    var scope = [];
    $("#scope_output .item[state='1']").each(function ()
    {
        scope[index] = $(this).attr("sphere_id");
        index++;
    });
    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "CountContacts",
                keywords: keywords,
                scope: scope,
                group_id: category
            },
            success: function (data)
            {
                var pages = Math.ceil(parseInt(data) / contacts_per_page);
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
                function: "GetContacts",
                group_id: category,
                index: (page - 1) * contacts_per_page,
                quantity: contacts_per_page,
                keywords: keywords,
                scope: scope
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

function LoadMaterials(page)
{
    var keywords = $("#keywords_input").val();
    var index = 0;
    var scope = [];
    $("#scope_output .item[state='1']").each(function ()
    {
        scope[index] = $(this).attr("sphere_id");
        index++;
    });
    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "CountMaterials",
                scope: scope,
                keywords: keywords
            },
            success: function (data)
            {
                var pages = Math.ceil(parseInt(data) / materials_per_page);
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
                function: "GetMaterials",
                index: (page - 1) * materials_per_page,
                quantity: materials_per_page,
                keywords: keywords,
                scope: scope
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

function OnPreviousPageClicked(sender)
{
    var action = $(".categories .item.selected").attr("category_id") == 6 ? 2 : 1;
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

function OnNextPageClicked(sender)
{
    var action = $(".categories .item.selected").attr("category_id") == 6 ? 2 : 1;
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

function OnInputChanged(sender)
{
    var action = $(".categories .item.selected").attr("category_id") == 6 ? 2 : 1;
    if (action == 1)
    {
        LoadContacts(1);
    }
    else
    {
        LoadMaterials(1);
    }
}