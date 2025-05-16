<?php
$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir);
}
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileName = basename($_FILES['file']['name']);
    $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $fileName); // Limpa o nome
    $destPath = $uploadDir . $fileName;
    if (move_uploaded_file($fileTmp, $destPath)) {
        header('Location: index.php?upload=success');
        exit;
    } else {
        header('Location: index.php?upload=fail');
        exit;
    }
} else {
    header('Location: index.php?upload=fail');
    exit;
}
?>
