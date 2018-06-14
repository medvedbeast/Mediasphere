<?php

$connection = mysqli_connect("127.0.0.1", "applingi_admin2", "QAZwsxedc123");
mysqli_select_db($connection, "applingi_mediasphere");
mysqli_set_charset($connection, "utf8");

/*
for ($i = 1; $i <= 20; $i++)
{
    $query = "INSERT INTO `CONTACTS` (`name`, `workplace`, `position`, `location`, `group_id`, `photo`, `phone`, `email`, `vk`, `facebook`, `twitter`, `website`, `verified`, `author_id`) VALUES ('Єхідний Колобок ($i)', '2ch.ru', 'Мєм', '2ch, 4ch', '3', 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', '1', '14');";
    $answer = mysqli_query($connection, $query);

    $id = mysqli_insert_id($connection);

    $spheres = rand(1, 3);
    for ($j = 0; $j < $spheres; $j++)
    {
        $s = rand(1, 64);
        $query = "insert into CONTACTS_SCOPE (contact_id, sphere_id) values ($id, $s)";
        $answer = mysqli_query($connection, $query);
    }
}
*/

for ($i = 1; $i <= 20; $i++)
{
    $sd = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    $d = "Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.";
    $query = "INSERT INTO MATERIALS (title, short_description, description, location, deadline, author_id, verified) VALUES ('Інтригуючий заголовок ($i)', '$sd', '$d', 'Миколаїв, Україна', '12.12.2017', 14, 1)";
    $answer = mysqli_query($connection, $query);

    $id = mysqli_insert_id($connection);

    $spheres = rand(1, 3);
    for ($j = 0; $j < $spheres; $j++)
    {
        $s = rand(1, 64);
        $query = "insert into MATERIALS_SCOPE (material_id, sphere_id) values ($id, $s)";
        $answer = mysqli_query($connection, $query);
    }
}
