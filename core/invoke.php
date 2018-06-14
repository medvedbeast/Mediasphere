<?php

include_once "database.php";
include_once "wrapper.php";

if (!isset($_REQUEST["function"]))
{
    echo "Function is not set!";
    die();
}

switch ($_REQUEST["function"])
{
    case "Register":
    {
        echo Database::Register($_REQUEST["name"], $_REQUEST["place_of_work"], $_REQUEST["work_position"], $_REQUEST["telephone"], $_REQUEST["login"], $_REQUEST["password"]);
        break;
    }
    case "Login":
    {
        echo Database::Login($_REQUEST["login"], $_REQUEST["password"]);
        break;
    }
    case "GetSphereList":
    {
        Wrapper::SphereList();
        break;
    }
    case "InsertMaterial":
    {
        echo Database::InsertMaterial($_REQUEST["title"], $_REQUEST["short_description"], $_REQUEST["description"], $_REQUEST["location"], $_REQUEST["deadline"], $_REQUEST["author"], $_REQUEST["scope"]);
        break;
    }
    case "InsertContact":
    {
        $id = Database::InsertContact($_REQUEST["name"], $_REQUEST["workplace"], $_REQUEST["position"], $_REQUEST["location"], $_REQUEST["group_id"], $_REQUEST["phone"], $_REQUEST["email"], $_REQUEST["vk"], $_REQUEST["facebook"], $_REQUEST["twitter"], $_REQUEST["website"], $_REQUEST["author_id"], $_REQUEST["scope"]);
        if ($id != null && $id != -1)
        {
            $filename = "../images/contacts/contact_$id.png";
            $file = fopen($filename, "w");
            $data = $_REQUEST["photo"];
            $uri = substr($data, strpos($data, ",") + 1);
            file_put_contents($filename, base64_decode($uri));

            foreach ($_REQUEST["agents"] as $agent)
            {
                Database::InsertAgent($agent[0], $agent[1], $agent[2], $agent[3], $agent[4], $id);
            }

            echo 1;
        }
        else
        {
            echo 0;
        }
        break;
    }
    case "GetPendingContacts":
    {
        Wrapper::PendingContactsList($_REQUEST["index"], $_REQUEST["quantity"], $_REQUEST["keywords"]);
        break;
    }
    case "CountPendingContacts":
    {
        echo Database::CountPendingContacts($_REQUEST["keywords"]);
        break;
    }
    case "GetPendingMaterials":
    {
        Wrapper::PendingMaterialsList($_REQUEST["index"], $_REQUEST["quantity"], $_REQUEST["keywords"]);
        break;
    }
    case "CountPendingMaterials":
    {
        echo Database::CountPendingMaterials($_REQUEST["keywords"]);
        break;
    }
    case "VerifyContact":
    {
        $contact = Database::GetContact($_REQUEST["id"]);
        $answer = Database::VerifyContact($_REQUEST["id"]);
        if ($answer == 1)
        {
            echo Database::InsertNotification("Ваш контакт '$contact->name' успішно додано!", $_REQUEST["owner_id"], 3);
        }
        break;
    }
    case "VerifyMaterial":
    {
        $material = Database::GetMaterial($_REQUEST["id"]);
        $answer = Database::VerifyMaterial($_REQUEST["id"]);
        if ($answer == 1)
        {
            echo Database::InsertNotification("Ваш матеріал '$material->title' успішно додано!", $_REQUEST["owner_id"], 3);
        }
        break;
    }
    case "DeleteContact":
    {
        $contact = Database::GetContact($_REQUEST["id"]);
        $answer = Database::DeleteContact($_REQUEST["id"]);
        if ($answer == 1)
        {
            echo Database::InsertNotification("Ваш контакт '$contact->name' було відхилено адміністратором!", $_REQUEST["owner_id"], 3);
        }
        break;
    }
    case "DeleteMaterial":
    {
        $material = Database::GetMaterial($_REQUEST["id"]);
        $answer = Database::DeleteMaterial($_REQUEST["id"]);
        if ($answer == 1)
        {
            echo Database::InsertNotification("Ваш матеріал '$material->title' було відхилено адміністратором!", $_REQUEST["owner_id"], 3);
        }
        break;
    }
    case "DeleteNotification":
    {
        echo Database::DeleteNotification($_REQUEST["id"]);
        break;
    }
    case "UpdateContact":
    {
        $answer = Database::UpdateContact($_REQUEST["id"], $_REQUEST["name"], $_REQUEST["workplace"], $_REQUEST["position"], $_REQUEST["location"], $_REQUEST["phone"], $_REQUEST["email"], $_REQUEST["vk"], $_REQUEST["facebook"], $_REQUEST["twitter"], $_REQUEST["website"], $_REQUEST["scope"]);
        if ($answer)
        {
            $filename = "../images/contacts/contact_" . $_REQUEST["id"] . ".png";
            $file = fopen($filename, "w");
            $data = $_REQUEST["photo"];
            $uri = substr($data, strpos($data, ",") + 1);
            file_put_contents($filename, base64_decode($uri));

            echo $answer;
        }
        break;
    }
    case "GetContacts":
    {
        Wrapper::ContactsList($_REQUEST["group_id"], $_REQUEST["index"], $_REQUEST["quantity"], $_REQUEST["keywords"], $_REQUEST["scope"]);
        break;
    }
    case "CountContacts":
    {
        echo Database::CountContacts($_REQUEST["group_id"], $_REQUEST["keywords"], $_REQUEST["scope"]);
        break;
    }
    case "GetMaterials":
    {
        Wrapper::MaterialsList($_REQUEST["index"], $_REQUEST["quantity"], $_REQUEST["keywords"], $_REQUEST["scope"]);
        break;
    }
    case "CountMaterials":
    {
        echo Database::CountMaterials($_REQUEST["keywords"], $_REQUEST["scope"]);
        break;
    }
    case "Purchase":
    {
        $answer = Database::InsertPurchase($_REQUEST["buyer_id"], $_REQUEST["contact_id"], $_REQUEST["author_id"]);
        $contact = Database::GetContact($_REQUEST["contact_id"]);
        if ($answer)
        {
            $content = "Ваш контакт <b>'$contact->name'</b> був відкритий іншим користувачем.<br/>За це ви отримуете <b>1</b> бал.";
            Database::InsertNotification($content, $_REQUEST["author_id"], 1);

            $content = "Ви відкрили контакт <b>'$contact->name'</b>.<br/>З вас списано <b>10</b> балів.";
            Database::InsertNotification($content, $_REQUEST["buyer_id"], 2);
        }
        echo 1;
        break;
    }
    case "GetOwnedContacts":
    {
        Wrapper::OwnedContacts($_REQUEST["id"], $_REQUEST["index"], $_REQUEST["quantity"], $_REQUEST["keywords"]);
        break;
    }
    case "CountOwnedContacts":
    {
        echo Database::CountOwnedContacts($_REQUEST["id"], $_REQUEST["keywords"]);
        break;
    }
    case "Report":
    {
        echo Database::InsertReport($_REQUEST["sender_id"], $_REQUEST["contact_id"], $_REQUEST["content"]);
        break;
    }
    case "CountReports":
    {
        echo Database::CountReports($_REQUEST["keywords"]);
        break;
    }
    case "GetReports":
    {
        Wrapper::ReportsList($_REQUEST["index"], $_REQUEST["quantity"], $_REQUEST["keywords"]);
        break;
    }
    case "DismissReport":
    {
        $contact = Database::GetContact($_REQUEST["reported_id"]);
        $text = "Ваша скарга на контакт <b>'$contact->name'</b> була розглянута адміністратором.<br/> Адміністрація не знайшла достатньо підстав, для того, щоб заблокувати контакт.<br/> За систематичне подання скарг, що будуть вдхилятися ви можете бути позбавлені права користуватися сайтом.<br/><br/><i>Комментар адміністратора:</i><br/>";
        $content = $text . $_REQUEST["answer"];

        Database::DeleteReport($_REQUEST["report_id"]);
        echo Database::InsertNotification($content, $_REQUEST["contact_id"], 3);
        break;
    }
    case "BlockContact":
    {
        $contact = Database::GetContact($_REQUEST["reported_id"]);
        Database::DeleteContact($_REQUEST["reported_id"]);
        Database::DeleteReport($_REQUEST["report_id"]);

        $content = "Ваша скарга на контакт <b>'$contact->name'</b> була розглянута адміністратором.<br/> Адміністрація знайшла достатньо підстав, для того, щоб заблокувати контакт та видалити його.<br/><br/>Дякуємо за те, що допомагаете в покращенні нашої бази!";
        echo Database::InsertNotification($content, $_REQUEST["contact_id"], 3);
        break;
    }
    default:
    {
        echo "Function is not recognized!";
        exit;
    }
}