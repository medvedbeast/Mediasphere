<?php

class Wrapper
{
    public static function SphereList()
    {
        $column_capacity = 16;
        $index = 0;
        $list = Database::GetSpheres();
        foreach ($list as $item)
        {
            if ($index == 0)
            {
                ?>
                <div class="column">
                <?php
            }
            ?>
            <div class="item" onclick="OnCheckBoxClicked(this)" state="0" sphere_id="<?= $item->id ?>">
                <div class="icon">check_box_outline_blank</div>
                <div class="text"><?= $item->name ?></div>
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
    }

    public static function PendingContactsList($index, $quantity, $keywords)
    {
        $contacts = Database::GetPendingContacts($index, $quantity, $keywords);
        if (count($contacts) < 1)
        {
            ?>
            <div class="empty">
                <div class="icon">error_outline</div>
                <div class="text">За вашим запитом нічого не знайдено!</div>
            </div>
            <?php
            return;
        }
        foreach ($contacts as $c)
        {
            $date = new DateTime($c->registered);
            ?>
            <div class="item">
                <div class="date"><?= $date->format("d.m.Y") ?></div>
                <div class="name"><?= $c->name ?></div>
                <div class="workplace"><?= $c->workplace . " // " . $c->position ?></div>
                <div class="whitespace"></div>
                <a href="preview.php?item=<?= $c->id ?>&type=0">
                    <div class="icon">remove_red_eye</div>
                </a>
                <div class="icon">add</div>
                <div class="icon">delete</div>
            </div>
            <?php
        }
    }

    public static function PendingMaterialsList($index, $quantity, $keywords)
    {
        $materials = Database::GetPendingMaterials($index, $quantity, $keywords);
        if (count($materials) < 1)
        {
            ?>
            <div class="empty">
                <div class="icon">error_outline</div>
                <div class="text">За вашим запитом нічого не знайдено!</div>
            </div>
            <?php
            return;
        }
        foreach ($materials as $m)
        {
            $date = new DateTime($m->registered);
            ?>
            <div class="item">
                <div class="date"><?= $date->format("d.m.Y") ?></div>
                <div class="name"><?= $m->title ?></div>
                <div class="whitespace"></div>
                <a href="preview.php?item=<?= $m->id ?>&type=1">
                    <div class="icon">remove_red_eye</div>
                </a>
                <div class="icon">add</div>
                <div class="icon">delete</div>
            </div>
            <?php
        }
    }

    public static function ContactsList($group_id, $index, $quantity, $keywords, $scope)
    {
        $contacts = Database::GetContacts($group_id, $index, $quantity, $keywords, $scope);
        if (count($contacts) < 1)
        {
            ?>
            <div class="empty">
                <div class="icon">error_outline</div>
                <div class="text">За вашим запитом нічого не знайдено!</div>
            </div>
            <?php
            exit;
        }
        $items_per_row = 4;
        $index = 0;
        foreach ($contacts as $c)
        {
            if ($index == 0)
            {
                ?>
                <div class="row">
                <?php
            }
            ?>
            <a href="details.php?item=<?= $c->id ?>&type=0">
                <div class="contact <?= $index != 0 ? "padded" : "" ?>">
                    <div class="image shadow-small" style="background-image: url('images/contacts/<?= $c->photo ?>')"></div>
                    <div class="title"><?= $c->name ?></div>
                    <div class="work"><?= $c->workplace ?><br /><?= $c->position ?></div>
                    <div class="location">
                        <div class="icon">location_on</div>
                        <div class="text"><?= $c->location ?></div>
                    </div>
                    <div class="tags">
                        <?php
                        $scope = Database::GetContactScope($c->id);
                        foreach ($scope as $s)
                        {
                            ?>
                            <div class="tag"><?= "#$s->name" ?></div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </a>
            <?php
            $index++;
            if ($index == $items_per_row)
            {
                ?>
                </div>
                <?php
                $index = 0;
            }
        }
    }

    public static function MaterialsList($index, $quantity, $keywords, $scope)
    {
        $items_per_row = 2;
        $materials = Database::GetMaterials($index, $quantity, $keywords, $scope);
        if (count($materials) < 1)
        {
            ?>
            <div class="empty">
                <div class="icon">error_outline</div>
                <div class="text">За вашим запитом нічого не знайдено!</div>
            </div>
            <?php
            return;
        }
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
                <div class="idea <?= $index != 0 ? "padded" : "" ?>">
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
            if ($index == $items_per_row)
            {
                ?>
                </div>
                <?php
                $index = 0;
            }
        }
    }

    public static function OwnedContacts($id, $index, $quantity, $keywords)
    {
        $contacts = Database::GetOwnedContacts($id, $index, $quantity, $keywords);
        if (count($contacts) < 1)
        {
            ?>
            <div class="empty">
                <div class="icon">error_outline</div>
                <div class="text">За вашим запитом нічого не знайдено!</div>
            </div>
            <?php
            exit;
        }
        $items_per_row = 4;
        $index = 0;
        foreach ($contacts as $c)
        {
            if ($index == 0)
            {
                ?>
                <div class="row">
                <?php
            }
            ?>
            <a href="details.php?item=<?= $c->id ?>&type=0">
                <div class="contact <?= $index != 0 ? "padded" : "" ?>">
                    <div class="image shadow-small" style="background-image: url('images/contacts/<?= $c->photo ?>')"></div>
                    <div class="title"><?= $c->name ?></div>
                    <div class="work"><?= $c->workplace ?><br /><?= $c->position ?></div>
                    <div class="location">
                        <div class="icon">location_on</div>
                        <div class="text"><?= $c->location ?></div>
                    </div>
                    <div class="tags">
                        <?php
                        $scope = Database::GetContactScope($c->id);
                        foreach ($scope as $s)
                        {
                            ?>
                            <div class="tag"><?= "#$s->name" ?></div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </a>
            <?php
            $index++;
            if ($index == $items_per_row)
            {
                ?>
                </div>
                <?php
                $index = 0;
            }
        }
    }

    public static function ReportsList($index, $quantity, $keywords)
    {
        $reports = Database::GetReports($index, $quantity, $keywords);
        if (count($reports) < 1)
        {
            ?>
            <div class="empty">
                <div class="icon">error_outline</div>
                <div class="text">За вашим запитом нічого не знайдено!</div>
            </div>
            <?php
            return;
        }
        foreach ($reports as $r)
        {
            $c = Database::GetContact($r->contact_id);
            $date = new DateTime($r->sent);
            ?>
            <div class="item">
                <div class="date"><?= $date->format("d.m.Y") ?></div>
                <div class="name"><?= $c->name ?></div>
                <div class="workplace"><?= $c->workplace . " // " . $c->position ?></div>
                <div class="whitespace"></div>
                <a href="details.php?item=<?= $c->id ?>&type=0&report=<?= $r->id ?>">
                    <div class="icon">remove_red_eye</div>
                </a>
            </div>
            <?php
        }
    }
}