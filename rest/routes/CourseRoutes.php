<?php
    Flight::route('GET /api/users', function(){
        Flight::json(Flight::courseDao()->getUsers());
    });
    
    
    Flight::route('GET /api/users/@id', function($id){
        Flight::json(Flight::courseDao()->getUserById($id));
    });
    
    
    Flight::route('POST /api/users', function(){
        $data = Flight::request()->data->getData();
        Flight::json(Flight::courseDao()->addUser($data));
    });
    
    
    Flight::route('PUT /api/users/@id', function($id){
        $data = Flight::request()->data->getData();
        Flight::courseDao()->updateUser($id, $data);
        Flight::json(Flight::courseDao()->getUserById($id));
    });
    
    
    Flight::route('DELETE /api/users/@id', function($id){
        Flight::courseDao()->deleteUser($id);
    });
    
    
    
    Flight::start();
?>