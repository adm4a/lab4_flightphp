<?php

require_once "BaseDao.class.php";

class UserDao extends BaseDao {
    public function __construct() {
        parent::__construct("Users"); 
    }
}
?>