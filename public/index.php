<?php

// Importa la clase Mode del espacio de nombres Adso\libs y la usa para establecer el modo a "development".
use Adso\libs\Core;

require __DIR__ .'/../app/libs/Mode.php';
require __DIR__ .'/../app/config/config.php';
require __DIR__ .'/../app/libs/Helper.php';
require __DIR__ . '/../app/libs/DateHelper.php';
require_once __DIR__.'/../vendor/autoload.php';

new Mode('development');
$init = new Core;