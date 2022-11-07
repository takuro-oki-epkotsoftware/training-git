<?PHP
$test='root';
$lang='あいう';
$num=12;

echo $test,'<br>';
echo $lang,'<br>';
echo $num,'<br>';

/*以下はHTMLで使用できる記述
<select>←このタグがあるとHTML判定になり
PHPファイルだと実行できない

<?php
for($i=1976; $i<=2020;$i++){
    echo "<option>" . $i . "年</option>";
}
</select>
*/

echo '1から100までの整数のうち、
5で割り切れる数の合計値を求める<br>';
$answer=0;
for($i=0;$i<=100;$i++){
    $j=$i%5;
    if($j===0){
        $answer+=$i;
    }
}
echo $answer,'<br>';

echo '1から50までの整数のうち、
5の倍数である数字を全て出力する<br>';

$i=1;
while($i<=50){
    if($i%5===0){
        echo $i,'<br>';
    }
    $i++;
}


//以下に用意したデータをテーブルで表記する。
$data=[
    ['1','大橋太郎','32歳','目黒区大橋1-2-5','公務員','キャンプ'],
    ['2','大橋次郎','28歳','目黒区池尻1-2-5','家事手伝い','映画鑑賞'],
    ['3','大橋三郎','25歳','渋谷区北沢2-3-6','デザイナー','ドライブ'],
];

echo '<table>';
    foreach($data as $d){
        echo '<tr>';
        echo '   <td>' . $d[0] . '</td>';
        echo '   <td>' . $d[1] . '</td>';
        echo '   <td>' . $d[2] . '</td>';
        echo '   <td>' . $d[3] . '</td>';
        echo '   <td>' . $d[4] . '</td>';
        echo '   <td>' . $d[5] . '</td>';
        echo '</tr>';
        
    }
    '</table>';
