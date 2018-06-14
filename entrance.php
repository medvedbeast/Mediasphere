<!DOCTYPE html>
<html lang="ua">
    <head>
        <?php include "modules/meta.php"; ?>
        <link href="css/entrance.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/entrance.js"></script>
    </head>
    <body onload="OnBodyLoad()">
        <div class="background">
            <div></div>
        </div>
        <div class="container">
            <div class="form shadow-small">
                <div class="tabs">
                    <div class="tab <?= !isset($_REQUEST["action"]) ? "selected" : $_REQUEST["action"] == "login" ? "selected" : $_REQUEST["action"] == "relogin" ? "selected" : "" ?>" onclick="OnTabClick(this, 1)">
                        Вхід
                    </div>
                    <div class="tab <?= $_REQUEST["action"] == "register" ? "selected" : "" ?>" onclick="OnTabClick(this, 2)">
                        Реєстрація
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="pages">
                    <div id="page-1" class="page <?= !isset($_REQUEST["action"]) ? "selected" : $_REQUEST["action"] == "login" ? "visible" : $_REQUEST["action"] == "relogin" ? "visible" : "" ?>">
                        <div class="information"><?= $_REQUEST["action"] == "relogin" ? "<div style='color: orange;'>Час сесії минув. Для продовженя увійдіть знову.</div>" : "" ?></div>
                        <div class="input">
                            <div class="icon">email</div>
                            <input id="l-login" type="email" placeholder="E-mail" />
                            <div class="clear"></div>
                        </div>
                        <div class="input">
                            <div class="icon">lock</div>
                            <input id="l-password" type="password" placeholder="Пароль" />
                            <div class="clear"></div>
                        </div>
                        <div class="button" onclick="OnLoginClick()">Увійти!</div>
                    </div>
                    <div id="page-2" class="page <?= $_REQUEST["action"] == "register" ? "visible" : "" ?>">
                        <div class="information"></div>
                        <div class="input">
                            <div class="icon">format_size</div>
                            <input id="r-name" type="text" placeholder="Повне ім'я" />
                            <div class="clear"></div>
                        </div>
                        <div class="input">
                            <div class="icon">domain</div>
                            <input id="r-work" type="text" placeholder="Місце роботи" />
                            <div class="clear"></div>
                        </div>
                        <div class="input">
                            <div class="icon">work</div>
                            <input id="r-position" type="text" placeholder="Посада" />
                            <div class="clear"></div>
                        </div>
                        <div class="input">
                            <div class="icon">phone</div>
                            <input id="r-telephone" type="tel" placeholder="Контактний телефон" />
                            <div class="clear"></div>
                        </div>
                        <div class="input">
                            <div class="icon">email</div>
                            <input id="r-login" type="email" placeholder="E-mail" />
                            <div class="clear"></div>
                        </div>
                        <div class="input">
                            <div class="icon">lock</div>
                            <input id="r-password" type="password" placeholder="Пароль" />
                            <div class="clear"></div>
                        </div>
                        <div class="button" onclick="OnRegisterClick()">Зареєструватися!</div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>