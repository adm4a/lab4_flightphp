<?php

require_once("rest/dao/UsersDao.class.php");
$dao = new UserDao();

$type = $_REQUEST['type'];

switch ($type) {
    case 'add':

        $firstName = $_REQUEST['firstName'];
        $lastName = $_REQUEST['lastName'];
        $age = $_REQUEST['age'];
        $dao->add($firstName, $lastName, $age);
        break;

    case 'delete':

        $id = $_REQUEST['id'];
        $dao->delete($id);
        break;

    case 'update':

        $id = $_REQUEST['id'];
        $firstName = $_REQUEST['firstName'];
        $lastName = $_REQUEST['lastName'];
        $age = $_REQUEST['age'];
        $dao->update($id, $firstName, $lastName, $age);
        break;

    case 'get':

        default:                       // If we don't provide any parameter in URL 'get' will execute
        $results = $dao->get_all();
        print_r($results);
        break;

    case 'getid':
        $id = $_REQUEST['id'];
        $results = $dao->get_by_id($id);
        print_r($results);
        break;
}

?>