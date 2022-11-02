<?php

class Helper
{
    public static function convertToViewData(array $tweetsResponse): array
    {
        // $idUserMap  Key: user_id, Value: user情報
        $idUserMap = self::makeIdUserMap($tweetsResponse);
        //後述するメソッド用に定義する。処理的にはこのメソッドの実行が先。
        //makeIdUserMapで得られた値が代入されている
        $result = [];//戻り値用の配列とりあえず中身は空
        foreach ($tweetsResponse['data'] ?? [] as $tweet) {
            /*$tweetsResponseの['data'](なければ空の配列[])にアクセスする
            そしてその都度取り出した値を$tweetに代入する。

            多分 $tweet=['id','text','author_id',] だけ。
            user_nameとnameはここでは入っていない*/

            $userId = $tweet['author_id'] ?? '';
            //変数$userIdに配列$tweetの['author_id']を代入。なければ空白。
            $user = $idUserMap[$userId] ?? [];
            //8行目で続行されたメソッドの戻り値を持つ配列$iduserMapを
            $result[] = [
                'tweet_id' => $tweet['id'],
                'tweet_text' => $tweet['text'],
                'user_id' => $userId,
                'user_name' => $user['username'] ?? '',
                'user_display_name' => $user['name'] ?? '',
            ];/*$resultにdataを代入。ここではまだuser_nameとnameはないので
            nullでもいいように ?? ''としておく。(値がなければ空白になる)
            一応、メソッドmakeIdUserMapが実行されていれば値が入る。 */
        }
        return $result;
    }

    private static function makeIdUserMap(array $tweetsResponse): array
    /*静的メソッドとしてmakeIdUserMapを定義、引数には$tweetsResponseを使用
    なおこの関数は8行目に記載があるようにconvertToViewDataの序盤で使用される*/
    {
        $result = [];//代入先の配列を用意。中身はまだない
        foreach ($tweetsResponse['includes']['users'] ?? [] as $u) {
            /*$tweetの配列内にある'includes'キー(これも配列)に対応する値の中にある
            'users'キーに対応する値を取り出す。そして繰り返し代入先を$uと定義する。
            値が存在しなければ??[]によって空白が入る。知らんけど*/
            $result[$u['id']] = $u;
            /*$result配列に$u['id']を定義し多次元配列にする。
            そして、定義した$u['id']内に$tweetの方の$uの値を代入する
            ちなみにこの時点での$u及び$resultは
            ['id','username','name']が入っている*/
                }
        return $result;//値$resultをこのメソッドの戻り値として残しておく。
    }
}
// テスト実行関数
function executeTest(int $caseNumber, $case, $expected)
{
    echo "<hr><h2>テストケース{$caseNumber}</h2>";

    $spanOk = '<span style="background-color: #198754;color: #fff">OK</span>';
    $spanNg = '<span style="background-color: #dc3545;color: #fff">NG</span>';
    try {
        $actual = Helper::convertToViewData($case);
    } catch (\Throwable $th) {
        echo $spanNg, '<pre>';
        echo $th->getMessage() . "\n\n";
        echo $th->getTraceAsString();
        echo '</pre>';
        return;
    }
    if ($expected === $actual) {
        // 一致
        echo $spanOk;
    } else {
        echo $spanNg;
        echo '<div style="display: flex;">';
        echo '<div><h3>期待結果</h3>';
        echo '<pre>', var_export($expected), '</pre>';
        echo '</div>';
        echo '<div><h3>実行結果</h3>';
        echo '<pre>', var_export($actual), '</pre>';
        echo '</div>';
        echo '</div>';
    }
}

// テスト実行
$i = 0;
//   テストケース1
$case1 = [
    'data' => [
        [
            'text' => 'ツイート001',
            'id' => '1001',
        ],
    ],
];
//   期待結果
$expected1 = [
    [
        'tweet_id' => '1001',
        'tweet_text' => 'ツイート001',
        'user_id' => '',
        'user_name' => '',
        'user_display_name' => '',
    ],
];
executeTest(++$i, $case1, $expected1);

//   テストケース2
$case2 = [];
//   期待結果
$expected2 = [];
executeTest(++$i, $case2, $expected2);

//   テストケース3
$case3 = [
    'data' => [
        [
            'text' => 'ツイート001',
            'id' => '1001',
            'author_id' => '102',
        ],
        [
            'text' => 'ツイート002',
            'id' => '1002',
            'author_id' => '101',
        ],
        [
            'text' => 'ツイート003',
            'id' => '1003',
            'author_id' => '102',
        ],
    ],
    'includes' => [
        'users' => [
            [
                'username' => 'user_01',
                'id' => '101',
                'name' => 'ユーザー01',
            ],
            [
                'username' => 'user_02',
                'id' => '102',
                'name' => 'ユーザー02',
            ],
        ],
    ],
];
//   期待結果
$expected3 = [
    [
        'tweet_id' => '1001',
        'tweet_text' => 'ツイート001',
        'user_id' => '102',
        'user_name' => 'user_02',
        'user_display_name' => 'ユーザー02',
    ],
    [
        'tweet_id' => '1002',
        'tweet_text' => 'ツイート002',
        'user_id' => '101',
        'user_name' => 'user_01',
        'user_display_name' => 'ユーザー01',
    ],
    [
        'tweet_id' => '1003',
        'tweet_text' => 'ツイート003',
        'user_id' => '102',
        'user_name' => 'user_02',
        'user_display_name' => 'ユーザー02',
    ],
];
executeTest(++$i, $case3, $expected3);

?>
