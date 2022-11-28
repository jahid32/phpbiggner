<?php
$config = require('config.php');
$db = new Database($config);

$query = "SELECT * FROM notes where user_id = 1 ";
$notes = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

$heading = "Notes";
include 'views/notes.view.php';