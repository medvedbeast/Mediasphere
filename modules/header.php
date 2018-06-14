<header class="shadow-big">
    <div class="content">
        <div class="icon logo">language</div>
        <div class="breadcrumbs">
            <a href="main.php">
                <div class="item">mediasphere.ua</div>
            </a>
            <?php
            if (count($breadcrumbs) > 0)
            {
                foreach ($breadcrumbs as $b)
                {
                    ?>
                    <div class="separator">/</div>
                    <a href="<?= $b[1] ?>">
                        <div class="item"><?= $b[0] ?></div>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <div class="separator"></div>
        <div class="menu">
            <a href="account.php">
                <div class="item">аккаунт</div>
            </a>
            <a href="unlocked.php">
                <div class="item">мої контакти</div>
            </a>
            <a href="create.php">
                <div class="item highlighted">створити контакт / матеріал</div>
            </a>
            <?php
            if ($_COOKIE["access"] == 0 && isset($_COOKIE["access"]))
            {
                ?>
                <a href="requests.php">
                    <div class="icon">group_add</div>
                </a>
                <a href="reports.php">
                    <div class="icon">bug_report</div>
                </a>
                <?php
            }
            ?>
            <div class="icon" onclick="OnLogoutClick()">exit_to_app</div>
        </div>
    </div>
</header>