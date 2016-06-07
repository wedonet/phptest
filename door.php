<?php
require_once(__DIR__ . '/../global.php');
require_once syspath . '_inc/cls_api.php';
require_once syspath . '_inc/cls_door.php';


class myapi extends cls_api {

    function __construct() {
        parent::__construct();

        switch ($this->act) {
            case'':
                $this->pagemain(); //主内容区
                break;
        }
    }

    function pagemain() {
        $c_door = new cls_door();
        
        $c_door->opendoor('C89346C4CFDC', array(10,11,12,13,14,15,16,17,18,19,20,21,22,23));
    }

}


$myapi = new myapi();
unset($myapi);


