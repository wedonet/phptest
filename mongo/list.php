<?php

require_once(__DIR__ . '/../../global.php');


$m = new MongoClient('127.0.0.1:27017');



// 选择一个数据库
$db = $m->testclient;

$collection = $db->mac;

$count = $collection->find()->count();


$mongopage = new cls_page();






$sql = [];


$mongoresult = mongofind($mongopage, $collection, $sql);

//$mresult = $collection->find($sql);

function mongofind($mongopage, $collection, $sql) {

    $total = $collection->find($sql)->count();

    $limit = $mongopage->pagesize;
    
    $skipnum = ($mongopage->currentpage-1) * $mongopage->pagesize;

    $mongoresult = $collection->find($sql)->limit($limit)->skip($skipnum);

    $a = [];

    $a['total'] = $total;
    $a['list'] = $mongoresult;

    return $a;
}

foreach ($mongoresult['list'] as $v) {
    echo 'ID:' . $v['_id'] . ' &nbsp; ';
    echo '<a href="' . $v['_id'] . '">' . $v['name'] . '</a>';
    echo '<br />';
}


echo $mongopage->pagelist($mongoresult['total']);

//$seq = $instance->db->command(array(
//    'findAndModify' => 'seq',
//    'query' => array('_id' => $namespace),
//    'update' => array('$inc' => array('id' => $option['step'])),
//    'new' => true,
//        ));

function nextid($db, $sequenceName) {
    $sequenceDocument = $db->counters->findAndModify(
            array('_id' => $sequenceName), array('$inc' => array('id' => 1)), array(), array('new' => true)
    );


    return $sequenceDocument['id'];
}

$m->close();

class cls_page {

    public $currentpage; //当前页
    public $counts; //记录数
    public $pagesize = 10;

    public function __construct() {
        $this->getcurrentpage();
    }

    function getcurrentpage($pagepara = 'page') {
        //取传过来的页数
        $currentpage = $this->rqid($pagepara);

        if ($currentpage < 1) {
            $currentpage = 1;
        }

        $this->currentpage = $currentpage;
    }

    function rqid($s = 'id', $v = -1) {
        if (isset($_GET[$s])) {
            $x = Trim($_GET[$s]);
        } else {
            $x = $v;
        }

        if (strlen($x) > 20) {
            err(1022);
        }
        if (!is_numeric($x)) {
            return $v;
        } else {
            return floor($x);
        }
    }

    function pagelist($total = 0, $filename = null) {

        $currentpage = $this->currentpage;


        if (0 == $total) {
            return false;
        }

        /* 取文件名 */
        if (null === $filename) {
            $a = explode('\\', __FILE__);
            $filename = end($a);
        }

        //这里没对$_GET[]进行检测
        //$_GET['page'] = '{$page}';
        $tget = $_GET;


        /* 如果有page这个参数 then 删之 */
        if (array_key_exists('page', $tget)) {
            unset($tget['page']);
        }




        $url = '?' . $this->arrtopara($tget);


        $maxpage = $this->pagesize;



        /* 计算总页数 */
        if (0 === $total % $maxpage) {
            //$pagecount 在repm时生成
            $pagecount = $total / $maxpage;
        } else {
            $pagecount = floor($total / $maxpage) + 1;
        }


        /* 校正currentpage */
        if ($currentpage > $pagecount) {
            $currentpage = $pagecount;
        }

        /* 求pagelong */
        if ($currentpage < 6) {
            $pagelong = 11 - $currentpage;
        } else if (($pagecount - $currentpage) < 6) {
            $pagelong = 10 - ($pagecount - $currentpage);
        } else {
            $pagelong = 5;
        }

        //生成page字符串
        /* 只有一页时,只显示页数 */
        if ($pagecount < 2) {
            $s = '<li class="current">&nbsp;1&nbsp;</li>' . PHP_EOL;
        } else {
            for ($i = 1; $i < ($pagecount + 1); $i++) {
                /* 第一页不带参数 */
                if (1 == $i) {
                    $a[0] = $url;

                    if (1 == $currentpage) {
                        $p[0] = '<li class="current">&nbsp;1&nbsp;</li>' . PHP_EOL;
                    } else {
                        $p[0] = '<li><a href="' . $a[0] . '">&nbsp;1&nbsp;</a></li>' . PHP_EOL;
                    }
                } else {
                    if (($i < ($currentpage + $pagelong) AND $i > ($currentpage - $pagelong)) OR $i == $pagecount) {
                        $a[$i - 1] = $url;

                        //检测有没有?
                        if (FALSE !== stripos($a[$i - 1], '?')) { //没有时用? 有时则用&amp;
                            $a[$i - 1] .= '?page={$page}';
                        } else {
                            $a[$i - 1] .= '&amp;page={$page}';
                        }

                        if ($currentpage == $i) {
                            $p[$i - 1] = '<li class="current">&nbsp;' . $i . '&nbsp;</li>' . PHP_EOL; //给当前页加标记
                        } else {
                            $p[$i - 1] = '<li><a href="' . $this->addpara($url, 'page=' . ($i)) . '">&nbsp;' . $i . '&nbsp;</a></li>' . PHP_EOL;
                        }
                    }
                }
            }

            $s = join('', $p);
        }


        $strpage = '<div class="page">' . PHP_EOL;
        $strpage .= '<ul>' . PHP_EOL;
        $strpage .= '{$pre}' . PHP_EOL;
        $strpage .= '{$pagelist}' . PHP_EOL;
        $strpage .= '{$next}' . PHP_EOL;
        $strpage .= '</ul>' . PHP_EOL;
        $strpage .= '<div class="clear"></div>' . PHP_EOL;
        $strpage .= '</div>' . PHP_EOL;

        $strpage = str_replace('{$pagelist}', $s, $strpage); //替换翻页字符串

        /* Get 上一页和下一页链 */
        /* 上一页 */
        if ($currentpage > 1) {
            if (2 == $currentpage) { //第二页的上一页, 也就是第一页,不带page参数
                $prepage = '<li><a href="' . $url . '" class="pageleft"><</a>&nbsp;</li>' . PHP_EOL;
            } else {
                $prepage = '<li><a href="' . $this->addpara($url, 'page=' . ($currentpage - 1)) . '" class="pageleft"><</a>&nbsp;</li>' . PHP_EOL;
            }
        } else {
            //当前页就是第一页, 上一页没有链接了
            $prepage = '<li class="pageleft"><</li>' . PHP_EOL;
        }
        $strpage = str_replace('{$pre}', $prepage, $strpage);


        /* 下一页 */
        if ($currentpage < $pagecount) {
            $nextpage = '<li>&nbsp;<a href="' . $this->addpara($url, 'page=' . ($currentpage + 1)) . '" class="pageright">></a></li>' . PHP_EOL;
        } else {
            $nextpage = '<li class="pageright">></li>' . PHP_EOL;
        }
        $strpage = str_replace('{$next}', $nextpage, $strpage);


        echo $strpage;
    }

    function arrtopara($para) {
        $s = '';

        if (!is_array($para)) {
            return '';
        }

        foreach ($para as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $vv) {
                    $s.= '&amp;' . $k . '[]=' . $vv;
                    //$t[$k][] = $vv;
                }
            } else {
                $s .= '&amp;' . $k . '=' . $v;
            }
        }

        //不要开头的&amp;
        $s = substr($s, 5);

        return $s;
    }

    /* 向url追加参数 */

    function addpara($str, $para) {
        /* 没问号 */
        if (FALSE === stripos($str, '?')) {
            return $str . '?' . $para;
        } else {
            return $str . '&amp;' . $para;
        }
    }

}
