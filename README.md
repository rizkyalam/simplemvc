# Simple MVC

## About
Since 2019, I started learning the php programming language and have worked on many projects using the php framework. [Laravel](https://laravel.com/) is one of my favorite php frameworks. I made this simple framework inspired by the [laravel framework](https://laravel.com/).

> Version 1.0.0

> Requirenment PHP >= 5.6

You can see the application with the url below.

[https://alam-simplemvc.000webhostapp.com/](https://alam-simplemvc.000webhostapp.com/)

## Table of Contents
* [Setup](#setup)
* [Route](#route)
* [Model](#model)
* [View](#view)
* [Controller](#controller)

## Setup
First you need to clone this package.

`git clone https://github.com/rizkyalam/simplemvc.git`

Or you can download this package from github.

Then you must setup database and base url in file `.env`

## Route
You can add static and dynamic routing using `$router->get()` in file `app/configs/routes.php`.
`$router->get()` have two parameters first for url and second for the controller with two indexes, 
first index for class controller name and second index for method controller.

For example you can see the code below.

```php
// static route
$router->get('/static', [HomeController::class, 'index']);

// dynamic route using curly brackets
$router->get('/foo/{bar}', [HomeController::class, 'foo']);
```

## Model
First you need add namespace `App\Models` for your Model and then you must inheritance class from `Core\Model`.

### Model Propeties
`$table` is for access database table.

`$primary_key` is for point to primary key of row table with the default is `id`.

`$fillable` list of table rows to be insert or update

### Model Method
`create()` is for insert a new data to database and have one parameters for data which to insert.

`all()` is for read all data from database.

`get()` is for read specified data from database and have two parameters. First parameters is for select rows data which to show, second parameters is for add a basic where clause to the query.

`update()` is for update the data from database and have two parameters. First parameters is for data which to be updated, second parameters is for specified primary key.

`delete()` is for delete the data to database and have one parameters for specified primary key.

## View
First you need to make a HTML document with extension `.php`.

If you want to access the data from controller you only have to access with the variable name from key of array data.

For example you can see the code below.

```php
// controller
$data['foo'] = 'bar';
$this->view('home', $data);

// view
<h1>$foo</h1>
```

## Controller
First you need add namespace `App\Controllers` for your controller and then you must inheritance class from `Core\Controller`.

Then you need to display with view you can add with `$this->view('home', $data)`.

If you want to access a model you can add with `ModelFactory::table('name')->all()`.

`ModelFactory` have a static method that is `table()` with one parameters of database table name and must be chaining with method of model like `get()`, `create()`, `all()`, `update()` and `delete()`.
