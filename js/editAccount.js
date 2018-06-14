function OnBodyLoaded(src)
{
    var image = new Image();
    image.onload = function ()
    {
        var canvas = document.getElementById("image_canvas");
        canvas.width = image.width;
        canvas.height = image.height;
        var context = canvas.getContext("2d");
        context.drawImage(image, 0, 0);
    }
    image.src = src;
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
    };
    image.src = URL.createObjectURL(file);
}

function OnRemoveImageClicked()
{
    $("#image_output").css("background-image", "")
}

function OnSubmitClicked(id)
{
    var name = $("#name").val();
    var work = $("#workplace").val();
    var position = $("#position").val();
    var location = $("#location").val();
    var canvas = document.getElementById("image_canvas");
    var photo = canvas.toDataURL("image/png");
    var photo_loaded = $("#image_output").attr("loaded");
    var phone = $("#phone").val();
    var email = $("#email").val();
    var vk = $("#vk").val();
    var fb = $("#facebook").val();
    var tw = $("#twitter").val();
    var website = $("#website").val();

    var index = 0;
    var scope = [];
    $("#scope .item[state='1']").each(function ()
    {
        scope[index] = $(this).attr("sphere_id");
        index++;
    });

    if (name == "" || work == "" || position == "" || location == "" || photo_loaded != 1 || phone == "" || email == "" || scope.length < 1)
    {
        alert("Заповніть, будь ласка, всі поля!");
        return;
    }

    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "UpdateContact",
                id: id,
                name: name,
                workplace: work,
                position: position,
                location: location,
                photo: photo,
                phone: phone,
                email: email,
                vk: vk,
                facebook: fb,
                twitter: tw,
                website: website,
                scope: scope
            },
            success: function (data)
            {
                if (data == 1)
                {
                    window.location.href = "account.php";
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
