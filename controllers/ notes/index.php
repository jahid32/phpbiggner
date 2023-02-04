<?php

$config = base_path('config.php');
$db = new Database($config['database']);

$notes = $db->query('select * from notes where user_id = 1')->get();

view('index.view.php', ['heading' => "My Notes", 'notes' => $notes]);