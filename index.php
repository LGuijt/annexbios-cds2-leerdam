<?php
include_once './core/db_connect.php';

$view = '';

if (!empty($_GET['view'])) {
    $view = htmlspecialchars($_GET['view']);
    $view = str_replace("/", "", $view);
}

$page = '';
$style = '';
$js = '';

switch ($view) {
    case '':
        $page = 'home.php';
        $style = 'home.css';
        $js = 'home.js';
        break;
    case 'agenda':
        $page = 'agenda.php';
        $style = 'agenda.css';
        $js = 'agenda.js';
        break;
    case 'bestel':
        $page = 'bestel.php';
        $style = 'bestel.css';
        $js = 'bestel.js';
        break;
    case 'film':
        $page = 'film.php';
        $style = 'film.css';
        $js = 'film.js';
        break;
    case 'login':
        $page = 'login.php';
        $style = 'login.css';
        $js = 'login.js';
        break;
    case 'admin':
        $page = 'admin.php';
        $style = 'admin.css';
        $js = 'admin.js';
        break;
    default:
        $page = '404.php';
        $style = '404.css';
        $js = '404.js';
        break;
}

require_once "./views/" . $page;
