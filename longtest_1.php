<?php
require_once(__DIR__ . '/../global.php');
require_once syspath . '_inc/cls_api.php';
require_once syspath . '_inc/cls_door.php';

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
                <form action="?" method="get">
                    <div><input type="hidden" name="act" id="act" value="refresh" /></div>
        <!--                       <div><input type="hidden" name="doorid" id="act" value=1 /></div>-->
                    <div>Mac地址
                        <input type="text" name="mac" value="C89346C3711C" />
                    </div>
                    <div>
                        打开最大门号
                        <input type="text" name="doors" value="16" size="90" />
                    </div>
                    <div>
                        <input type="submit" value="submit"/>
                    </div>

                </form>
            </body>
        </html>
        <?php
    }

    function pagerefresh() {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta http-equiv="refresh" content="6">

                <title>开门</title>  
            </head>

            <body>
                <?php
//echo pr();
                //$doorid=  $this->main->rqid('doorid');
                
                $this->main->posttype='get';
                $mac = $this->main->request('mac', 'mac地址', 12, 12, 'char', '');
                $doortitle = $this->main->request('doors', 'doors门', 1, 2, 'char', '');

                if (!$this->ckerr()) {
                    print_r($this->j['errmsg']);
                    return false;
                }
                // set_time_limit(60);
                // $doortitle = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16);
//                if (true == strpos($doortitle, ',')) {
//                    $door = explode(',', $doortitle);
//                    $len = count($door);
//                    for ($i = 0; $i < $len; $i++) {
//
//                        $rs['deviceic'] = $mac;
//                        $rs['doortitle'] = array($door[$i]);
//                        $c_door = new cls_door($rs, '1');
//                        sleep(5);
//                    }
//                } else {
                $j = 0;
                
                if (isset($_SESSION[CacheName . 'countses'])) {
                    $j = $_SESSION[CacheName . 'countses'] * 1 ;
                    
                    $j++;
                    //echo ','.$j,',';
                    
                    
                    if ($j > ($doortitle * 1)) {
                        $j = 1;
                    }
                    
                    $_SESSION[CacheName . 'countses'] = $j;
                    
                    
                } else {
                    $_SESSION[CacheName . 'countses'] = 1;
                    $j = 1;
                    
                   
                }
                
                echo '开门'.$j;
                echo '<br />';
                
                $rs['deviceic'] = $mac;
                $rs['doortitle'] = array($j);
                $c_door = new cls_door($rs);
//                }


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


