<?php
$config = require('config.php');
$db = new Database($config);

$query = "SELECT * FROM notes where user_id = 1 and id=:id";
$note = $db->query($query, ['id' => $_GET['id']])->fetch(PDO::FETCH_ASSOC);

$heading = "Note";
include 'views/note.view.php';