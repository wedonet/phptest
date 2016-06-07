<?php

/* 更新商家账户 */
require_once( __DIR__ . '/../global.php');
require_once syspath . '_inc/cls_api.php';

class myapi extends cls_api {

    function __construct() {
        parent::__construct();



        switch ($this->act) {
            case '':
                $this->pagemain(); //更新商家统计
                break;
        }
        echo 'ok';
    }

    function pagemain() {
        $sql = 'select * from `we_com` where 1 ';
        $sql .= ' and id not in(select comid from we_account) ';

        $a_bizer = $this->pdo->fetchAll($sql);

        foreach ($a_bizer as $v) {
            $sql = 'insert into `we_account` (uid,comid,unick,mytype) values (';
            $sql .= $v['uid'];
            $sql .= ',' . $v['id'];
            $sql .= ',"' . $v['u_nick'] . '"';
            $sql .= ',"biz"';



            $sql .= ')';

            $this->pdo->doSql($sql);
        }
    }

}

$myapi = new myapi();
unset($myapi);
