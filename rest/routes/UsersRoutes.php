<?php

    Flight::route('GET /api/users', function(){
        Flight::json(Flight::usersService()->getUsers());
    });
    
    
    Flight::route('GET /api/users/@id', function($id){
        Flight::json(Flight::usersService()->getUserById($id));
    });
    
    
    Flight::route('POST /api/users', function(){
        $data = Flight::request()->data->getData();
        Flight::json(Flight::usersService()->addUser($data));
    });
    
    
    Flight::route('PUT /api/users/@id', function($id){
        $data = Flight::request()->data->getData();
        Flight::usersService()->updateUser($id, $data);
        Flight::json(Flight::usersService()->getUserById($id));
    });
    
    
    Flight::route('DELETE /api/users/@id', function($id){
        Flight::usersService()->deleteUser($id);
    });
    
    
    
    Flight::start();
    
?>