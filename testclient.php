<?php 
require_once(__DIR__ . '/../global.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="refresh" content="10">
        
        <title></title>

        <script src="/_js/jquery-1.11.3.min.js?t=5"></script>    

        <script>
            $(document).ready(function () {
                $.get('http://s.com:1337/index.html/C89346C4E0E9/1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23', function(){
                    
                    
                    
                });
            })
        </script>

    </head>

    <body>
    <?php

    if(isset($_SESSION['aa'])){
        $i = $_SESSION['aa']*1+1;
    }else{
        $i = 0;
    }
    
    $_SESSION['aa'] = $i;
    

    echo $i;
    ?>
    </body>
</html>


