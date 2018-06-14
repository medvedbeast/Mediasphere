<?php
include_once "core/database.php";

$user_id = -1;
if (isset($_COOKIE["user"]))
{
    $user_id = $_COOKIE["user"];
}
else
{
    header("Location: entrance.php?action=relogin");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ua">
    <head>
        <?php include "modules/meta.php"; ?>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/main.js"></script>
    </head>
    <body>
        <?php include "modules/header.php"; ?>
        <div class="page">
            <div class="search">
                <div class="header">
                    <div class="line"></div>
                    <div class="text">Пошук у базі даних:</div>
                </div>
                <div class="input">
                    <div class="icon">search</div>
                    <input id="search" placeholder="Ключові слова / ім'я / місце роботи / тощо" type="text" />
                    <div class="button" onclick="OnSearchClicked()">
                        <div class="text">пошук</div>
                        <div class="icon">chevron_right</div>
                    </div>
                </div>
            </div>
            <div class="selector">
                <div class="header">
                    <div class="line"></div>
                    <div class="text">Переглянути категорію:</div>
                </div>
                <a href="search.php?category=celebrities">
                    <div class="column">
                        <div class="text">База публічних персон та їх менеджерів</div>
                    </div>
                </a>
                <a href="search.php?category=stringers">
                    <div class="column" color="2">
                        <div class="text">База стрінгерів</div>
                    </div>
                </a>
                <a href="search.php?category=experts">
                    <div class="column" color="3">
                        <div class="text">База експертів та пресс-служб державних установ</div>
                    </div>
                </a>
                <a href="search.php?category=materials">
                    <div class="column" color="4">
                        <div class="text">Ідеї для матеріалів</div>
                    </div>
                </a>
                <div class="clear"></div>
            </div>
            <div class="popular">
                <div class="header">
                    <div class="line"></div>
                    <div class="text">Найпопулярніші контакти:</div>
                </div>
                <div class="container">
                    <?php
                    $contacts = Database::GetPopularContacts();
                    $index = 0;
                    foreach ($contacts as $c)
                    {
                        ?>
                        <div class="item <?= $index != 0 ? "indented" : "" ?>" onmouseover="OnPopularItemMouseOver(this)" onmouseout="OnPopularItemMouseOut(this)">
                            <div class="face" style="background-image: url('images/contacts/<?= $c->photo ?>')"></div>
                            <a href="details.php?item=<?= $c->id ?>&type=0">
                                <div class="back">
                                    <div class="name"><?= $c->name ?></div>
                                    <div class="description"><?= "$c->workplace<br/>$c->position" ?></div>
                                </div>
                            </a>
                        </div>
                        <div class="clear"></div>
                        <?php
                        $index++;
                    }
                    ?>
                </div>
            </div>
            <div class="ideas">
                <div class="header">
                    <div class="line"></div>
                    <div class="text">Свіжі ідеї для матеріалів:</div>
                </div>
                <div class="container">
                    <?php
                    $materials = Database::GetPopularMaterials();
                    $index = 0;
                    foreach ($materials as $m)
                    {
                        if ($index == 0)
                        {
                            ?>
                            <div class="row">
                            <?php
                        }
                        ?>
                        <a href="details.php?item=<?= $m->id ?>&type=1">
                            <div class="item <?= $index != 0 ? "padded" : "" ?>">
                                <div class="title"><?= $m->title ?></div>
                                <div class="description"><?= $m->short_description ?></div>
                                <div class="tags">
                                    <?php
                                    $scope = Database::GetMaterialScope($m->id);
                                    foreach ($scope as $s)
                                    {
                                        ?>
                                        <div class="tag"><?= "#$s->name" ?></div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="info">
                                    <div class="location">
                                        <div class="icon">location_on</div>
                                        <div class="text"><?= $m->location ?></div>
                                    </div>
                                    <div class="deadline">
                                        <div class="icon">alarm</div>
                                        <div class="text"><?= $m->deadline ?></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                        $index++;
                        if ($index == 2)
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
    </body>
</html>
