<?php
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

$breadcrumbs = array(array("створення", "create.php"));
?>
<!DOCTYPE html>
<html lang="ua">
    <head>
        <?php include "modules/meta.php"; ?>
        <link href="css/create.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/create.js"></script>
    </head>
    <body onload="OnBodyLoaded()">
        <?php include "modules/header.php"; ?>
        <div class="page" user="<?= $user_id ?>">
            <div class="header">
                <div class="line"></div>
                <div class="text">
                    Вибрати дію:
                </div>
            </div>
            <div class="tabs">
                <div class="item <?= !isset($_REQUEST["category"]) || $_REQUEST["category"] == "contact" ? "selected" : ""; ?>" onclick="OnTabClicked(this, 1)" url="contact" index="1">
                    <div class="icon">person</div>
                    <div class="text">Додати контакт</div>
                </div>
                <div class="item <?= $_REQUEST["category"] == "material" ? "selected" : ""; ?>" onclick="OnTabClicked(this, 2)" url="material" index="2">
                    <div class="icon">lightbulb_outline</div>
                    <div class="text">Додати ідею для сюжету</div>
                </div>
            </div>
            <div class="header">
                <div class="line"></div>
                <div class="text">
                    Заповнити поля:
                </div>
            </div>
            <div class="disclaimer">
                Будь ласка, дотримуйтесь правил заповнення: заповнюйте поля акуратно та перевіряйте актуальність та достовірність інформації заздалегідь.<br />
                <b>За грубі порушення правил та орфографічні помилки Ви будете позбавлені можливості користуватися ресурсом назавжди.</b>
            </div>
            <div class="pages">
                <div id="contact" class="item <?= !isset($_REQUEST["category"]) || $_REQUEST["category"] == "contact" ? "selected" : ""; ?>" page_id="1">
                    <div class="row">
                        <div id="general_information" class="group">
                            <div class="title">
                                <div>Основна iнформацiя:</div>
                            </div>
                            <div class="content">
                                <div class="label">Повне ім'я <i>(ім'я, по-батькові, прізвище)</i></div>
                                <div class="input">
                                    <div class="icon">edit</div>
                                    <input id="contact_name" type="text" placeholder="Повне ім'я">
                                </div>
                                <div class="label">Місце роботи <i>(повна назва установи або компанії)</i></div>
                                <div class="input">
                                    <div class="icon">account_balance</div>
                                    <input id="contact_workplace" type="text" placeholder="Місце роботи">
                                </div>
                                <div class="label">Назва посади</div>
                                <div class="input">
                                    <div class="icon">work</div>
                                    <input id="contact_position" type="text" placeholder="Назва посади">
                                </div>
                                <div class="label">Основне місце активності <i>(де особа перебуває більшість часу)</i></div>
                                <div class="input">
                                    <div class="icon">location_on</div>
                                    <input id="contact_location" type="text" placeholder="Основне місце активності">
                                </div>
                                <div class="label">Категорія контакту</div>
                                <div id="contact_category" class="input" type="select" selected_value="3">
                                    <div class="icon">people</div>
                                    <div class="select">
                                        <div class="static" onclick="OnSelectClicked(this)">
                                            <div class="text">Публічна персона</div>
                                            <div class="icon">keyboard_arrow_down</div>
                                        </div>
                                        <div class="dynamic">
                                            <div class="option" value="3">Публічна персона</div>
                                            <div class="option" value="4">Стрінгер</div>
                                            <div class="option" value="5">Експерт / Пресс-служба державної установи</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="image" class="group">
                            <div class="title">
                                <div>Фотокартка:</div>
                            </div>
                            <div class="content">
                                <div id="image_output" class="image">
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
                                        <input id="contact_phone" type="text" placeholder="Номер телефону">
                                    </div>
                                    <div class="label">Адреса електронної пошти</div>
                                    <div class="input">
                                        <div class="icon">email</div>
                                        <input id="contact_email" type="text" placeholder="Адреса електронної пошти">
                                    </div>
                                    <div class="label">Посилання на 'вКонтакте'</div>
                                    <div class="input">
                                        <div class="icon">language</div>
                                        <input id="contact_vk" type="text" placeholder="Посилання на 'вКонтакте'">
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="label">Посилання на 'Facebook'</div>
                                    <div class="input">
                                        <div class="icon">language</div>
                                        <input id="contact_fb" type="text" placeholder="Посилання на 'Facebook'">
                                    </div>
                                    <div class="label">Посилання на 'Twitter'</div>
                                    <div class="input">
                                        <div class="icon">language</div>
                                        <input id="contact_tw" type="text" placeholder="Посилання на 'Twitter'">
                                    </div>
                                    <div class="label">Посилання на веб-сайт</div>
                                    <div class="input">
                                        <div class="icon">language</div>
                                        <input id="contact_website" type="text" placeholder="Посилання на веб-сайт">
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
                            <div id="contact_scope_output" class="content">
                                <div class="column">
                                    <div class="item" onclick="OnCheckBoxClicked(this)" state="0">
                                        <div class="icon">check_box_outline_blank</div>
                                        <div class="text">test</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="agent_form" class="group">
                            <div class="title">
                                <div>Додати представника:</div>
                            </div>
                            <div class="content">
                                <div class="label">Ім'я</i></div>
                                <div class="input">
                                    <div class="icon">edit</div>
                                    <input id="agent_name" type="text" placeholder="Повне ім'я">
                                </div>
                                <div class="label">Місце роботи</div>
                                <div class="input">
                                    <div class="icon">account_balance</div>
                                    <input id="agent_workplace" type="text" placeholder="Місце роботи">
                                </div>
                                <div class="label">Назва посади</div>
                                <div class="input">
                                    <div class="icon">work</div>
                                    <input id="agent_position" type="text" placeholder="Назва посади">
                                </div>
                                <div class="label">Номер телефону</div>
                                <div class="input">
                                    <div class="icon">phone</div>
                                    <input id="agent_phone" type="text" placeholder="Номер телефону">
                                </div>
                                <div class="label">Адреса електронної пошти</div>
                                <div class="input">
                                    <div class="icon">email</div>
                                    <input id="agent_email" type="text" placeholder="Адреса електронної пошти">
                                </div>
                                <div class="button" onclick="OnAddAgentClicked()">
                                    <div class="icon">add</div>
                                    <div class="text">додати</div>
                                </div>
                            </div>
                        </div>
                        <div id="agent_item_template" class="item" index="">
                            <div class="name">Ростислав Савельєв</div>
                            <div class="work">НУК ім. адмірала Макарова</div>
                            <div class="position">Director</div>
                            <div class="phone">
                                <div class="icon">call</div>
                                <div class="text">+38-093-26-99-007</div>
                            </div>
                            <div class="email">
                                <div class="icon">email</div>
                                <div class="text">email@host.com</div>
                            </div>
                            <div class="button" onclick="OnRemoveAgentClicked(this)">
                                <div class="icon">delete</div>
                                <div class="text">видалити</div>
                            </div>
                        </div>
                        <div id="agent_list" class="group">
                            <div class="title">
                                <div>Список представників:</div>
                            </div>
                            <div class="content">

                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div id="material" class="item <?= $_REQUEST["category"] == "material" ? "selected" : ""; ?>" page_id="2">
                    <div id="material_additional_information" class="group">
                        <div class="title">
                            <div>Додаткова інформація:</div>
                        </div>
                        <div class="content">
                            <div class="column">
                                <div class="label">Локація <i>(місце проведення)</i></div>
                                <div class="input">
                                    <div class="icon">location_on</div>
                                    <input id="material_location" type="text" placeholder="Локація" />
                                </div>
                            </div>
                            <div class="column">
                                <div class="label">Дата <i>(Час проведення, дедлайн, тощо)</i></div>
                                <div class="input">
                                    <div class="icon">location_on</div>
                                    <input id="material_date" type="text" placeholder="Дата" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="material_general_information" class="group">
                        <div class="title">
                            <div>Основна інформація:</div>
                        </div>
                        <div class="content">
                            <div class="label">Заголовок <i>(назва)</i></div>
                            <div class="input">
                                <div class="icon">bookmark_border</div>
                                <input id="material_title" type="text" placeholder="Заголовок" />
                            </div>
                            <div class="label">Короткий опис <i>(5 - 7 речень)</i></div>
                            <textarea id="material_short_description" placeholder="Короткий опис"></textarea>
                            <div class="label">Повний опис</div>
                            <textarea id="material_description" placeholder="Повний опис"></textarea>
                        </div>
                    </div>
                    <div id="material_scope" class="group">
                        <div class="title">
                            <div>Сфери діяльності:</div>
                        </div>
                        <div id="material_scope_output" class="content">
                            <div class="column">
                                <div class="item" onclick="OnCheckBoxClicked(this)" state="0">
                                    <div class="icon">check_box_outline_blank</div>
                                    <div class="text">test</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="confirmation">
                    <div class="icon">error_outline</div>
                    <div class="text">
                        Натискаючи кнопку ви погоджуетесь, що заповнили всі поля форми вірно.<br />
                        Також Ви підтверджуете, що заздалегідь перевірили достовірність та актуальність інформації, а також відсутність цього контакту у базі.
                    </div>
                    <div class="button" onclick="OnSubmitClicked()">
                        <div class="icon">done</div>
                        <div class="text">завершити створення</div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
