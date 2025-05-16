<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hospedagem de Arquivos</title>
    <style>
        /* Reset básico */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: row;
            min-height: 100vh;
            color: #333;
        }

        .sidebar {
            width: 70px;
            background: #f7fafd;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 18px 0;
            box-shadow: 2px 0 12px #0001;
            gap: 18px;
            z-index: 10;
        }

        .sidebar-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-btn:hover {
            background: #eaf4fc;
        }

        .svg-anim {
            width: 32px;
            height: 32px;
            transition: transform 0.2s, color 0.2s;
            color: #2980b9;
        }

        .sidebar-btn:hover .svg-anim {
            transform: scale(1.2) rotate(-10deg);
            color: #e74c3c;
        }

        .sidebar-btn:active .svg-anim {
            transform: scale(0.95) rotate(10deg);
            color: #c0392b;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 0;
        }

        .container {
            background: #fff;
            max-width: 600px;
            width: 100%;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgb(0 0 0 / 0.1);
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: 600;
            font-size: 1rem;
            color: #555;
        }

        input[type="file"] {
            padding: 8px;
            border: 1.8px solid #ccc;
            border-radius: 6px;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        input[type="file"]:focus,
        input[type="file"]:hover {
            border-color: #3498db;
            outline: none;
        }

        input[type="submit"] {
            background-color: #3498db;
            border: none;
            color: white;
            padding: 12px 0;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            user-select: none;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        @media (max-width: 600px) {
            .sidebar { width: 48px; }
            .svg-anim { width: 22px; height: 22px; }
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px 25px;
            }

            input[type="submit"] {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <button class="sidebar-btn" onclick="location.href='envio.php'" title="Enviar Arquivos">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="svg-anim"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
        </button>
        <button class="sidebar-btn" onclick="location.href='gerenciar.php'" title="Gerenciar Arquivos">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="svg-anim"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" /></svg>
        </button>
    </div>
    <div class="main-content">
        <div class="container">
            <h2>Hospedagem de Arquivos</h2>
            <?php if (isset($_GET['upload']) && $_GET['upload'] === 'success' && isset($_FILES['file']['name'])): ?>
                <?php
                $fileName = basename($_FILES['file']['name']);
                $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $fileName);
                $fileUrl = 'uploads/' . $fileName;
                ?>
                <div id="uploadSuccessMsg" style="background:#eaf4fc;padding:16px 12px;border-radius:8px;margin-bottom:18px;text-align:center;">
                    <span style="color:#219150;font-weight:600;">Arquivo enviado com sucesso!</span><br>
                    <a href="<?php echo $fileUrl; ?>" target="_blank" style="word-break:break-all;display:block;margin:8px 0 10px 0;"><b><?php echo $fileName; ?></b></a>
                    <button onclick="copyLinkUpload('<?php echo $fileUrl; ?>')" style="background:#27ae60;color:#fff;border:none;padding:7px 18px;border-radius:6px;font-weight:600;cursor:pointer;">Copiar link</button>
                </div>
            <?php endif; ?>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label for="file">Selecione um arquivo para enviar:</label>
                <input type="file" name="file" id="file" required />
                <input type="submit" value="Enviar" />
            </form>
        </div>
    </div>
    <script>
    function copyLinkUpload(link) {
        const url = location.origin + '/' + link.replace(/^\/+/, '');
        navigator.clipboard.writeText(url).then(() => {
            alert('Link copiado!');
        }, () => {
            alert('Não foi possível copiar o link.');
        });
    }
    </script>
</body>
</html>
