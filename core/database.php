<?php

include_once "entities.php";

class Database
{
    private static $server = "127.0.0.1";
    private static $db = "applingi_mediasphere";
    private static $user = "applingi_admin2";
    private static $password = "QAZwsxedc123";
    private static $connection;

    private static function Connect()
    {
        Database::$connection = mysqli_connect(Database::$server, Database::$user, Database::$password);
        if (mysqli_select_db(Database::$connection, Database::$db))
        {
            mysqli_set_charset(Database::$connection, "utf8");
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function Register($name, $workplace, $position, $phone, $email, $password)
    {
        if (Database::Connect())
        {
            $query = "select count(`email`) from `CONTACTS` where `email` like '$email' or `phone` like '$phone'";
            $answer = mysqli_query(Database::$connection, $query);
            $result = mysqli_fetch_row($answer);

            if ($result[0] == 0)
            {
                $query = "insert into `CONTACTS` (`name`, `workplace`, `position`, `phone`, `email`, `password`) values ('$name', '$workplace', '$position', '$phone', '$email', '$password')";
                $answer = mysqli_query(Database::$connection, $query);
                return $answer;
            }
            else
            {
                return -1;
            }
        }
        return null;
    }

    public static function Login($email, $password)
    {
        if (Database::Connect())
        {
            $query = "select c.id, c.verified, g.access from CONTACTS as c, GROUPS as g where c.group_id = g.id and email like '$email' and password like '$password'";
            $answer = mysqli_query(Database::$connection, $query);

            if ($answer->num_rows == 0)
            {
                return "NO_MATCH";
            }
            else
            {
                $row = mysqli_fetch_row($answer);
                return $row[1] == 0 ? "NOT_VERIFIED" : "ID=$row[0]&ACCESS=$row[2]";
            }
        }
        return null;
    }

    public static function GetSpheres()
    {
        if (Database::Connect())
        {
            $query = "select * from SPHERES order by name";
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_array($answer, MYSQLI_NUM))
            {
                $spheres[$index] = new Sphere($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $spheres;
        }
        return null;
    }

    public static function InsertMaterial($title, $short_description, $description, $location, $deadline, $author_id, $scope)
    {
        if (Database::Connect())
        {
            $query = "insert into MATERIALS (title, short_description, description, location, deadline, author_id) values ('$title', '$short_description', '$description', '$location', '$deadline', $author_id)";
            $answer = mysqli_query(Database::$connection, $query);

            if ($answer)
            {
                $material_id = mysqli_insert_id(Database::$connection);
                $query = "insert into MATERIALS_SCOPE (material_id, sphere_id) values ";
                foreach ($scope as $sphere_id)
                {
                    $query .= "($material_id, $sphere_id), ";
                }
                $query = substr($query, 0, strlen($query) - 2);
                $answer = mysqli_query(Database::$connection, $query);

                return $answer;
            }
            else
            {
                return -1;
            }
        }
        return null;
    }

    public static function InsertContact($name, $workplace, $position, $location, $group_id, $phone, $email, $vk, $facebook, $twitter, $website, $author_id, $scope)
    {
        if (Database::Connect())
        {
            $query = "insert into CONTACTS (name, workplace, position, location, group_id, phone, email, vk, facebook, twitter, website, author_id) values ('$name', '$workplace', '$position', '$location', $group_id, '$phone', '$email', '$vk', '$facebook', '$twitter', '$website', '$author_id')";
            $answer = mysqli_query(Database::$connection, $query);

            if ($answer)
            {
                $contact_id = mysqli_insert_id(Database::$connection);

                $query = "update CONTACTS set photo = 'contact_$contact_id.png' where id = $contact_id";
                $answer = mysqli_query(Database::$connection, $query);

                $query = "insert into CONTACTS_SCOPE (contact_id, sphere_id) values ";
                foreach ($scope as $sphere_id)
                {
                    $query .= "($contact_id, $sphere_id), ";
                }
                $query = substr($query, 0, strlen($query) - 2);
                $answer = mysqli_query(Database::$connection, $query);

                return $contact_id;
            }
            else
            {
                return -1;
            }
        }
        return null;
    }

    public static function InsertAgent($name, $workplace, $position, $phone, $email, $contact_id)
    {
        if (Database::Connect())
        {
            $query = "insert into AGENTS (name, workplace, position, phone, email, contact_id) values ('$name', '$workplace', '$position', '$phone', '$email', $contact_id)";
            $answer = mysqli_query(Database::$connection, $query);

            return $query;
        }
        return null;
    }

    public static function GetPendingContacts($index, $quantity, $keywords)
    {
        if (Database::Connect())
        {
            $query = "select * from CONTACTS where verified = 0";
            if ($keywords != "")
            {
                $query .= " and (";
                $list = preg_split("/\\b/", $keywords, -1, PREG_SPLIT_NO_EMPTY);
                $flag = false;
                foreach ($list as $k)
                {
                    if ($k != " ")
                    {
                        $query .= "name like '%$k%' or workplace like '%$k%' or position like '%$k%' or location like '%$k%' or ";
                        $flag = true;
                    }
                }
                if ($flag)
                {
                    $query = substr($query, 0, strlen($query) - 4);
                    $query .= ") limit $index, $quantity;";
                }
            }
            else
            {
                $query .= " limit $index, $quantity;";
            }
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_array($answer, MYSQLI_NUM))
            {
                $contact[$index] = new Contact($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $contact;
        }
        return null;
    }

    public static function CountPendingContacts($keywords)
    {
        if (Database::Connect())
        {
            $query = "select count(*) from CONTACTS where verified = 0";
            if ($keywords != "")
            {
                $query .= " and (";
                $list = preg_split("/\\b/", $keywords, -1, PREG_SPLIT_NO_EMPTY);
                $flag = false;
                foreach ($list as $k)
                {
                    if ($k != " ")
                    {
                        $query .= "name like '%$k%' or workplace like '%$k%' or position like '%$k%' or location like '%$k%' or ";
                        $flag = true;
                    }
                }
                if ($flag)
                {
                    $query = substr($query, 0, strlen($query) - 4);
                    $query .= ");";
                }
            }
            $answer = mysqli_query(Database::$connection, $query);

            $row = mysqli_fetch_row($answer);
            mysqli_close(Database::$connection);
            return $row[0];
        }
        return null;
    }

    public static function GetPendingMaterials($index, $quantity, $keywords)
    {
        if (Database::Connect())
        {
            $query = "select * from MATERIALS where verified = 0";
            if ($keywords != "")
            {
                $query .= " and (";
                $list = preg_split("/\\b/", $keywords, -1, PREG_SPLIT_NO_EMPTY);
                $flag = false;
                foreach ($list as $k)
                {
                    if ($k != " ")
                    {
                        $query .= "title like '%$k%' or short_description like '%$k%' or description like '%$k%' or location like '%$k%' or ";
                        $flag = true;
                    }
                }
                if ($flag)
                {
                    $query = substr($query, 0, strlen($query) - 4);
                    $query .= ") limit $index, $quantity;";
                }
            }
            else
            {
                $query .= " limit $index, $quantity;";
            }
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_array($answer, MYSQLI_NUM))
            {
                $materials[$index] = new Material($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $materials;
        }
        return null;
    }

    public static function CountPendingMaterials($keywords)
    {
        if (Database::Connect())
        {
            $query = "select count(id) from MATERIALS where verified = 0";
            if ($keywords != "")
            {
                $query .= " and (";
                $list = preg_split("/\\b/", $keywords, -1, PREG_SPLIT_NO_EMPTY);
                $flag = false;
                foreach ($list as $k)
                {
                    if ($k != " ")
                    {
                        $query .= "title like '%$k%' or short_description like '%$k%' or description like '%$k%' or location like '%$k%' or ";
                        $flag = true;
                    }
                }
                if ($flag)
                {
                    $query = substr($query, 0, strlen($query) - 4);
                    $query .= ");";
                }
            }
            $answer = mysqli_query(Database::$connection, $query);

            $row = mysqli_fetch_row($answer);
            mysqli_close(Database::$connection);
            return $row[0];
        }
        return null;
    }

    public static function GetContact($id)
    {
        if (Database::Connect())
        {
            $query = "select * from CONTACTS where id = $id limit 1";
            $answer = mysqli_query(Database::$connection, $query);

            $row = mysqli_fetch_array($answer, MYSQLI_NUM);
            $contact = new Contact($row);

            $query = "update CONTACTS set `views` = `views` + 1 where id = $id";
            $answer = mysqli_query(Database::$connection, $query);

            mysqli_close(Database::$connection);
            return $contact;
        }
        return null;
    }

    public static function GetMaterial($id)
    {
        if (Database::Connect())
        {
            $query = "select * from MATERIALS where id = $id limit 1";
            $answer = mysqli_query(Database::$connection, $query);

            $row = mysqli_fetch_array($answer, MYSQLI_NUM);
            $material = new Material($row);

            $query = "update MATERIALS set `views` = `views` + 1 where id = $id";
            $answer = mysqli_query(Database::$connection, $query);

            mysqli_close(Database::$connection);
            return $material;
        }
        return null;
    }

    public static function GetContactScope($id)
    {
        if (Database::Connect())
        {
            $query = "select s.* from SPHERES as s, CONTACTS_SCOPE as c where c.contact_id = $id and c.sphere_id = s.id";
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_row($answer))
            {
                $spheres[$index] = new Sphere($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $spheres;
        }
        return null;
    }

    public static function GetMaterialScope($id)
    {
        if (Database::Connect())
        {
            $query = "select s.* from SPHERES as s, MATERIALS_SCOPE as m where m.material_id = $id and m.sphere_id = s.id";
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_row($answer))
            {
                $spheres[$index] = new Sphere($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $spheres;
        }
        return null;
    }

    public static function GetContactAgents($id)
    {
        if (Database::Connect())
        {
            $query = "select a.id, a.name, a.workplace, a.position, a.phone, a.email from AGENTS as a, CONTACTS as c where c.id = $id and a.contact_id = c.id";
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_row($answer))
            {
                $agents[$index] = new Agent($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $agents;
        }
        return null;
    }

    public static function VerifyContact($id)
    {
        if (Database::Connect())
        {
            $query = "update CONTACTS set verified = 1 where id = $id";
            $answer = mysqli_query(Database::$connection, $query);

            return $answer;
        }
        return null;
    }

    public static function VerifyMaterial($id)
    {
        if (Database::Connect())
        {
            $query = "update MATERIALS set verified = 1 where id = $id";
            $answer = mysqli_query(Database::$connection, $query);

            return $answer;
        }
        return null;
    }

    public static function DeleteContact($id)
    {
        if (Database::Connect())
        {
            $query = "delete from CONTACTS where id = $id";
            $answer = mysqli_query(Database::$connection, $query);

            return $answer;
        }
        return null;
    }

    public static function DeleteMaterial($id)
    {
        if (Database::Connect())
        {
            $query = "delete from MATERIALS where id = $id";
            $answer = mysqli_query(Database::$connection, $query);

            return $answer;
        }
        return null;
    }

    public static function InsertNotification($content, $contact_id, $type_id)
    {
        if (Database::Connect())
        {
            $content = mysqli_escape_string(Database::$connection, $content);
            $query = "insert into NOTIFICATIONS (content, contact_id, type_id) values ('$content', $contact_id, $type_id)";
            $answer = mysqli_query(Database::$connection, $query);

            return $answer;
        }
        return null;
    }

    public static function DeleteNotification($id)
    {
        if (Database::Connect())
        {
            $query = "delete from NOTIFICATIONS where id = $id";
            $answer = mysqli_query(Database::$connection, $query);

            return $answer;
        }
        return null;
    }

    public static function GetContactNotifications($contact_id)
    {
        if (Database::Connect())
        {
            $query = "select * from NOTIFICATIONS where contact_id = $contact_id order by occurred limit 20";
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_row($answer))
            {
                $notifications[$index] = new Notification($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $notifications;
        }
        return null;
    }

    public static function UpdateContact($id, $name, $workplace, $position, $location, $phone, $email, $vk, $facebook, $twitter, $website, $scope)
    {
        if (Database::Connect())
        {
            $query = "update CONTACTS set name = '$name', workplace = '$workplace', position = '$position', location = '$location', phone = '$phone', email = '$email', vk = '$vk', facebook = '$facebook', twitter = '$twitter', website = '$website' where id = $id";
            $answer = mysqli_query(Database::$connection, $query);

            if ($answer)
            {

                $query = "delete from CONTACTS_SCOPE where contact_id = $id";
                $answer = mysqli_query(Database::$connection, $query);

                if ($answer)
                {
                    $query = "insert into CONTACTS_SCOPE (contact_id, sphere_id) values ";
                    foreach ($scope as $sphere_id)
                    {
                        $query .= "($id, $sphere_id), ";
                    }
                    $query = substr($query, 0, strlen($query) - 2);
                    $answer = mysqli_query(Database::$connection, $query);

                    return $answer;
                }
            }
        }
        return null;
    }

    public static function GetMaterials($index, $quantity, $keywords, $scope)
    {
        if (Database::Connect())
        {
            $query = "select distinct m.* from MATERIALS as m, MATERIALS_SCOPE as ms where verified = 1 and ms.material_id = m.id";
            if (count($scope) > 0)
            {
                $query .= " and (";
                foreach ($scope as $s)
                {
                    $query .= "ms.sphere_id = $s or ";
                }
                $query = substr($query, 0, strlen($query) - 4);
                $query .= ")";
            }
            if ($keywords != "")
            {
                $query .= " and (";
                $list = preg_split("/\\b/", $keywords, -1, PREG_SPLIT_NO_EMPTY);
                $flag = false;
                foreach ($list as $k)
                {
                    if ($k != " ")
                    {
                        $query .= "title like '%$k%' or short_description like '%$k%' or description like '%$k%' or location like '%$k%' or ";
                        $flag = true;
                    }
                }
                if ($flag)
                {
                    $query = substr($query, 0, strlen($query) - 4);
                    $query .= ") limit $index, $quantity;";
                }
            }
            else
            {
                $query .= " limit $index, $quantity;";
            }
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_array($answer, MYSQLI_NUM))
            {
                $materials[$index] = new Material($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $materials;
        }
        return null;
    }

    public static function CountMaterials($keywords, $scope)
    {
        if (Database::Connect())
        {
            $query = "select count(distinct m.id) from MATERIALS as m, MATERIALS_SCOPE as ms where verified = 1 and ms.material_id = m.id";
            if (count($scope) > 0)
            {
                $query .= " and (";
                foreach ($scope as $s)
                {
                    $query .= "ms.sphere_id = $s or ";
                }
                $query = substr($query, 0, strlen($query) - 4);
                $query .= ")";
            }
            if ($keywords != "")
            {
                $query .= " and (";
                $list = preg_split("/\\b/", $keywords, -1, PREG_SPLIT_NO_EMPTY);
                $flag = false;
                foreach ($list as $k)
                {
                    if ($k != " ")
                    {
                        $query .= "title like '%$k%' or short_description like '%$k%' or description like '%$k%' or location like '%$k%' or ";
                        $flag = true;
                    }
                }
                if ($flag)
                {
                    $query = substr($query, 0, strlen($query) - 4);
                    $query .= ");";
                }
            }
            $answer = mysqli_query(Database::$connection, $query);

            $row = mysqli_fetch_row($answer);
            mysqli_close(Database::$connection);
            return $row[0];
        }
        return null;
    }

    public static function GetContacts($group_id, $index, $quantity, $keywords, $scope)
    {
        if (Database::Connect())
        {
            $query = "select distinct c.* from CONTACTS as c, CONTACTS_SCOPE as cs where verified = 1 and cs.contact_id = c.id and group_id = $group_id";
            if (count($scope) > 0)
            {
                $query .= " and (";
                foreach ($scope as $s)
                {
                    $query .= "cs.sphere_id = $s or ";
                }
                $query = substr($query, 0, strlen($query) - 4);
                $query .= ")";
            }
            if ($keywords != "")
            {
                $query .= " and (";
                $list = preg_split("/\\b/", $keywords, -1, PREG_SPLIT_NO_EMPTY);
                $flag = false;
                foreach ($list as $k)
                {
                    if ($k != " ")
                    {
                        $query .= "name like '%$k%' or workplace like '%$k%' or position like '%$k%' or location like '%$k%' or ";
                        $flag = true;
                    }
                }
                if ($flag)
                {
                    $query = substr($query, 0, strlen($query) - 4);
                    $query .= ") limit $index, $quantity;";
                }
            }
            else
            {
                $query .= " limit $index, $quantity;";
            }
            $answer = mysqli_query(Database::$connection, $query);

            if ($answer)
            {
                $index = 0;
                while ($row = mysqli_fetch_array($answer, MYSQLI_NUM))
                {
                    $contacts[$index] = new Contact($row);
                    $index++;
                }
                mysqli_close(Database::$connection);
                return $contacts;
            }
        }
        return null;
    }

    public static function CountContacts($group_id, $keywords, $scope)
    {
        if (Database::Connect())
        {
            $query = "select count(distinct c.id) from CONTACTS as c, CONTACTS_SCOPE as cs where verified = 1 and cs.contact_id = c.id and group_id = $group_id";
            if (count($scope) > 0)
            {
                $query .= " and (";
                foreach ($scope as $s)
                {
                    $query .= "cs.sphere_id = $s or ";
                }
                $query = substr($query, 0, strlen($query) - 4);
                $query .= ")";
            }
            if ($keywords != "")
            {
                $query .= " and (";
                $list = preg_split("/\\b/", $keywords, -1, PREG_SPLIT_NO_EMPTY);
                $flag = false;
                foreach ($list as $k)
                {
                    if ($k != " ")
                    {
                        $query .= "name like '%$k%' or workplace like '%$k%' or position like '%$k%' or location like '%$k%' or ";
                        $flag = true;
                    }
                }
                if ($flag)
                {
                    $query = substr($query, 0, strlen($query) - 4);
                    $query .= ");";
                }
            }
            $answer = mysqli_query(Database::$connection, $query);

            $row = mysqli_fetch_row($answer);
            mysqli_close(Database::$connection);
            return $row[0];
        }
        return null;
    }

    public static function CheckPurchase($buyer_id, $contact_id)
    {
        if (Database::Connect())
        {
            $query = "select count(*) from PURCHASES where buyer_id = $buyer_id and contact_id = $contact_id";
            $answer = mysqli_query(Database::$connection, $query);

            $row = mysqli_fetch_row($answer);
            mysqli_close(Database::$connection);
            return $row[0];
        }
        return null;
    }

    public static function InsertPurchase($buyer_id, $contact_id, $author_id)
    {
        if (Database::Connect())
        {
            $query = "insert into PURCHASES (buyer_id, contact_id) values ($buyer_id, $contact_id)";
            $answer = mysqli_query(Database::$connection, $query);

            $id = mysqli_insert_id(Database::$connection);

            if ($answer)
            {
                $query = "update CONTACTS set `points` = `points` - 10 where id = $buyer_id";
                $answer = mysqli_query(Database::$connection, $query);

                $query = "update CONTACTS set `points` = `points` + 1 where id = $author_id";
                $answer = mysqli_query(Database::$connection, $query);
            }

            mysqli_close(Database::$connection);
            return $answer;
        }
        return null;
    }

    public static function GetOwnedContacts($id, $index, $quantity, $keywords)
    {
        if (Database::Connect())
        {
            $subquery_1 = "(select * from CONTACTS where author_id = $id)";
            $subquery_2 = "(select c.* from CONTACTS as c, PURCHASES as p where p.buyer_id = $id and c.id = p.contact_id)";
            $query = "select c2.* from ($subquery_1 union all $subquery_2) as c2";
            if ($keywords != "")
            {
                $query .= " where (";
                $list = preg_split("/\\b/", $keywords, -1, PREG_SPLIT_NO_EMPTY);
                $flag = false;
                foreach ($list as $k)
                {
                    if ($k != " ")
                    {
                        $query .= "c2.name like '%$k%' or c2.workplace like '%$k%' or c2.position like '%$k%' or c2.location like '%$k%' or ";
                        $flag = true;
                    }
                }
                if ($flag)
                {
                    $query = substr($query, 0, strlen($query) - 4);
                    $query .= ") group by c2.id limit $index, $quantity;";
                }
            }
            else
            {
                $query .= " group by c2.id limit $index, $quantity;";
            }
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_array($answer, MYSQLI_NUM))
            {
                $contacts[$index] = new Contact($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $contacts;
        }
        return null;
    }

    public static function CountOwnedContacts($id, $keywords)
    {
        if (Database::Connect())
        {
            $subquery_1 = "(select * from CONTACTS where author_id = $id)";
            $subquery_2 = "(select c.* from CONTACTS as c, PURCHASES as p where p.buyer_id = $id and c.id = p.contact_id)";
            $query = "select count(*) from (select c2.* from ($subquery_1 union all $subquery_2) as c2";
            if ($keywords != "")
            {
                $query .= " where (";
                $list = preg_split("/\\b/", $keywords, -1, PREG_SPLIT_NO_EMPTY);
                $flag = false;
                foreach ($list as $k)
                {
                    if ($k != " ")
                    {
                        $query .= "c2.name like '%$k%' or c2.workplace like '%$k%' or c2.position like '%$k%' or c2.location like '%$k%' or ";
                        $flag = true;
                    }
                }
                if ($flag)
                {
                    $query = substr($query, 0, strlen($query) - 4);
                    $query .= ") group by c2.id) as c3";
                }
            }
            else
            {
                $query .= " group by c2.id) as c3";
            }
            $answer = mysqli_query(Database::$connection, $query);

            $row = mysqli_fetch_row($answer);
            mysqli_close(Database::$connection);
            return $row[0];
        }
        return null;
    }

    public static function GetPopularContacts()
    {
        if (Database::Connect())
        {
            $query = "select * from CONTACTS where verified = 1 and (group_id = 3 or group_id = 4 or group_id = 5) order by views desc limit 5";
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_array($answer, MYSQLI_NUM))
            {
                $contacts[$index] = new Contact($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $contacts;

        }
        return null;
    }

    public static function GetPopularMaterials()
    {
        if (Database::Connect())
        {
            $query = "select * from MATERIALS where verified = 1 order by views desc limit 4";
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_array($answer, MYSQLI_NUM))
            {
                $materials[$index] = new Material($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $materials;

        }
        return null;
    }

    public static function InsertReport($sender_id, $contact_id, $content)
    {
        if (Database::Connect())
        {
            $query = "insert into REPORTS (sender_id, contact_id, content) values ($sender_id, $contact_id, '$content')";
            $answer = mysqli_query(Database::$connection, $query);

            mysqli_close(Database::$connection);
            return $answer;

        }
        return null;
    }

    public static function GetReports($index, $quantity, $keywords)
    {
        if (Database::Connect())
        {
            $query = "select r.* from REPORTS as r";
            if ($keywords != "")
            {
                $query .= ", CONTACTS as c where r.contact_id = c.id and (";
                $list = preg_split("/\\b/", $keywords, -1, PREG_SPLIT_NO_EMPTY);
                $flag = false;
                foreach ($list as $k)
                {
                    if ($k != " ")
                    {
                        $query .= "c.name like '%$k%' or c.workplace like '%$k%' or c.position like '%$k%' or c.location like '%$k%' or ";
                        $flag = true;
                    }
                }
                if ($flag)
                {
                    $query = substr($query, 0, strlen($query) - 4);
                    $query .= ") limit $index, $quantity;";
                }
            }
            else
            {
                $query .= " limit $index, $quantity;";
            }
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_array($answer, MYSQLI_NUM))
            {
                $reports[$index] = new Report($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $reports;

        }
        return null;
    }

    public static function CountReports($keywords)
    {
        if (Database::Connect())
        {
            $query = "select count(r.id) from REPORTS as r";
            if ($keywords != "")
            {
                $query .= ", CONTACTS as c where r.contact_id = c.id and (";
                $list = preg_split("/\\b/", $keywords, -1, PREG_SPLIT_NO_EMPTY);
                $flag = false;
                foreach ($list as $k)
                {
                    if ($k != " ")
                    {
                        $query .= "c.name like '%$k%' or c.workplace like '%$k%' or c.position like '%$k%' or c.location like '%$k%' or ";
                        $flag = true;
                    }
                }
                if ($flag)
                {
                    $query = substr($query, 0, strlen($query) - 4);
                    $query .= ");";
                }
            }
            $answer = mysqli_query(Database::$connection, $query);

            $row = mysqli_fetch_row($answer);
            mysqli_close(Database::$connection);
            return $row[0];

        }
        return null;
    }

    public static function GetContactReports($sender_id = null, $contact_id = null)
    {
        if (Database::Connect())
        {
            $query = "select * from REPORTS" . ($sender_id != null || $contact_id != null ? " where contact_id = $contact_id and sender_id = $sender_id" : "");
            $answer = mysqli_query(Database::$connection, $query);

            $index = 0;
            while ($row = mysqli_fetch_array($answer, MYSQLI_NUM))
            {
                $reports[$index] = new Report($row);
                $index++;
            }
            mysqli_close(Database::$connection);
            return $reports;

        }
        return null;
    }

    public static function GetReport($id)
    {
        if (Database::Connect())
        {
            $query = "select * from REPORTS where id = $id";
            $answer = mysqli_query(Database::$connection, $query);

            $row = mysqli_fetch_row($answer);
            mysqli_close(Database::$connection);
            return new Report($row);

        }
        return null;
    }

    public static function DeleteReport($id)
    {
        if (Database::Connect())
        {
            $query = "delete from REPORTS where id = $id";
            $answer = mysqli_query(Database::$connection, $query);

            mysqli_close(Database::$connection);
            return $answer;

        }
        return null;
    }
}