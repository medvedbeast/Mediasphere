<?php
$user_id = -1;
if (isset($_COOKIE["user"]))
{
    $user_id = $_COOKIE["user"];
}
else
{
    header("Location: entrance.php?action=relogin&target=http://mediasphere.com.ua/requests.php");
    exit();
}

$breadcrumbs = array(array("заявки на внесення", "requests.php"));
?>
<!DOCTYPE html>
<html lang="ua">
    <head>
        <?php include "modules/meta.php"; ?>
        <link href="css/requests.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/requests.js"></script>
    </head>
    <body onload="OnBodyLoaded()">
        <?php include "modules/header.php" ?>
        <div class="page">
            <div id="pending_contacts" class="group">
                <div class="header">
                    <div class="line"></div>
                    <div class="text">Заявки на внесення контакту до БД:</div>
                </div>
                <div class="navigation">
                    <div class="search">
                        <div class="icon">search</div>
                        <input type="text" placeholder="будь-які ключові слова" onchange="OnInputChanged(1)"/>
                    </div>
                    <div class="page_controlls" current_page="0" total_pages="0">
                        <div class="icon" onclick="OnPreviousPageClicked(this, 1)">keyboard_arrow_left</div>
                        <div class="text">Сторінка 0 / 0</div>
                        <div class="icon" onclick="OnNextPageClicked(this, 1)">keyboard_arrow_right</div>
                    </div>
                </div>
                <div class="content">
                    <div class="item">
                        <div class="date">01.01.2018</div>
                        <div class="name">Савельев Ростислав Александрович</div>
                        <div class="workplace">НУК им. Адмирала Макарова // Директор</div>
                        <div class="whitespace"></div>
                        <a href="preview.php?item=0&type=0" target="_blank">
                            <div class="icon">remove_red_eye</div>
                        </a>
                        <div class="icon">add</div>
                        <div class="icon">delete</div>
                    </div>
                </div>
            </div>
            <div id="pending_materials" class="group">
                <div class="header">
                    <div class="line"></div>
                    <div class="text">Заявки на внесення ідеї до БД:</div>
                </div>
                <div class="navigation">
                    <div class="search">
                        <div class="icon">search</div>
                        <input type="text" placeholder="будь-які ключові слова" onchange="OnInputChanged(2)"/>
                    </div>
                    <div class="page_controlls" current_page="0" total_pages="0">
                        <div class="icon" onclick="OnPreviousPageClicked(this, 2)">keyboard_arrow_left</div>
                        <div class="text">Сторінка 1 / 10</div>
                        <div class="icon" onclick="OnNextPageClicked(this, 2)">keyboard_arrow_right</div>
                    </div>
                </div>
                <div class="content">
                    <div class="item">
                        <div class="date">01.01.2018</div>
                        <div class="name">Назва нової крутої ідеї</div>
                        <div class="whitespace"></div>
                        <a href="preview.php?item=0&type=1" target="_blank">
                            <div class="icon">remove_red_eye</div>
                        </a>
                        <div class="icon">add</div>
                        <div class="icon">delete</div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </body>
</html>
