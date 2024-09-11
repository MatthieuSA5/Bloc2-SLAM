<?php

use Acme\CompteBancaire;
use Pecee\SimpleRouter\SimpleRouter;

require "./../vendor/autoload.php";

$loader = new \Twig\Loader\FilesystemLoader('./../src/templates');
$twig = new \Twig\Environment($loader, []);

require "./../src/config/router.php";


SimpleRouter::start();
