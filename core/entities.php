<?php

class Contact
{
    var $id;
    var $name;
    var $workplace;
    var $position;
    var $location;
    var $group_id;
    var $points;
    var $photo;
    var $phone;
    var $email;
    var $password;
    var $vk;
    var $facebook;
    var $twitter;
    var $website;
    var $verified;
    var $author_id;
    var $registered;
    var $views;

    public function __construct($row)
    {
        $this->id = $row[0];
        $this->name = $row[1];
        $this->workplace = $row[2];
        $this->position = $row[3];
        $this->location = $row[4];
        $this->group_id = $row[5];
        $this->points = $row[6];
        $this->photo = $row[7];
        $this->phone = $row[8];
        $this->email = $row[9];
        $this->password = $row[10];
        $this->vk = $row[11];
        $this->facebook = $row[12];
        $this->twitter = $row[13];
        $this->website = $row[14];
        $this->verified = $row[15];
        $this->author_id = $row[16];
        $this->registered = $row[17];
        $this->views = $row[18];
    }
}

class Sphere
{
    var $id;
    var $name;

    public function __construct($row)
    {
        $this->id = $row[0];
        $this->name = $row[1];
    }
}

class Material
{
    var $id;
    var $title;
    var $short_description;
    var $description;
    var $location;
    var $deadline;
    var $author_id;
    var $verified;
    var $registered;
    var $views;

    public function __construct($row)
    {
        $this->id = $row[0];
        $this->title = $row[1];
        $this->short_description = $row[2];
        $this->description = $row[3];
        $this->location = $row[4];
        $this->deadline = $row[5];
        $this->author_id = $row[6];
        $this->verified = $row[7];
        $this->registered = $row[8];
        $this->views = $row[9];
    }


}

class Agent
{
    var $id;
    var $name;
    var $workplace;
    var $position;
    var $phone;
    var $email;
    var $contact_id;

    public function __construct($row)
    {
        $this->id = $row[0];
        $this->name = $row[1];
        $this->workplace = $row[2];
        $this->position = $row[3];
        $this->phone = $row[4];
        $this->email = $row[5];
        $this->contact_id = $row[6];
    }


}

class Notification
{
    var $id;
    var $content;
    var $contact_id;
    var $type_id;
    var $occurred;

    public function __construct($row)
    {
        $this->id = $row[0];
        $this->content = $row[1];
        $this->contact_id = $row[2];
        $this->type_id = $row[3];
        $this->occurred = $row[4];
    }


}

class Report
{
    var $id;
    var $sender_id;
    var $contact_id;
    var $content;
    var $sent;

    public function __construct($row)
    {
        $this->id = $row[0];
        $this->sender_id = $row[1];
        $this->contact_id = $row[2];
        $this->content = $row[3];
        $this->sent = $row[4];
    }


}