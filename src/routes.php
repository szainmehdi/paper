<?php

$router->register('/', 'HomeController@home');
$router->register('/about', function() {
   return 'About Us!';
});
$router->register('/about/even/more/pages/', function() {
   return 'Even More Pages';
});