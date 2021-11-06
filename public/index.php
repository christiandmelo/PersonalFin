<?php

use App\Kernel;

//if ($_SERVER['APP_ENV'] == 'dev') {
    header('Access-Control-Allow-Origin:*');
//} else {
//    header('Access-Control-Allow-Origin:yourdomaind');
//}
header('Access-Control-Allow-Headers:*');
header('Access-Control-Allow-Credentials:true');
//header('Access-Control-Allow-Headers:X-Requested-With, Content-Type, withCredentials');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    die();
}

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
