<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Console\Grades;
use Dotenv\Dotenv;

$dotenv = Dotenv::create(__DIR__ . '/../');
$dotenv->load();

echo Grades::list();

var_dump(Grades::createJSON([['grade_id' => '1112', 'name' => 'Test']]));
var_dump(Grades::updateJSON('1112', 'Test 2'));