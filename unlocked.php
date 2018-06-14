<?php

$user_id = -1;
if (isset($_COOKIE["user"]))
{
    $user_id = $_COOKIE["user"];
}
else
{
    header("Location: entrance.php?action=relogin&target=http://mediasphere.com.ua/create.php");
    exit;
}


$breadcrumbs = array(array("мої контакти", "unlocked.php"));

?>
<!DOCTYPE html>
<html lang="ua">
    <head>
        <?php include "modules/meta.php"; ?>
        <link href="css/unlocked.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/unlocked.js"></script>
    </head>
    <body onload="OnBodyLoaded(<?= $user_id ?>)">
        <?php include "modules/header.php"; ?>
        <div class="page">
            <div class="search">
                <div class="header">
                    <div class="line"></div>
                    <div class="text">Пошук серед відкритих контактів:</div>
                </div>
                <div class="navigation">
                    <div class="search">
                        <div class="icon">search</div>
                        <input id="keywords_input" type="text" placeholder="будь-які ключові слова" onchange="LoadContacts(1)" />
                    </div>
                    <div class="page_controlls" current_page="" total_pages="">
                        <div class="icon" onclick="OnPreviousPageClicked()">keyboard_arrow_left</div>
                        <div class="text">Сторінка 1 / 0</div>
                        <div class="icon" onclick="OnNextPageClicked()">keyboard_arrow_right</div>
                    </div>
                </div>
            </div>
            <div id="results"></div>
        </div>
    </body>
</html>
