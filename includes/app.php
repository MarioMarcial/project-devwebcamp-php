<?php
use Dotenv\Dotenv;
use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';

// Add dotenv
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'functions.php';
require 'database.php';

// connect to database
ActiveRecord::setDB($db);
?>