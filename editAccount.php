<?php

include_once "core/database.php";

$user_id = -1;
if (isset($_COOKIE["user"]))
{
    $user_id = $_COOKIE["user"];
}
else
{
    header("Location: entrance.php?action=relogin&target=http://mediasphere.com.ua/create.php");
    exit();
}

$breadcrumbs = array(array("аккаунт", "account.php"), array("редагування аккаунту", "editAccount.php"));

$contact = Database::GetContact($user_id);

?>
<!DOCTYPE html>
<html lang="ua">
    <head>
        <?php include "modules/meta.php"; ?>
        <link href="css/editAccount.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/editAccount.js"></script>
    </head>
    <body onload="OnBodyLoaded('images/contacts/<?= $contact->photo ?>')">
        <?php include "modules/header.php"; ?>
        <div class="page">
            <div class="header">
                <div class="line"></div>
                <div class="text">
                    Зміна інформації профілю:
                </div>
            </div>
            <div class="disclaimer">
                Будь ласка, дотримуйтесь правил заповнення: заповнюйте поля акуратно та перевіряйте актуальність та достовірність інформації заздалегідь.<br />
                <b>За грубі порушення правил та орфографічні помилки Ви будете позбавлені можливості користуватися ресурсом назавжди.</b>
            </div>
            <div class="row">
                <div id="general_information" class="group">
                    <div class="title">
                        <div>Основна iнформацiя:</div>
                    </div>
                    <div class="content">
                        <div class="label">Повне ім'я <i>(ім'я, по-батькові, прізвище)</i></div>
                        <div class="input">
                            <div class="icon">edit</div>
                            <input id="name" type="text" placeholder="Повне ім'я" value="<?= $contact->name ?>">
                        </div>
                        <div class="label">Місце роботи <i>(повна назва установи або компанії)</i></div>
                        <div class="input">
                            <div class="icon">account_balance</div>
                            <input id="workplace" type="text" placeholder="Місце роботи" value="<?= $contact->workplace ?>">
                        </div>
                        <div class="label">Назва посади</div>
                        <div class="input">
                            <div class="icon">work</div>
                            <input id="position" type="text" placeholder="Назва посади" value="<?= $contact->position ?>">
                        </div>
                        <div class="label">Основне місце активності <i>(де особа перебуває більшість часу)</i></div>
                        <div class="input">
                            <div class="icon">location_on</div>
                            <input id="location" type="text" placeholder="Основне місце активності" value="<?= $contact->location ?>">
                        </div>
                    </div>
                </div>
                <div id="image" class="group">
                    <div class="title">
                        <div>Фотокартка:</div>
                    </div>
                    <div class="content">
                        <div id="image_output" class="image" style="background-image: url('images/contacts/<?= $contact->photo ?>')" loaded="1">
                            <div class="loading">
                                <div class="text">завантаження зображення</div>
                                <div class="icon">cached</div>
                            </div>
                        </div>
                        <canvas id="image_canvas"></canvas>
                        <input id="image_input" type="file" multiple="false" accept="image/*" required="true" onchange="OnImageAdded()" />
                        <div class="actions">
                            <div class="button load" onclick="OnAddImageClicked()">
                                <div class="icon">add</div>
                                <div class="text">завантажити</div>
                            </div>
                            <div class="button remove" onclick="OnRemoveImageClicked()">
                                <div class="icon">delete</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="contact_information" class="group">
                    <div class="title">
                        <div>Контактна iнформацiя:</div>
                    </div>
                    <div class="content">
                        <div class="column">
                            <div class="label">Номер телефону <i>(напр.: "+38 093 26 99 007")</i></div>
                            <div class="input">
                                <div class="icon">phone</div>
                                <input id="phone" type="text" placeholder="Номер телефону" value="<?= $contact->phone ?>">
                            </div>
                            <div class="label">Адреса електронної пошти</div>
                            <div class="input">
                                <div class="icon">email</div>
                                <input id="email" type="text" placeholder="Адреса електронної пошти" value="<?= $contact->email ?>">
                            </div>
                            <div class="label">Посилання на 'вКонтакте'</div>
                            <div class="input">
                                <div class="icon">language</div>
                                <input id="vk" type="text" placeholder="Посилання на 'вКонтакте'" value="<?= $contact->vk ?>">
                            </div>
                        </div>
                        <div class="column">
                            <div class="label">Посилання на 'Facebook'</div>
                            <div class="input">
                                <div class="icon">language</div>
                                <input id="facebook" type="text" placeholder="Посилання на 'Facebook'" value="<?= $contact->facebook ?>">
                            </div>
                            <div class="label">Посилання на 'Twitter'</div>
                            <div class="input">
                                <div class="icon">language</div>
                                <input id="twitter" type="text" placeholder="Посилання на 'Twitter'" value="<?= $contact->twitter ?>">
                            </div>
                            <div class="label">Посилання на веб-сайт</div>
                            <div class="input">
                                <div class="icon">language</div>
                                <input id="website" type="text" placeholder="Посилання на веб-сайт" value="<?= $contact->website ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="scope" class="group">
                    <div class="title">
                        <div>Сфери діяльності:</div>
                    </div>
                    <div class="content">
                        <?php
                        $spheres = Database::GetSpheres();
                        $scope = Database::GetContactScope($user_id);
                        $column_capacity = 16;
                        $index = 0;
                        foreach ($spheres as $sphere)
                        {
                            $flag = false;
                            foreach ($scope as $s)
                            {
                                if ($s->name == $sphere->name)
                                {
                                    $flag = true;
                                }
                            }
                            if ($index == 0)
                            {
                                ?>
                                <div class="column">
                                <?php
                            }
                            ?>
                            <div class="item" onclick="OnCheckBoxClicked(this)" state="<?= $flag ? 1 : 0 ?>" sphere_id="<?= $sphere->id ?>">
                                <div class="icon"><?= $flag ? "check_box" : "check_box_outline_blank" ?></div>
                                <div class="text"><?= $sphere->name ?></div>
                            </div>
                            <?php
                            $index++;
                            if ($index == $column_capacity)
                            {
                                ?>
                                </div>
                                <?php
                                $index = 0;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="confirmation">
                <div class="icon">error_outline</div>
                <div class="text">
                    Натискаючи кнопку ви погоджуетесь, що заповнили всі поля форми вірно.<br />
                    Також Ви підтверджуете, що заздалегідь перевірили достовірність та актуальність інформації.
                </div>
                <div class="button" onclick="OnSubmitClicked(<?= $user_id ?>)">
                    <div class="icon">done</div>
                    <div class="text">зберегти зміни</div>
                </div>
            </div>
        </div>
    </body>
</html>
