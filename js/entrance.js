function OnBodyLoad()
{
    $("input").each(function ()
    {
        $(this).val("");
    });

    $(document).bind('change', function (e)
    {
        if ($(e.target).is(':invalid'))
        {
            $(e.target).parent().addClass('invalid');
        }
        else
        {
            $(e.target).parent().removeClass('invalid');
        }
    });
}

function Clear()
{
    $("input").each(function ()
    {
        $(this).val("");
    });
    $(".information").html("");
}

function OnTabClick(sender, index)
{
    $(".tab").each(function ()
    {
        $(this).removeClass("selected");
    });
    $(sender).addClass("selected");

    $(".page").each(function ()
    {
        $(this).removeClass("visible");
    });
    $("#page-" + index).addClass("visible");
    Clear();
}

function OnRegisterClick()
{
    var name = $("#r-name").val();
    var place_of_work = $("#r-work").val();
    var work_position = $("#r-position").val();
    var telephone = $("#r-telephone").val();
    var login = $("#r-login").val();
    var password = $("#r-password").val();

    if (name == "" || place_of_work == "" || work_position == "" || telephone == "" || login == "" || password == "")
    {
        $("#page-2 .information").html("<div>Для реєстрації необхідно заповнити всі поля форми!</div>");
        return;
    }

    var valid = true;
    $("#page-2 input:invalid").each(function ()
    {
        valid = false;
    });
    if (!valid)
    {
        $("#page-2 .information").html("<div>Перевірте правильність заповненя форми!</div>");
        return;
    }

    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "Register",
                name: name,
                place_of_work: place_of_work,
                work_position: work_position,
                telephone: telephone,
                login: login,
                password: password
            },
            success: function (data)
            {
                if (data == "-1")
                {
                    $("#page-2 .information").html("<div>Користувач з таким іменем вже існує.<br/>Щоб відновити доступ до аккаунту зв'яжіться з адміністратором за адресою: admin@mediasphere.ua</div>");
                }
                else if (data == "1")
                {
                    $("#page-2 .information").html("<div style='color: green;'>Ви успішно зареєструвалися!<br/>Найближчим часом адміністратор зв'жеться з вами за вказаним номером телефону щоб підтвердити реєстрацію.</div>");
                    /* todo: send email */
                }
                else
                {
                    $("#page-2 .information").html("<div>Користувач з таким іменем вже існує.<br/>Щоб відновити доступ до аккаунту зв'яжіться з адміністратором за адресою: admin@mediasphere.ua</div>");
                }

            },
            error: function (data)
            {
                $("#page-2 .information").html("<div>При завантаженні даних сталася помилка!<br/>Перезавантажте сторінку та або спробуйте пізніше.</div>");
                console.log(data);
            }
        });
}

function OnLoginClick(target)
{
    var login = $("#l-login").val();
    var password = $("#l-password").val();

    if (login == "" || password == "")
    {
        $("#page-1 .information").html("<div>Для входу необхідно заповнити всі поля форми!</div>");
        return;
    }

    var valid = true;
    $("#page-1 input:invalid").each(function ()
    {
        valid = false;
    });

    if (!valid)
    {
        $("#page-1 .information").html("<div>Перевірте правильність заповненя форми!</div>");
        return;
    }

    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "Login",
                login: login,
                password: password
            },
            success: function (data)
            {
                console.log(data);
                if (data == "NO_MATCH")
                {
                    $("#page-1 .information").html("<div>Користувача з такою комбінацією логіна та пароля не знайдено.<br/>Перевірте правильність введених даних або зареєструйтеся.</div>");
                }
                else if (data == "NOT_VERIFIED")
                {
                    $("#page-1 .information").html("<div>Ваш аккаунт не підтверджено!<br/>Найближчим часом адміністратор зв'жеться з вами за вказаним номером телефону щоб підтвердити реєстрацію.<br/>Також Ви можете зв'язатися з адміністратором за адресою: admin@mediasphere.ua</div>");
                }
                else if (data.length > 0)
                {
                    var parts = data.split("&");
                    var id = parts[0].split("=")[1];
                    var group = parts[1].split("=")[1];
                    document.cookie = "user=" + id + ";";
                    document.cookie = "access=" + group + "; ";
                    window.location.href = target == null ? "main.php" : target;
                }
                else
                {
                    $("#page-1 .information").html("<div>При завантаженні даних сталася помилка!<br/>Перезавантажте сторінку або спробуйте пізніше.</div>");
                }
            },
            error: function (data)
            {
                $("#page-1 .information").html("<div>При завантаженні даних сталася помилка!<br/>Перезавантажте сторінку або спробуйте пізніше.</div>");
                console.log(data);
            }
        }
        )
        ;
}