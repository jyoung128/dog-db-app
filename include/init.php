<?php
require_once __DIR__ . '/../vendor/autoload.php';

//If I was some nerd who didn't use composer 

//require_once "classes/BaseViewModel.php";
//require_once "classes/HomeViewModel.php";
//require_once "classes/FormViewModel.php";


use DogsApp\HomeViewModel;
use DogsApp\FormViewModel;
use DogsApp\DeleteViewModel;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$file = $_SERVER['PHP_SELF'];

preg_match('/\/([-a-z]+)\.php$/', $file, $matches);

if (count($matches) !== 2) {
	http_response_code(404);
	echo "Not Found";
	exit();
}

$route = $matches[1];

switch ($route) {
    case 'index':
        $model = new HomeViewModel();
        break;
    
    case 'dog-form':
        $model = new FormViewModel();
        break;
    
    case 'delete-dog':
        $model = new DeleteViewModel();
        break;

    default:
        $model = null;
        break;
}