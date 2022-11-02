<?php
class Helper
{
    public static function convertToViewData(array $tweetsResponse): array
    {
  //dataからtext,id,author_idのデータを抜き出す関数を作成
       static function pickData(array $tweetsResponse):array
        {
            $result=[];//仮置き
            foreach($tweetsResponse['data']as $d)
            {
              $result=$d;
            }
            return $result;
        }
  //includesのusersからusernameとid,nameを抜き出す関数を作成
        static function pickUserData(array $tweetsResponse):array
        {
            $result = [];
            foreach($tweetsResponse['includes']['users']as $u){
              $result=$u;
            }
            return $result;
        }


        //抜き出したデータを最終的に一つにする
        $data=self::pickData($tweetsResponse);
        $userdata=self::pickUserData($tweetsResponse);

        $result[] = [
            'tweet_id' => $data['id'],
            'tweet_text' => $data['text'],
            'user_id' => $userdata['id'],
            'user_name' => $userdata['username'] ?? '',
            'user_display_name' => $userata['name'] ?? '',
        ];
        return $result;
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
