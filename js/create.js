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
                $("#contact_scope_output").html(data);
                $("#material_scope_output").html(data);

            },
            error: function (data)
            {
                alert("При загрузке данных произошла ошибка!");
                console.log(data);
            }
        });
}

function OnTabClicked(sender, index)
{
    $(".tabs .item").each(function ()
    {
        $(this).removeClass("selected");
    });
    $(sender).addClass("selected");

    $(".pages .item").removeClass("selected");
    $(".page .item[page_id='" + index + "']").addClass("selected");

    var url = $(sender).attr("url");
    window.history.pushState({}, null, "create.php?category=" + url);
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
}

function OnSelectClicked(sender)
{
    $(sender).parent().find(".dynamic").addClass("open");
}


$("html").click(function (e)
{
    if (!$(e.target).is(".select .text") && !$(e.target).is(".select .icon"))
    {
        $(".dynamic").removeClass("open");
    }
    if ($(e.target).is(".dynamic .option"))
    {
        var option = $(e.target).attr("value");
        var html = $(e.target).html();
        $(e.target).closest(".input[type='select']").find(".text").html(html);
        $(e.target).closest(".input[type='select']").attr("selected_value", option)
    }
});

function OnAddImageClicked()
{
    $("#image_input").click();
    $("#image_output .loading").addClass("visible");
}

function OnImageAdded()
{
    var file = document.getElementById("image_input").files[0];
    if (file.size > 2000000)
    {
        alert("Розмір файлу занадто великий! Будь ласка, завантажте меньший файл.");
        $("#image_output .loading").removeClass("visible");
        return;
    }
    var image = new Image();
    image.onload = function ()
    {
        var canvas = document.getElementById("image_canvas");
        canvas.width = image.width;
        canvas.height = image.height;
        var context = canvas.getContext("2d");
        context.drawImage(image, 0, 0);
        var data = canvas.toDataURL("image/png");
        $("#image_output .loading").removeClass("visible");
        $("#image_output").css("background-image", "url(" + data + ")");
        $("#image_output").attr("loaded", 1);
    };
    image.src = URL.createObjectURL(file);
}

function OnRemoveImageClicked()
{
    $("#image_output").attr("loaded", 0);
    $("#image_output").css("background-image", "")
    ClearCanvas("image_canvas");
}

var agentCount = 0;

function OnAddAgentClicked()
{
    var template = $("#agent_item_template");
    if (agentCount == 6)
    {
        alert("Ви не можете додати більше шести агентів!");
        return;
    }
    var clone = template.clone();
    clone.attr("id", "");

    var name = $("#agent_name");
    var work = $("#agent_workplace");
    var position = $("#agent_position");
    var phone = $("#agent_phone");
    var email = $("#agent_email");

    if (name.val() == "" || work.val() == "" || position.val() == "" || (phone.val() == "" && email.val() == ""))
    {
        alert("Заповніть, будь ласка, всі поля.");
        return;
    }

    clone.find(".name").html(name.val());
    clone.find(".work").html(work.val());
    clone.find(".position").html(position.val());
    clone.find(".phone").html(phone.val());
    clone.find(".email").html(email.val());
    clone.appendTo("#agent_list .content");
    name.val("");
    work.val("");
    position.val("");
    phone.val("");
    email.val("");
    agentCount++;
}

function OnRemoveAgentClicked(sender)
{
    $(sender).parent().remove();
    agentCount--;
}

function ClearCanvas(name)
{
    $("#" + name).remove();
    $("<canvas id='" + name + "'></canvas>").insertAfter($("#image_output"));
    $("#image_output").css("background-image", "");
}

