<?php
require 'classConv.php';
$conv = new ParseM3u;
$result = $conv->getArray('URL-LIST'); //link conteudo
var_dump($conv->getCategory($result));