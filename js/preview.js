function OnAcceptContactClicked(id)
{
    if (confirm("Ви дійсно бажаете внести контакт до БД?"))
    {
        var owner = $("#owner").attr("owner_id");
        var request = $.ajax(
            {
                type: "POST",
                url: "core/invoke.php",
                data: {
                    function: "VerifyContact",
                    id: id,
                    owner_id: owner
                },
                success: function (data)
                {
                    if (data != 1)
                    {
                        alert("При завантаженні даних сталася помилка!");
                        console.log(data);
                    }
                    else
                    {
                        window.location.href = "requests.php";
                    }
                },
                error: function (data)
                {
                    alert("При завантаженні даних сталася помилка!");
                    console.log(data);
                }
            });
    }
}

function OnRejectContactClicked(id)
{
    if (confirm("Ви дійсно бажаете відхилити контакт?"))
    {
        var owner = $("#owner").attr("owner_id");
        var request = $.ajax(
            {
                type: "POST",
                url: "core/invoke.php",
                data: {
                    function: "DeleteContact",
                    id: id,
                    owner_id: owner
                },
                success: function (data)
                {
                    if (data != 1)
                    {
                        alert("При завантаженні даних сталася помилка!");
                        console.log(data);
                    }
                    else
                    {
                        window.location.href = "requests.php";
                    }
                },
                error: function (data)
                {
                    alert("При завантаженні даних сталася помилка!");
                    console.log(data);
                }
            });
    }
}

function OnAcceptMaterialClicked(id)
{
    if (confirm("Ви дійсно бажаете внести матеріал до БД?"))
    {
        var owner = $("#owner").attr("owner_id");
        var request = $.ajax(
            {
                type: "POST",
                url: "core/invoke.php",
                data: {
                    function: "VerifyMaterial",
                    id: id,
                    owner_id: owner
                },
                success: function (data)
                {
                    if (data != 1)
                    {
                        alert("При завантаженні даних сталася помилка!");
                        console.log(data);
                    }
                    else
                    {
                        window.location.href = "requests.php";
                    }
                },
                error: function (data)
                {
                    alert("При завантаженні даних сталася помилка!");
                    console.log(data);
                }
            });
    }
}

function OnRejectMaterialClicked(id)
{
    if (confirm("Ви дійсно бажаете відхилити матеріал?"))
    {
        var owner = $("#owner").attr("owner_id");
        var request = $.ajax(
            {
                type: "POST",
                url: "core/invoke.php",
                data: {
                    function: "DeleteMaterial",
                    id: id,
                    owner_id: owner
                },
                success: function (data)
                {
                    if (data != 1)
                    {
                        alert("При завантаженні даних сталася помилка!");
                        console.log(data);
                    }
                    else
                    {
                        window.location.href = "requests.php";
                    }
                },
                error: function (data)
                {
                    alert("При завантаженні даних сталася помилка!");
                    console.log(data);
                }
            });
    }
}
