<?php
require_once("app/AlbumHelper.php");

// 多次元配列
$albums = [
    [
        "id" => 1,
        "name" => "ALBUM01",
        "note" => "NOTE01",
        "tracks" => [
            ["id" => 101, "name" => "TRACK0101"],
            ["id" => 102, "name" => "TRACK0102"],
            ["id" => 103, "name" => "TRACK0103"],
        ],
    ],
    [
        "id" => 2,
        "name" => "ALBUM02",
        "note" => "NOTE02",
        "tracks" => [
            ["id" => 201, "name" => "TRACK0201"],
        ],
    ],
    [
        "id" => 3,
        "note" => "NOTE03",
        "name" => "ALBUM03",
        "tracks" => [
            ["id" => 301, "name" => "TRACK0301"],
            ["name" => "TRACK0302", "id" => 302],
            ["id" => 303, "name" => "TRACK0303"],
        ],
    ],
];
// 実行・レスポンス出力
$result = \App\AlbumHelper::albumsToTsvString($albums);
if (!is_string($result) || empty($result)) {
    echo 'エラー: 戻り値が不正です。';
    exit(1);
}
echo $result;
