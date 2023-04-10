<?php
require '../vendor/autoload.php';
require 'dao/UsersDao.class.php';
require 'dao/CourseDao.class.php';

require 'services/UsersService.php';
require 'services/CourseService.php';



Flight::register('usersService', 'UsersService');
Flight::register('courseService', 'CourseService');


require_once 'routes/UsersRoutes.php';
require_once 'routes/CourseRoutes.php';


?>

