<?php

include_once "core/database.php";

$user_id = -1;
if (isset($_COOKIE["user"]))
{
    $user_id = $_COOKIE["user"];
} else
{
    header("Location: entrance.php?action=relogin");
    exit;
}

if ($user_id == $_REQUEST["item"])
{
    header("Location: account.php");
    exit;
}

$breadcrumbs = array(array("пошук", "search.php"), array(($_REQUEST["type"] == 0 ? "перегляд контакту" : "перегляд матеріалу"), "details.php?item=" . $_REQUEST["item"] . "&type=" . $_REQUEST["type"]));

if ($_REQUEST["type"] == 0)
{
    $contact = Database::GetContact($_REQUEST["item"]);
    $owner = Database::GetContact($contact->author_id);
    if ($contact->author_id == $user_id)
    {
        $bought = true;
    } else
    {
        $bought = Database::CheckPurchase($user_id, $contact->id) == 0 ? false : true;
    }
} else
{
    $material = Database::GetMaterial($_REQUEST["item"]);
    $owner = Database::GetContact($material->author_id);
}
?>
<!DOCTYPE html>
<html lang="ua">
    <head>
        <?php include "modules/meta.php"; ?>
        <link href="css/details.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/details.js"></script>
    </head>
    <body>
        <?php include "modules/header.php"; ?>
        <div class="page">
            <?php
            if ($contact)
            {
                $pending_reports = Database::GetContactReports($user_id, $contact->id);
                if (count($pending_reports) > 0 && !isset($_REQUEST["report"]))
                {
                    ?>
                    <div class="report_banner">
                        <div class="text">Ваш скарга на цей контакт розглядаеться.<br />Результат ії розгляду Ви можете дізнатися у особистому кабінеті.</div>
                    </div>
                    <?php
                }
            }
            if (isset($_REQUEST["report"]))
            {
                $report = Database::GetReport($_REQUEST["report"]);

                $report_sender = Database::GetContact($report->sender_id);
                ?>
                <div class="report">
                    <div class="description">
                        <div class="label">Опис проблеми:</div>
                        <div class="text"><?= $report->content ?></div>
                    </div>
                    <div class="sender">
                        <div class="label">Скаргу надіслав:</div>
                        <div class="text">
                            <a href="details.php?item=<?= $report_sender->id ?>&type=0"><?= $report_sender->name ?></a>
                        </div>
                    </div>
                    <div class="buttons">
                        <div class="button block" onclick="OnBlockUserClicked(<?= "$report_sender->id, $report->contact_id, $report->id" ?>)">
                            <div class="icon">lock_outline</div>
                            <div class="text">заблокувати контакт</div>
                        </div>
                        <div class="button reject" onclick="OnRejectReportClicked()">
                            <div class="icon">check_circle</div>
                            <div class="text">відхилити скаргу</div>
                        </div>
                    </div>
                </div>
                <?php
            }
            if ($_REQUEST["type"] == 0)
            {
                ?>
                <div class="card">
                    <div class="content">
                        <div class="name"><?= $contact->name ?></div>
                        <div class="work">
                            <div class="icon">work</div>
                            <div class="text"><?= $contact->workplace . " // " . $contact->position ?></div>
                        </div>
                        <div class="location">
                            <div class="icon">location_on</div>
                            <div class="text"><?= $contact->location ?></div>
                        </div>
                        <div class="sphere">
                            <?php
                            $scope = Database::GetContactScope($_REQUEST["item"]);
                            foreach ($scope as $s)
                            {
                                ?>
                                <div class="tag">
                                    <div class="icon">label</div>
                                    <div class="text"><?= $s->name ?></div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="information">
                    <div class="header">
                        <div class="line"></div>
                        <div class="text">Контактна iнформацiя:</div>
                    </div>
                    <div class="content">
                        <div class="item">
                            <div class="icon">phone</div>
                            <div class="text">Телефон :</div>
                            <div class="value"><?= $bought ? $contact->phone : (strlen($contact->phone) > 0 ? "*******************" : "") ?></div>
                        </div>
                        <div class="item">
                            <div class="icon">email</div>
                            <div class="text">E-mail :</div>
                            <div class="value"><?= $bought ? $contact->email : (strlen($contact->email) > 0 ? "*******************" : "") ?></div>
                        </div>
                        <div class="item">
                            <div class="icon">language</div>
                            <div class="text">вКонтакте :</div>
                            <div class="value"><?= $bought ? $contact->vk : (strlen($contact->vk) > 0 ? "*******************" : "") ?></div>
                        </div>
                        <div class="item">
                            <div class="icon">language</div>
                            <div class="text">Facebook :</div>
                            <div class="value"><?= $bought ? $contact->facebook : (strlen($contact->facebook) > 0 ? "*******************" : "") ?></div>
                        </div>
                        <div class="item">
                            <div class="icon">language</div>
                            <div class="text">Twitter :</div>
                            <div class="value"><?= $bought ? $contact->twitter : (strlen($contact->twitter) > 0 ? "*******************" : "") ?></div>
                        </div>
                        <div class="item">
                            <div class="icon">language</div>
                            <div class="text">Веб-сайт :</div>
                            <div class="value"><?= $bought ? $contact->website : (strlen($contact->website) > 0 ? "*******************" : "") ?></div>
                        </div>
                    </div>
                    <div class="photo">
                        <div class="image" style="background-image: url('images/contacts/<?= $contact->photo ?>')"></div>
                        <div class="button buy" onclick="OnBuyClicked()">
                            <div class="icon">attach_money</div>
                            <div class="text">відкрити інформацію</div>
                        </div>
                        <div class="button report" onclick="OnReportClicked()">
                            <div class="icon">error</div>
                            <div class="text">повідомити про помилку</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <?php
                $agents = Database::GetContactAgents($contact->id);
                if (count($agents) > 0)
                {
                    ?>
                    <div class="agents">
                        <div class="header">
                            <div class="line"></div>
                            <div class="text">Представники:</div>
                        </div>
                        <div class="content">
                            <?php
                            $index = 0;
                            foreach ($agents as $a)
                            {
                                if ($index == 0)
                                {
                                    ?>
                                    <div class="row">
                                    <?php
                                }
                                ?>

                                <div class="item <?= $index != 0 ? "padded" : "" ?>">
                                    <div class="name"><?= $a->name ?></div>
                                    <div class="work"><?= $a->workplace ?></div>
                                    <div class="position"><?= $a->position ?></div>
                                    <div class="phone">
                                        <div class="icon">call</div>
                                        <div class="text"><?= $bought ? $a->phone : (strlen($a->phone) > 0 ? "*******************" : "") ?></div>
                                    </div>
                                    <div class="email">
                                        <div class="icon">email</div>
                                        <div class="text"><?= $bought ? $a->email : (strlen($a->email) > 0 ? "*******************" : "") ?></div>
                                    </div>
                                </div>

                                <?php
                                if ($index == 2)
                                {
                                    ?>
                                    </div>
                                    <?php
                                }
                                $index++;
                                if ($index >= 3)
                                {
                                    $index = 0;
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                if ($contact->group_id != 2)
                {
                    ?>
                    <div id="owner" class="owner" owner_id="<?= $owner->id ?>">
                        <div class="header">
                            <div class="line"></div>
                            <div class="text">Контакт додав:</div>
                        </div>
                        <a href="details.php?item=<?= $owner->id ?>&type=0">
                            <div class="content">
                                <div class="name"><?= $owner->name ?></div>
                                <div class="workplace"><?= $owner->workplace . " // " . $owner->position ?></div>
                                <div class="whitespace"></div>
                                <div class="icon">remove_red_eye</div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            } else
            {
                if ($_REQUEST["type"] == 1)
                {
                    ?>
                    <div class="material">
                        <div class="header">
                            <div class="line"></div>
                            <div class="text">Інформація про ідею:</div>
                        </div>
                        <div class="content">
                            <div class="title"><?= $material->title ?></div>
                            <div class="short_description">
                                <div class="icon">info_outline</div>
                                <div class="text"><?= $material->short_description ?></div>
                            </div>
                            <div class="description"><?= $material->description ?></div>
                            <div class="tags">
                                <?php
                                $scope = Database::GetMaterialScope($_REQUEST["item"]);
                                foreach ($scope as $s)
                                {
                                    ?>
                                    <div class="tag">
                                        <div class="icon">label</div>
                                        <div class="text"><?= $s->name ?></div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="info">
                                <div class="location">
                                    <div class="icon">location_on</div>
                                    <div class="text"><?= $material->location ?></div>
                                </div>
                                <div class="deadline">
                                    <div class="icon">alarm</div>
                                    <div class="text"><?= $material->deadline ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owner">
                        <div class="header">
                            <div class="line"></div>
                            <div class="text">Ідею додав:</div>
                        </div>
                        <a href="details.php?item=<?= $owner->id ?>&type=0">
                            <div class="content">
                                <div class="name"><?= $owner->name ?></div>
                                <div class="workplace"><?= $owner->workplace . " // " . $owner->position ?></div>
                                <div class="whitespace"></div>
                                <div class="icon">remove_red_eye</div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
        $sender = Database::GetContact($user_id);
        ?>
        <div class="report_popup hidden">
            <div class="container shadow-big">
                <div class="title">Повідомлення про помилку</div>
                <div class="label">Опишіть помилку</div>
                <textarea id="report_content" placeholder="Опишіть проблему повністю"></textarea>
                <div class="disclaimer">
                    <div class="icon">error_outline</div>
                    <div class="text">
                        Натискаючи кнопку ви погоджуетесь, що заповнили всі поля форми вірно.<br />
                        Також Ви підтверджуете, що заздалегідь перевірили достовірність та актуальність інформації.
                    </div>
                </div>
                <div class="buttons">
                    <div class="item" onclick="OnSubmitReportClicked(<?= "$user_id, $contact->id" ?>)">
                        <div class="icon">notifications</div>
                        <div class="text">повідомити</div>
                    </div>
                    <div class="item" onclick="OnCancelReportClicked()">
                        <div class="icon">cancel</div>
                        <div class="text">закрити вікно</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="report_answer_popup hidden">
            <div class="container shadow-big">
                <div class="title">Відхилення скарги</div>
                <div class="label">Опишіть причину відхилення скарги</div>
                <textarea id="report_answer" placeholder="Опишіть причину відхилення скарги повністю. Ця причина буде показана користувачу, що подав скаргу."></textarea>
                <div class="disclaimer">
                    <div class="icon">error_outline</div>
                    <div class="text">
                        Натискаючи кнопку ви погоджуетесь, що заповнили всі поля форми вірно.<br />
                        Також Ви підтверджуете, що заздалегідь перевірили достовірність та актуальність інформації.
                    </div>
                </div>
                <div class="buttons">
                    <div class="item" onclick="OnSubmitReportAnswerClicked(<?= "$report_sender->id, $report->contact_id, $report->id" ?>)">
                        <div class="icon">done</div>
                        <div class="text">завершити</div>
                    </div>
                    <div class="item" onclick="OnCancelReportAnswerClicked()">
                        <div class="icon">cancel</div>
                        <div class="text">закрити вікно</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="buy_popup hidden">
            <div class="container shadow-big">
                <div class="title">Відкриття контакту</div>
                <?php
                if ($sender->points >= 10)
                {
                    ?>
                    <div class="balance">
                        На вашому рахунку <b><?= $sender->points ?></b> балів.<br /><br />
                        При відкритті контакту з вас буде списано <b>10</b> балів.<br /><br />
                        Ви хочете продовжити?
                    </div>
                    <?php
                } else
                {
                    ?>
                    <div class="error">
                        <div class="icon">error_outline</div>
                        На вашому рахунку недостатньо балів!<br /><br />
                        Завантажуйте контакти чи ідеї, щоб отрмиати бали.<br /><br />
                        Також бали можна отримати, якщо зробити грошовий переказ на карту ПриватБанку.<br />
                        <a href="www.google.com/search?q=privat24">Деталі...</a>
                    </div>
                    <?php
                }
                ?>
                <div class="buttons">
                    <div class="item" onclick="OnConfirmPurchaseClicked(<?= "$user_id, $contact->id, $contact->author_id" ?>)">
                        <div class="icon">attach_money</div>
                        <div class="text">відкрити контакт</div>
                    </div>
                    <div class="item" onclick="OnCancelPurchaseClicked()">
                        <div class="icon">cancel</div>
                        <div class="text">закрити вікно</div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
