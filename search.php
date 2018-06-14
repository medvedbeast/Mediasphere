<?php
$authorized = false;
if (isset($_COOKIE))
{
    $authorized = strlen($_COOKIE["user"]) > 0 ? true : false;
}
if (!$authorized)
{
    header("Location: entrance.php?action=relogin&target=http://mediasphere/search.php");
    exit();
}
$breadcrumbs = array(array("пошук", "search.php"));
?>
<!DOCTYPE html>
<html lang="ua">
    <head>
        <?php include "modules/meta.php"; ?>
        <link href="css/search.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/search.js"></script>
    </head>
    <body onload="OnBodyLoaded()">
        <?php include "modules/header.php"; ?>
        <div class="content">
            <div class="filter">
                <div class="header">
                    <div class="line"></div>
                    <div class="text">
                        Категорія пошуку:
                    </div>
                </div>
                <div class="categories">
                    <div class="item <?= !isset($_REQUEST["category"]) || $_REQUEST["category"] == "celebrities" ? "selected" : ""; ?>" onclick="OnCategoryClicked(this)" url="celebrities" category_id="3">
                        <div class="icon">person</div>
                        <div class="text">Публічні персони</div>
                    </div>
                    <div class="item <?= $_REQUEST["category"] == "stringers" ? "selected" : ""; ?>" onclick="OnCategoryClicked(this)" url="stringers" category_id="4">
                        <div class="icon">work</div>
                        <div class="text">Стрінгери</div>
                    </div>
                    <div class="item <?= $_REQUEST["category"] == "experts" ? "selected" : ""; ?>" onclick="OnCategoryClicked(this)" url="experts" category_id="5">
                        <div class="icon">record_voice_over</div>
                        <div class="text">Експерти</div>
                    </div>
                    <div class="item <?= $_REQUEST["category"] == "materials" ? "selected" : ""; ?>" onclick="OnCategoryClicked(this)" url="materials" category_id="6">
                        <div class="icon">lightbulb_outline</div>
                        <div class="text">Ідеї для матеріалів</div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="button" onclick="OnFilterExpandClicked(this)">
                    <div class="text">Показати параметри пошуку</div>
                </div>
                <div class="scope">
                    <div class="header">
                        <div class="line"></div>
                        <div class="text">
                            Сфери діяльності:
                        </div>
                    </div>
                    <div id="scope_output"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="results">
                <div class="header">
                    <div class="line"></div>
                    <div class="text">
                        Результати пошуку:
                    </div>
                </div>
                <div class="navigation">
                    <div class="search">
                        <div class="icon">search</div>
                        <input id="keywords_input" type="text" placeholder="будь-які ключові слова" onchange="OnInputChanged()" value="<?= isset($_REQUEST["query"]) ? $_REQUEST["query"] : ""; ?>" >
                    </div>
                    <div class="page_controlls" current_page="0" total_pages="0">
                        <div class="icon" onclick="OnPreviousPageClicked(this)">keyboard_arrow_left</div>
                        <div class="text">Сторінка 1 / 0</div>
                        <div class="icon" onclick="OnNextPageClicked(this)">keyboard_arrow_right</div>
                    </div>
                </div>
                <div id="results"></div>
            </div>
        </div>
    </body>
</html>
