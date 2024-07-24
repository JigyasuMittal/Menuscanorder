<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('menu/Yourmenu', 'YourMenuController::index');
$routes->post('menu/add-item', 'YourMenuController::addItem');
$routes->post('menu/delete-item', 'YourMenuController::deleteItem');
$routes->get('menu/get-item-details', 'YourMenuController::getItemDetails');
$routes->post('menu/modify-item', 'YourMenuController::modifyItem');

$routes->get('table', 'TableController::index');
$routes->post('add-table', 'TableController::addTable');


$routes->get('signup', 'RestaurantOwnerController::signup');
$routes->post('restaurant-owner/store', 'RestaurantOwnerController::store');


$routes->get('login', 'LoginController::index'); 
$routes->post('login/authenticate', 'LoginController::authenticate'); 


$routes->get('payment', 'SubscriptionController::index');

$routes->get('/loginn', 'Auth::google_login');  
$routes->get('/login/callback', 'Auth::google_callback');  
$routes->get('/logout', 'Auth::logout');



$routes->get('/menudisplay', 'MenuDisplayController::displayMenu');


$routes->post('order/place-order', 'OrderController::placeOrder');
$routes->get('order/get-order-status', 'OrderController::getOrderStatus');



$routes->get('/kitchen/orders', 'KitchenController::index');
$routes->post('/kitchen/update-status', 'KitchenController::updateStatus');
$routes->post('/kitchen/bump-table', 'KitchenController::bumpTable');


$routes->get('/Logout', 'LoginController::logout');

