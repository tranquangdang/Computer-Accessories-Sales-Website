<?php 
include 'lib/Session.php';
include 'lib/Cookie.php';
Session::init();
include 'lib/Database.php';
include 'helpers/Format.php';

spl_autoload_register(function ($class) {
    include_once "classes/".$class.".php";
});
$database = new Database();
$format = new Format();
$product = new Product();
$cart = new Cart();
$customer = new Customer(); 
$Page = new Page();
?>