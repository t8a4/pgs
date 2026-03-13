<?php

require_once "config/config.php";

$page = $_GET['page'] ?? 'home';

include "views/layout/header.php";

switch($page){

case 'news':
include "views/pages/news.php";
break;

case 'news_single':
include "views/pages/news_single.php";
break;

case 'events':
include "views/pages/events.php";
break;

case 'event_single':
include "views/pages/event_single.php";
break;

case 'gallery':
include "views/pages/gallery.php";
break;

case 'contact':
include "views/pages/contact.php";
break;

default:
include "views/pages/home.php";
break;

case 'page':
include "views/pages/page.php";
break;
}

include "views/layout/footer.php";