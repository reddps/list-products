<?php
$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir);
}

// Limite de tamanho por arquivo (20MB)
$maxSize = 20 * 1024 * 1024;
$allowed = [
    'jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', // imagens
    'pdf',
    'txt',
    'mp3',
    'mp4'
];

function response($msg, $ok = false, $fail = 0) {
    echo '<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta http-equiv="refresh" content="2;url=envio.php"><title>Resultado do Upload</title><style>body{font-family:sans-serif;background:#f0f2f5;display:flex;align-items:center;justify-content:center;height:100vh;}div{background:#fff;padding:32px 28px;border-radius:10px;box-shadow:0 8px 20px #0001;text-align:center;}span{font-weight:600;}</style></head><body><div>';
    echo $msg;
    if ($ok) echo '<br><span style="color:#219150;">Redirecionando...</span>';
    else echo '<br><span style="color:#c0392b;">Redirecionando...</span>';
    echo '</div></body></html>';
    flush();
    exit;
}

if (isset($_FILES['file'])) {
    $files = $_FILES['file'];
    $success = 0;
    $fail = 0;
    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] === UPLOAD_ERR_OK) {
            $fileTmp = $files['tmp_name'][$i];
            $fileName = basename($files['name'][$i]);
            $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $fileName);
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (!in_array($ext, $allowed)) {
                $fail++;
                flush();
                continue;
            }
            if (filesize($fileTmp) > $maxSize) {
                $fail++;
                flush();
                continue;
            }
            $destPath = $uploadDir . $fileName;
            if (move_uploaded_file($fileTmp, $destPath)) {
                $success++;
            } else {
                $fail++;
            }
            flush();
        } else {
            $fail++;
            flush();
        }
    }
    if ($success > 0) {
        response("<span style='color:#219150;'>$success arquivo(s) enviado(s) com sucesso.</span>" . ($fail > 0 ? "<br><span style='color:#c0392b;'>$fail falha(s).</span>" : ''), true, $fail);
    } else {
        response("<span style='color:#c0392b;'>Nenhum arquivo enviado. $fail falha(s).</span>", false, $fail);
    }
} else {
    response("<span style='color:#c0392b;'>Nenhum arquivo enviado.</span>", false, 0);
}
?>
