<?php
$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir);
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
            $destPath = $uploadDir . $fileName;
            if (move_uploaded_file($fileTmp, $destPath)) {
                $success++;
            } else {
                $fail++;
            }
        } else {
            $fail++;
        }
    }
    if ($success > 0) {
        header('Location: index.php?upload=success&count=' . $success);
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
