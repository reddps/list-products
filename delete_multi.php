<?php
// Deleta múltiplos arquivos do diretório uploads
if (!isset($_POST['files']) || !is_array($_POST['files'])) { echo 'ERRO'; exit; }
$ok = 0;
foreach ($_POST['files'] as $file) {
    $file = basename($file);
    $path = __DIR__ . '/uploads/' . $file;
    if (is_file($path)) {
        if (unlink($path)) $ok++;
    }
}
echo $ok;
