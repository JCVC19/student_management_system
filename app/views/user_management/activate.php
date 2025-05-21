<?php

require_once '../../../config/Database.php';
require_once '../../models/User.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

require '../../../permission.php';

$database = new Database();
$db = $database->getConnection();
User::setConnection($db);
$user = User::find($_GET['id']);
$user->status = 'active';
$user->save();

header('Location: edit.php?id='.$user->id);
?>