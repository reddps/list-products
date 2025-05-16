<?php
// Salva conteúdo em arquivo txt
if (!isset($_GET['file']) || !isset($_POST['content'])) { echo 'ERRO'; exit; }
$file = basename($_GET['file']);
$path = __DIR__ . '/uploads/' . $file;
if (is_file($path) && strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'txt') {
    if (file_put_contents($path, $_POST['content']) !== false) {
        echo 'OK';
    } else {
        echo 'ERRO';
    }
} else {
    echo 'ERRO';
}
