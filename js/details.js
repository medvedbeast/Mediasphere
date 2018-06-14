function OnBuyClicked()
{
    $(".buy_popup").removeClass("hidden");
    // if enough points:
    $(".buy_popup .balance").addClass("visible");
    // if not:
    $(".buy_popup .error").addClass("visible");
}

function OnReportClicked()
{
    $(".report_popup").removeClass("hidden");
}

function OnSubmitReportClicked(sender, contact)
{
    var content = $("#report_content").val();
    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "Report",
                sender_id: sender,
                contact_id: contact,
                content: content
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
                    location.reload(true);
                }
            },
            error: function (data)
            {
                alert("При завантаженні даних сталася помилка!");
                console.log(data);
            }
        });
    $(".report_popup").addClass("hidden");
}

function OnCancelReportClicked()
{
    $(".report_popup").addClass("hidden");
}

function OnConfirmPurchaseClicked(buyer, contact, author)
{
    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "Purchase",
                buyer_id: buyer,
                contact_id: contact,
                author_id: author
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
                    location.reload(true);
                }
            },
            error: function (data)
            {
                alert("При завантаженні даних сталася помилка!");
                console.log(data);
            }
        });
    $(".buy_popup").addClass("hidden");
}

function OnCancelPurchaseClicked()
{
    $(".buy_popup").addClass("hidden");
}

function OnBlockUserClicked(sender, reported, report)
{
    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "BlockContact",
                contact_id: sender,
                reported_id: reported,
                report_id: report
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
                    window.location.href = "reports.php";
                }
            },
            error: function (data)
            {
                alert("При завантаженні даних сталася помилка!");
                console.log(data);
            }
        });
}

function OnRejectReportClicked()
{
    $(".report_answer_popup").removeClass("hidden");
}

function OnSubmitReportAnswerClicked(sender, reported, report)
{
    var answer = $("#report_answer").val();
    var request = $.ajax(
        {
            type: "POST",
            url: "core/invoke.php",
            data: {
                function: "DismissReport",
                answer: answer,
                contact_id: sender,
                reported_id: reported,
                report_id: report
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
                    window.location.href = "reports.php";
                }
            },
            error: function (data)
            {
                alert("При завантаженні даних сталася помилка!");
                console.log(data);
            }
        });
    $(".report_answer_popup").addClass("hidden");
}
function OnCancelReportAnswerClicked()
{
    $(".report_answer_popup").addClass("hidden");
}