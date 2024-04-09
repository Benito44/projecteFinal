<?php
$file = 'document.txt';
$content = $_POST['content'];
file_put_contents($file, $content);

file_put_contents('canvis.txt', $content);
?>
