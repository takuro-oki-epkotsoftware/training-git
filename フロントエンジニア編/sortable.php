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
?>

<div id="drag-area">
    <?php
    $sql='SELECT * FROM sortable';//MySQLで使用するSQL文をあらかじめ格納しておく
    $stmt=$dbh->query($sql);//$dbh内にあるqueryメソッドのSQLステートメント'$SQL'を実行し、値を$stmtに渡す。
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    //データを配列にするための処理。fetchでループ処理を行っているらしいが
    //PDO::FETCH_ASSOC : カラム名で添ええ時をつけた配列を返すコマンド
    print_r($result);
    ?>
</div>