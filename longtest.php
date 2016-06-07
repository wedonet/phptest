<?php
require_once(__DIR__ . '/../global.php');
require_once syspath . '_inc/cls_api.php';

class myapi extends cls_api {

    function __construct() {
        parent::__construct();


        switch ($this->act) {
            case '':
                $this->pagemain();
                break;
            case 'refresh':
                $this->pagerefresh();
                break;
        }
    }

    function pagemain() {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <title></title>
            </head>

            <body>
                <form method="post" action="?act=refresh">
                    <div>Mac地址：
                        <input type="text" name="mac" value="" />
                       </div>
                    <div>
                        开门号：
                        <input type="text" name="doors" value="" size="20" />
                       </div>
                    <div>
                        <input type="submit" value="submit"/>
                       </div>
                    
                </form>
            </body>
        </html>
        <?php
    }
    
    function pagerefresh(){
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta http-equiv="refresh" content="10">

                <title>开门</title>  
            </head>

            <body>
                <?php
                if (isset($_SESSION['longtest'])) {
                    $i = $_SESSION['longtest'] * 1 + 1;
                } else {
                    $i = 0;
                }

                $_SESSION['longtest'] = $i;


                echo $i;
                ?>
            </body>
        </html>
        <?php
    }

}

$myapi = new myapi();
unset($myapi);


