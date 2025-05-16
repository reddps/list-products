<?php
if ($_SERVER['HTTP_HOST'] !== 'hospedagem.trindadecorp.com.br') {
    header('Location: http://hospedagem.trindadecorp.com.br' . $_SERVER['REQUEST_URI']);
    exit;
}
header('Location: envio.php');
exit;
