<!--PHPの構文を書くには<?PHP~?>で囲む -->
<?php
$stmt = 'こんにちは';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="main">
            <!--HTMLの中にも記号を入れるとPHP文を書くことができる-->
        <?php
        echo $stmt.'<br>';
        echo 'Hello World';
        ?>
        </div>
    </body>
</html>