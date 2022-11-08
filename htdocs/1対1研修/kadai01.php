<?php
require_once("app/Helper.php");
use App\Helper;

echo "<h2>TRUEパターン</h2>";
var_dump(Helper::same(1, 1, 1)); // bool(true)
echo "<br>";
var_dump(Helper::same(2, 2, 2)); // bool(true)
echo "<h2>FALSEパターン</h2>";
var_dump(Helper::same(1, 1, 2)); // bool(false)
echo "<br>";
var_dump(Helper::same(1, 2, 1)); // bool(false)
echo "<br>";
var_dump(Helper::same(2, 1, 1)); // bool(false)
echo "<br>";
var_dump(Helper::same(2, 2, '2')); // bool(false)
echo "<br>";
var_dump(Helper::same(2, '2', 2)); // bool(false)
echo "<br>";
var_dump(Helper::same('2', 2, 2)); // bool(false)
echo "<br>";