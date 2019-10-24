<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Console\Grades;
use Dotenv\Dotenv;

$dotenv = Dotenv::create(__DIR__ . '/../');
$dotenv->load();

echo Grades::list();

var_dump(Grades::create([['grade_id' => '1111', 'name' => 'Test']]));