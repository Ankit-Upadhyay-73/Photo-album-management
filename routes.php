
<?php

    // $router->get("","Controllers/HomeController.php");
    // $router->get("login","Controllers/AuthController.php");
    // $router->get("register","Controllers/RegisterController.php");
    // $router->get("album","Controllers/AlbumController.php");

    // $router->post("album","Controllers/AlbumController.php");

    $router->get("","HomeController@index");
    $router->get("login","AuthController@create");
    $router->post("login","AuthController@attempt");
    $router->get("register","RegisterController@create");
    $router->get("album","AlbumController@create");
    $router->post("register","RegisterController@register");

    $router->post("album","AlbumController@store");
    $router->get("albums","AlbumController@list");
    $router->get("album/show","AlbumController@show");
    $router->post("logout","AuthController@logout");        