function OnSubmitClicked()
{
    var index = $(".tabs .item.selected").attr("index");
    if (index == 1)
    {
        var name = $("#contact_name").val();
        var work = $("#contact_workplace").val();
        var position = $("#contact_position").val();
        var location = $("#contact_location").val();
        var category = $("#contact_category").attr("selected_value");
        var canvas = document.getElementById("image_canvas");
        var photo = canvas.toDataURL("image/png");
        var photo_loaded = $("#image_output").attr("loaded");
        var phone = $("#contact_phone").val();
        var email = $("#contact_email").val();
        var vk = $("#contact_vk").val();
        var fb = $("#contact_fb").val();
        var tw = $("#contact_tw").val();
        var website = $("#contact_website").val();
        var author = $(".page").attr("user");

        var index = 0;
        var scope = [];
        $("#contact_scope_output .item[state='1']").each(function ()
        {
            scope[index] = $(this).attr("sphere_id");
            index++;
        });

        index = 0;
        var agents = [];
        $("#agent_list .item").each(function ()
        {
            var values = [];
            values[0] = $(this).find(".name").html();
            values[1] = $(this).find(".work").html();
            values[2] = $(this).find(".position").html();
            values[3] = $(this).find(".phone").html();
            values[4] = $(this).find(".email").html();
            agents[index] = values;
            index++;
        });


        if (name == "" || work == "" || position == "" || location == "" || category == "" || photo_loaded != 1 || phone == "" || email == "" || scope.length < 1)
        {
            alert("Заповніть, будь ласка, всі поля!");
            return;
        }

        var request = $.ajax(
            {
                type: "POST",
                url: "core/invoke.php",
                data: {
                    function: "InsertContact",
                    name: name,
                    workplace: work,
                    position: position,
                    location: location,
                    group_id: category,
                    photo: photo,
                    phone: phone,
                    email: email,
                    vk: vk,
                    facebook: fb,
                    twitter: tw,
                    website: website,
                    author_id: author,
                    scope: scope,
                    agents: agents
                },
                success: function (data)
                {
                    if (data == 1)
                    {
                        alert("Контакт успішно додано!\nПісля перевірки адміністратором він зявиться на сайті.\nРезультат перевірки ви зможете знайти у соєму особистому кабінеті");
                        $("#contact_name").val("");
                        $("#contact_workplace").val("");
                        $("#contact_position").val("");
                        $("#contact_location").val("");
                        ClearCanvas("image_canvas");
                        $("#contact_phone").val("");
                        $("#contact_email").val("");
                        $("#contact_vk").val("");
                        $("#contact_fb").val("");
                        $("#contact_tw").val("");
                        $("#contact_website").val("");
                        $("#contact_scope_output .item[state='1']").each(function ()
                        {
                            $(this).attr("state", 0);
                            $(this).find(".icon").html("check_box_outline_blank");
                        });
                        $("#agent_list .item").remove();
                    }
                    else
                    {
                        console.log(data);
                        alert("При завантаженні даних сталася помилка!\nБудь-ласка, спробуйте пізніше.");
                    }
                },
                error: function (data)
                {
                    alert("При завантаженні даних сталася помилка!\nБудь-ласка, спробуйте пізніше.");
                    console.log(data);
                }
            });
    }
    else
    {
        var location = $("#material_location").val();
        var deadline = $("#material_date").val();
        var title = $("#material_title").val();
        var short_description = $("#material_short_description").val();
        var description = $("#material_description").val();
        var author = $(".page").attr("user");


        var index = 0;
        var scope = [];
        $("#material_scope_output .item[state='1']").each(function ()
        {
            scope[index] = $(this).attr("sphere_id");
            index++;
        });


        if (location == "" || deadline == "" || title == "" || short_description == "" || description == "" || scope.length < 1)
        {
            alert("Заповніть, будь ласка, всі поля!");
            return;
        }

        var request = $.ajax(
            {
                type: "POST",
                url: "core/invoke.php",
                data: {
                    function: "InsertMaterial",
                    title: title,
                    short_description: short_description,
                    description: description,
                    location: location,
                    deadline: deadline,
                    author: author,
                    scope: scope
                },
                success: function (data)
                {
                    if (data == 1)
                    {
                        alert("Матеріал успішно додано!\nПісля перевірки адміністратором він зявиться на сайті.\nРезультат перевірки ви зможете знайти у соєму особистому кабінеті");
                        $("#material_location").val("");
                        $("#material_date").val("");
                        $("#material_title").val("");
                        $("#material_short_description").val("");
                        $("#material_description").val("");
                        $("#material_scope_output .item[state='1']").each(function ()
                        {
                            $(this).attr("state", 0);
                            $(this).find(".icon").html("check_box_outline_blank");
                        });
                    }
                    else
                    {
                        alert("При завантаженні даних сталася помилка!\nБудь-ласка, спробуйте пізніше.");
                    }
                },
                error: function (data)
                {
                    alert("При завантаженні даних сталася помилка!\nБудь-ласка, спробуйте пізніше.");
                    console.log(data);
                }
            });
    }
}