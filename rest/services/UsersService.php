<?php

    require 'BaseService.php';
    require_once __DIR__."/../dao/UsersDao.class.php";

    class UserService extends BaseService{
        public function __construct(){
            parent::__construct(new UserDao);
        }

       
    }
?>