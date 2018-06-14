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

$breadcrumbs = array(array("аккаунт", "account.php"));

$contact = Database::GetContact($user_id);
?>
<!DOCTYPE html>
<html lang="ua">
    <head>
        <?php include "modules/meta.php"; ?>
        <link href="css/account.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/account.js"></script>
    </head>
    <body>
        <?php include "modules/header.php" ?>
        <div class="page">
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
                        $scope = Database::GetContactScope($user_id);
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
                    <div class="balance">
                        <div class="icon">attach_money</div>
                        <div class="text"><?= $contact->points ?> балiв на рахунку</div>
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
                        <div class="value"><?= $contact->phone ?></div>
                    </div>
                    <div class="item">
                        <div class="icon">email</div>
                        <div class="text">E-mail :</div>
                        <div class="value"><?= $contact->email ?></div>
                    </div>
                    <div class="item">
                        <div class="icon">language</div>
                        <div class="text">вКонтакте :</div>
                        <div class="value"><?= $contact->vk ?></div>
                    </div>
                    <div class="item">
                        <div class="icon">language</div>
                        <div class="text">Facebook :</div>
                        <div class="value"><?= $contact->facebook ?></div>
                    </div>
                    <div class="item">
                        <div class="icon">language</div>
                        <div class="text">Twitter :</div>
                        <div class="value"><?= $contact->twitter ?></div>
                    </div>
                    <div class="item">
                        <div class="icon">language</div>
                        <div class="text">Веб-сайт :</div>
                        <div class="value"><?= $contact->website ?></div>
                    </div>
                </div>
                <div class="photo">
                    <div class="image" style="background-image: url('images/contacts/<?= $contact->photo ?>')"></div>
                    <a href="editAccount.php">
                        <div class="button">
                            <div class="icon">edit</div>
                            <div class="text">редагувати профіль</div>
                        </div>
                    </a>
                </div>
                <div class="clear"></div>
            </div>
            <?php
            $notifications = Database::GetContactNotifications($user_id);
            if (count($notifications) > 0)
            {
                ?>
                <div class="log">
                    <div class="header">
                        <div class="line"></div>
                        <div class="text">Сповіщення:</div>
                    </div>
                    <div class="content">
                        <?php
                        foreach ($notifications as $n)
                        {
                            ?>
                            <div class="item <?= $n->type_id == 1 ? "enrollment" : ($n->type_id == 2 ? "spending" : "info") ?>" onclick="OnDismissNotification(this, <?= $n->id ?>)">
                                <div class="text">
                                    <div class="title"><?= $n->content ?></div>
                                    <div class="info"><?= $n->occurred ?></div>
                                </div>
                                <div class="icon"><?= $n->type_id == 1 ? "add" : ($n->type_id == 2 ? "remove" : "priority_high") ?></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </body>
</html>
