<?php 
namespace DB;
require_once "../vendor/autoload.php";
use Utils\Seeders\UserSeeder;

UserSeeder::seed(10); //to add 20 user in the data bases;

//UserSeeder::clear(); to remove every user form the database;

// UserSeeder::clear();
