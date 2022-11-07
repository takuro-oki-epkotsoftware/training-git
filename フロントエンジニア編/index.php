<?php

//データベース設定
define('DB_DNS', 'mysql:host=localhost;dbname=cri?sortabel; charset=utf8');
define('DB_USER', 'root');
define('DB_PASSWORD','root');

//データベース接続PDO(PHP　データ　オブジェクト)
try{
    $dbh=new PDO(DB_DNS, DB_USER, DB_PASSWORD);//ログイン情報
    /*アロー演算子->により呼び出したい処理を行う。
    setAttribute()により属性をセット、
    ()の中をエラーモード、EXCEPRIONを入力として処理を返します。*/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //こちらは受領データの型を指定しておくことで変なデータが入らないようにする処理
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(PDOException $e){//データベースへのログインに失敗したときの処理。変なデータを検知したとき。
    echo $e->getMessage();//普通のエラーメッセージを返します。
    exit;
}
if(!empty($_POST['inputName'])){//$_POST['inputName']が!empty,空でなければ実行
    try{
        //sortableの['Name']カラムに指定したデータ型で挿入させる(型は後ほど宣言)
        $sql = 'INSERT INTO sortable(name) VALUES(:ONAME)';
        //値がデータベースに格納できるように置き換える。
        $stmt=$db->prepare($sql);

        //データをSQLで使用されているプレースホルダにバインドさせる
        $stmt->bindValue('ONAME', $_POST['inutName'] ,PDO::PARAM_STR);
        //bindValue('SQL文で使用されているプレースホルダ名' , データ※PDO::PARAM_STRは対象が文字列データであるという指示 , 型指定)

        $stmt->excecute();//処理が一通り終われば変数を参照しデータベースへ登録を実行する
        header('location: http//localhost:8001/');
        exit();
    }catch(PDOException $e){
        echo'データベースにアクセスできません！'.$e->getMessage();
    }
}





?>

<!DOCTYPE html>
<html lsng="ja">
    <head>
        <meta charset="UTF-8">
        <title>sortable</title>
        <link href="css/style.css" rel=styleseet>
    </head>
    <body>
        <div id="wrapper">
    
            <div id="input_form">
                <form action="index.php" method="POST">
                    <input type="text" name="inputName">
                    <input tyow="submit" valu="登録">
                </form>
            </div>
            <div id="drag-area">
                <?php
                $sql='SELECT * FROM sortable';//MySQLで使用するSQL文をあらかじめ格納しておく
                $stmt=$dbh->query($sql);//$dbh内にあるqueryメソッドのSQLステートメント'$SQL'を実行し、値を$stmtに渡す。
                $result=$stmt->fetch(PDO::FETCH_ASSOC);
                //データを配列にするための処理。fetchでループ処理を行っているらしいが
                //PDO::FETCH_ASSOC : カラム名で添ええ時をつけた配列を返すコマンド
                
                foreach($stmt as $result){
                    echo ' <div class="data-num="'.$result['id'].'" style="left:'.$result['left_x'].'px; top:'.$result['top_y'].'px;">'.PHP_EOL;
                    echo '  <p><span class="name">'.$result['id'].''.$result['name'].'</span></p>'.PHP_EOL; //PHP_EOLは改行コマンド
                    echo ' </div>'.PHP_EOL;

                }
                ?>
            </div>
        </div>

        </div>

    </body>
</html>