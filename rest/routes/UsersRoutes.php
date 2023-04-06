<?php

    Flight::route('GET /api/users', function(){
        Flight::json(Flight::studentService()->getUsers());
    });
    
    
    Flight::route('GET /api/users/@id', function($id){
        Flight::json(Flight::studentService()->getUserById($id));
    });
    
    
    Flight::route('POST /api/users', function(){
        $data = Flight::request()->data->getData();
        Flight::json(Flight::studentService()->addUser($data));
    });
    
    
    Flight::route('PUT /api/users/@id', function($id){
        $data = Flight::request()->data->getData();
        Flight::studentService()->updateUser($id, $data);
        Flight::json(Flight::studentService()->getUserById($id));
    });
    
    
    Flight::route('DELETE /api/users/@id', function($id){
        Flight::studentService()->deleteUser($id);
    });
    
    
    
    Flight::start();
    
?>