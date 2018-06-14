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

$breadcrumbs = array(array("заявки на внесення", "requests.php"), array("попередній перегляд", "preview.php?item=" . $_REQUEST["item"] . "&type=" . $_REQUEST["type"]));

if ($_REQUEST["type"] == 0)
{
    $contact = Database::GetContact($_REQUEST["item"]);
    $owner = Database::GetContact($contact->author_id);
}
else
{
    $material = Database::GetMaterial($_REQUEST["item"]);
    $owner = Database::GetContact($material->author_id);
}

?>
<!DOCTYPE html>
<html lang="ua">
    <head>
        <?php include "modules/meta.php"; ?>
        <link href="css/preview.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/preview.js"></script>
    </head>
    <body>
        <?php include "modules/header.php"; ?>
        <div class="page">
            <?php
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
                        <div class="button buy" onclick="OnAcceptContactClicked(<?= $contact->id ?>)">
                            <div class="icon">thumb_up</div>
                            <div class="text">прийняти контакт</div>
                        </div>
                        <div class="button report" onclick="OnRejectContactClicked(<?= $contact->id ?>)">
                            <div class="icon">thumb_down</div>
                            <div class="text">відхилити контакт</div>
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
                                        <div class="text"><?= $a->phone ?></div>
                                    </div>
                                    <div class="email">
                                        <div class="icon">email</div>
                                        <div class="text"><?= $a->email ?></div>
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
            <?php }
            else
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
                            <div class="title">
                                <div class="text"><?= $material->title ?></div>
                                <div class="buttons">
                                    <div class="button accept" onclick="OnAcceptMaterialClicked(<?= $material->id ?>)">
                                        <div class="icon">thumb_up</div>
                                        <div class="text">прийняти ідею</div>
                                    </div>
                                    <div class="button reject" onclick="OnRejectMaterialClicked(<?= $material->id ?>)">
                                        <div class="icon">thumb_down</div>
                                        <div class="text">відхилити ідею</div>
                                    </div>
                                </div>
                            </div>
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
                    <div id="owner" class="owner" owner_id="<?= $owner->id ?>">
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
    </body>
</html>
