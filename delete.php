<?php
// Deleta arquivo do diretório uploads
if (!isset($_GET['file'])) { echo 'ERRO'; exit; }
$file = basename($_GET['file']);
$path = __DIR__ . '/uploads/' . $file;
if (is_file($path)) {
    if (unlink($path)) {
        echo 'OK';
    } else {
        echo 'ERRO';
    }
} else {
    echo 'ERRO';
}
