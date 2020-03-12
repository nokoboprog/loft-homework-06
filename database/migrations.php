<?php

require '../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

try {
    $capsule = new Capsule;

    $capsule->addConnection([
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'hw6',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    //Таблица категорий.
    Capsule::schema()->dropIfExists('categories');
    Capsule::schema()->create('categories', function ($table) {
        $table->increments('id');
        $table->string('vendor_code')->unique();
        $table->string('name');
        $table->text('description');
        $table->string('image');
        $table->tinyInteger('status')->default(0);
        $table->timestamps();
    });

    //Таблица товаров.
    Capsule::schema()->dropIfExists('products');
    Capsule::schema()->create('products', function ($table) {
        $table->increments('id');
        $table->integer('categories_id')->unsigned();
        $table->string('vendor_code')->unique();
        $table->string('name');
        $table->text('description');
        $table->float('price');
        $table->string('image');
        $table->tinyInteger('status')->default(0);
        $table->timestamps();
    });
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

echo 'Таблицы успешно созданы!';
