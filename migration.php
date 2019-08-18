<?php
require_once 'confing.php';
include 'Base/DBConnection.php';
require_once 'vendor/autoload.php';

use Base\DBConnection as DBConnection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

$DB = new DBConnection();
$DB->getDB();

Capsule::schema()->dropIfExists('category_products');
Capsule::schema()->dropIfExists('category');
Capsule::schema()->dropIfExists('products');


Capsule::schema()->create('category', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
    $table->timestamps();
});

Capsule::schema()->create('products', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
    $table->integer('price');
    $table->integer('count');
    $table->timestamps();
});
Capsule::schema()->create('category_products', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('category_id')->unsigned();
    $table->foreign('category_id')->references('id')->on('category');
    $table->integer('product_id')->unsigned();
    $table->foreign('product_id')->references('id')->on('products');
    $table->timestamps();
});

