<?php

namespace App;
//配列をTSV(string型)に変換する
class AlbumHelper
{
    public static function albumsToTsvString($albums): string
    {
        //配列$albumsからデータを取り出してstring型にする
        //サンプルデータの$albumsは多重配列
        $recorddata = "id\tname\tnote\ttrack_names\r\n"; //文字列型で定義
        foreach ($albums as $a) {
            $first = true;
            $recorddata .= "{$a['id']}\t{$a['name']}\t{$a['note']}";
            foreach ($a['tracks'] as $t) {

                if ($first) {
                    $recorddata .= "\t" . $t["name"];
                    $first = false;
                } else {
                    $recorddata .= "," . $t["name"];
                }
            }
            $recorddata .= "\r\n";
        }

        return $recorddata;
    }
    public static function a2(array $albums): string
    {
        $result = "id\tname\tnote\ttrack_names\r\n";
        foreach ($albums as $album) {
            $trackNames = [];
            foreach ($album['tracks'] as $track) {
                $trackNames[] = $track['name'];
            }
            // $trackNames = array_column($album['tracks'], 'name');
            $fields = [
                $album['id'],
                $album['name'],
                $album['note'],
                implode(',', $trackNames),
            ];
            $result .= implode("\t", $fields) . "\r\n";
        }
        return $result;
    }
}
