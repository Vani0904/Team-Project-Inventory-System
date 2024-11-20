<?php
require "model.php";

$results = $_DB->select
(
  "SELECT * FROM `users` WHERE `first_name` LIKE ?",
  ["%{$_POST["search"]}%"]
);

echo json_encode(count($results)==0 ? null : $results);