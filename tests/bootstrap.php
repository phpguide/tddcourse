<?php

/**
 * @var $autoloader Composer\Autoload\ClassLoader
 */
$autoloader = require __DIR__.'/../vendor/autoload.php';

$autoloader->addPsr4('', __DIR__.'/../src');