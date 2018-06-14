function OnDismissNotification(sender, id)
{
    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "DeleteNotification",
                id: id
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
                    $(sender).remove();
                }
            },
            error: function (data)
            {
                alert("При завантаженні даних сталася помилка!");
                console.log(data);
            }
        });
}