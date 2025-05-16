<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gerenciar Arquivos</title>
    <style>
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
            max-width: 700px;
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
        .file-table {
            width: 100%;
            border-collapse: collapse;
        }
        .file-table th, .file-table td {
            padding: 12px 8px;
            border-bottom: 1px solid #e0e0e0;
            text-align: left;
        }
        .file-table th {
            background: #f7fafd;
            font-weight: 700;
        }
        .file-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .file-thumb {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border-radius: 6px;
        }
        .icon-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }
        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
        }
        .action-btn:hover {
            background: #eaf4fc;
        }
        .svg-anim {
            transition: transform 0.2s, color 0.2s;
        }
        .action-btn:hover .svg-anim {
            transform: scale(1.2) rotate(-10deg);
            color: #e74c3c;
        }
        .action-btn:active .svg-anim {
            transform: scale(0.95) rotate(10deg);
            color: #c0392b;
        }
        .modal-bg {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.4);
            align-items: center;
            justify-content: center;
        }
        .modal-bg.active {
            display: flex;
        }
        .modal {
            background: #fff;
            border-radius: 10px;
            padding: 30px 24px 20px 24px;
            max-width: 90vw;
            max-height: 90vh;
            overflow: auto;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            position: relative;
        }
        .modal-close {
            position: absolute;
            top: 10px;
            right: 14px;
            background: none;
            border: none;
            font-size: 1.7rem;
            color: #888;
            cursor: pointer;
        }
        .modal-content {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 320px;
            min-height: 220px;
            max-width: 600px;
            max-height: 400px;
            width: 100%;
            height: 320px;
            overflow: auto;
        }
        .modal-content img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 2px 12px #0002;
        }
        .modal-content video,
        .modal-content iframe {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            display: block;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 2px 12px #0002;
        }
        .modal-content audio {
            width: 100%;
            margin-top: 20px;
        }
        .modal-content textarea {
            width: 100%;
            min-height: 180px;
            font-size: 1rem;
            border-radius: 6px;
            border: 1.5px solid #ccc;
            padding: 10px;
            resize: vertical;
        }
        .modal-actions {
            margin-top: 18px;
            text-align: right;
        }
        .save-btn {
            background: #27ae60;
            color: #fff;
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            margin-right: 10px;
            transition: background 0.2s;
        }
        .save-btn:hover {
            background: #219150;
        }
        .delete-btn {
            background: #e74c3c;
            color: #fff;
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .delete-btn:hover {
            background: #c0392b;
        }
        .audio-icon {
            color: #2980b9;
        }
        .txt-icon {
            color: #8e44ad;
        }
        .img-icon {
            color: #16a085;
        }
        .video-icon {
            color: #e67e22;
        }
        .file-row:hover {
            background: #f7fafd;
        }
        @media (max-width: 600px) {
            .sidebar { width: 48px; }
            .svg-anim { width: 22px; height: 22px; }
            .container { padding: 18px 4px; }
            .modal { padding: 12px 4px 10px 4px; }
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
        <h2>Gerenciar Arquivos</h2>
        <form id="multiDeleteForm" onsubmit="return deleteSelected(event)">
        <table class="file-table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll" onclick="toggleAll(this)"></th>
                    <th>Arquivo</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $dir = __DIR__ . '/uploads';
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            $files = array_diff(scandir($dir), array('.', '..'));
            if (count($files) === 0) {
                echo '<tr><td colspan="4" style="color:#777; font-style: italic; text-align:center;">Nenhum arquivo hospedado ainda.</td></tr>';
            } else {
                foreach ($files as $file) {
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $icon = '';
                    $tipo = '';
                    $preview = '';
                    if (in_array($ext, ['jpg','jpeg','png','gif','bmp','webp'])) {
                        $icon = '<span class="img-icon icon-overlay">'
                        .'<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="svg-anim" style="width:24px;height:24px;"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg></span>';
                        $tipo = 'Imagem';
                        $preview = '<img src="uploads/'.urlencode($file).'" class="file-thumb"/>';
                    } elseif (in_array($ext, ['mp4','webm','ogg','mov','avi','mkv'])) {
                        $icon = '<span class="video-icon icon-overlay">'
                        .'<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="svg-anim" style="width:24px;height:24px;"><path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z"/></svg></span>';
                        $tipo = 'Vídeo';
                        $preview = '<video src="uploads/'.urlencode($file).'" class="file-thumb" muted></video>';
                    } elseif (in_array($ext, ['mp3','wav','ogg','aac','flac','m4a'])) {
                        $icon = '<span class="audio-icon icon-overlay">'
                        .'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="svg-anim" style="width:24px;height:24px;"><path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 0 0 1.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06ZM18.584 5.106a.75.75 0 0 1 1.06 0c3.808 3.807 3.808 9.98 0 13.788a.75.75 0 0 1-1.06-1.06 8.25 8.25 0 0 0 0-11.668.75.75 0 0 1 0-1.06Z"/><path d="M15.932 7.757a.75.75 0 0 1 1.061 0 6 6 0 0 1 0 8.486.75.75 0 0 1-1.06-1.061 4.5 4.5 0 0 0 0-6.364.75.75 0 0 1 0-1.06Z"/></svg></span>';
                        $tipo = 'Áudio';
                        $preview = '<span style="display:inline-block;width:36px;height:36px;background:#eaf4fc;border-radius:6px;"></span>';
                    } elseif ($ext === 'txt') {
                        $icon = '<span class="txt-icon icon-overlay">'
                        .'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="svg-anim" style="width:22px;height:22px;"><path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 0 0 3 3.5v13A1.5 1.5 0 0 0 4.5 18h11a1.5 1.5 0 0 0 1.5-1.5V7.621a1.5 1.5 0 0 0-.44-1.06l-4.12-4.122A1.5 1.5 0 0 0 11.378 2H4.5Zm2.25 8.5a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Zm0 3a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z" clip-rule="evenodd"/></svg></span>';
                        $tipo = 'Texto';
                        $preview = '<span style="display:inline-block;width:36px;height:36px;background:#f7fafd;border-radius:6px;"></span>';
                    } else {
                        $icon = '<span class="icon-overlay"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="svg-anim" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 2A1.5 1.5 0 0 0 3 3.5v13A1.5 1.5 0 0 0 4.5 18h11a1.5 1.5 0 0 0 1.5-1.5V7.621a1.5 1.5 0 0 0-.44-1.06l-4.12-4.122A1.5 1.5 0 0 0 11.378 2H4.5Z"/></svg></span>';
                        $tipo = strtoupper($ext);
                        $preview = '<span style="display:inline-block;width:36px;height:36px;background:#f7fafd;border-radius:6px;"></span>';
                    }
                    echo '<tr class="file-row">';
                    echo '<td><input type="checkbox" name="files[]" value="'.htmlspecialchars($file, ENT_QUOTES).'" class="file-checkbox"></td>';
                    echo '<td><div class="file-icon" onclick="openModal(\'' . htmlspecialchars($file, ENT_QUOTES) . '\', \'$ext\')">'.$preview.$icon.'</div> '.htmlspecialchars($file).'</td>';
                    echo '<td>'.$tipo.'</td>';
                    echo '<td>';
                    echo '<button class="action-btn" type="button" title="Visualizar" onclick="openModal(\'' . htmlspecialchars($file, ENT_QUOTES) . '\', \'$ext\');event.stopPropagation();">'
                    .'<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="svg-anim" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-7.5 9.75-7.5S21.75 12 21.75 12s-3.75 7.5-9.75 7.5S2.25 12 2.25 12Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg></button>';
                    echo '<button class="action-btn" type="button" title="Deletar" onclick="deleteFile(\'' . htmlspecialchars($file, ENT_QUOTES) . '\');event.stopPropagation();">'
                    .'<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="svg-anim" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg></button>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
            </tbody>
        </table>
        <div style="margin-top:18px;text-align:right;">
            <button type="submit" class="delete-btn" style="font-size:1rem;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="svg-anim" style="width:20px;height:20px;vertical-align:middle;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                </svg>
                Deletar Selecionados
            </button>
        </div>
        </form>
    </div>
    <div class="modal-bg" id="modalBg">
        <div class="modal" id="modal">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <div class="modal-content" id="modalContent"></div>
            <div class="modal-actions" id="modalActions"></div>
        </div>
    </div>
    <script>
    function openModal(file, ext) {
        const modalBg = document.getElementById('modalBg');
        const modalContent = document.getElementById('modalContent');
        const modalActions = document.getElementById('modalActions');
        modalContent.innerHTML = '';
        modalActions.innerHTML = '';
        if (["jpg","jpeg","png","gif","bmp","webp"].includes(ext)) {
            modalContent.innerHTML = `<img src="uploads/${encodeURIComponent(file)}" style="width:85%;height:auto;display:block;margin:auto;" />`;
        } else if (["mp4","webm","ogg","mov","avi","mkv"].includes(ext)) {
            modalContent.innerHTML = `<video src="uploads/${encodeURIComponent(file)}" style="width:85%;height:auto;display:block;margin:auto;object-fit:contain;" controls></video>`;
            modalActions.innerHTML = `<button class='save-btn' type='button' onclick='copyLink("uploads/${encodeURIComponent(file)}")'>Copiar link do vídeo</button>`;
        } else if (["mp3","wav","ogg","aac","flac","m4a"].includes(ext)) {
            modalContent.innerHTML = `<audio src="uploads/${encodeURIComponent(file)}" controls></audio>`;
            modalActions.innerHTML = `<button class='save-btn' type='button' onclick='copyLink("uploads/${encodeURIComponent(file)}")'>Copiar link do áudio</button>`;
        } else if (ext === "txt") {
            fetch(`uploads/${encodeURIComponent(file)}`)
                .then(r => r.text())
                .then(txt => {
                    modalContent.innerHTML = `<textarea id='txtEdit' spellcheck='false'>${txt.replace(/</g,'&lt;')}</textarea>`;
                    modalActions.innerHTML = `<button class='save-btn' onclick='saveTxt("${file}")'>
                    <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='svg-anim' style='width:20px;height:20px;vertical-align:middle;'><path stroke-linecap='round' stroke-linejoin='round' d='M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184'/></svg> Salvar</button>`;
                });
        } else {
            // Exibe link direto para download/abertura do arquivo
            modalContent.innerHTML = `<a href="uploads/${encodeURIComponent(file)}" target="_blank" style="display:inline-block;font-size:1.1rem;word-break:break-all;max-width:100%;text-align:center;">Abrir ou baixar arquivo: <br><b>${file}</b></a>`;
            modalActions.innerHTML = `<button class='save-btn' type='button' onclick='copyLink("uploads/${encodeURIComponent(file)}")'>Copiar link</button>`;
        }
        if (ext !== "txt") {
            modalActions.innerHTML += `<button class='delete-btn' type='button' onclick='deleteFile("${file}",true)'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='svg-anim' style='width:20px;height:20px;vertical-align:middle;'><path stroke-linecap='round' stroke-linejoin='round' d='M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z'/></svg> Deletar</button>`;
        }
        modalBg.classList.add('active');
    }
    function closeModal() {
        document.getElementById('modalBg').classList.remove('active');
    }
    function deleteFile(file, reloadModal) {
        if (confirm('Tem certeza que deseja apagar este arquivo?')) {
            fetch('delete.php?file='+encodeURIComponent(file), {method:'POST'})
            .then(r=>r.text())
            .then(resp=>{
                if (resp==='OK') {
                    if (reloadModal) closeModal();
                    setTimeout(()=>location.reload(), 300);
                } else {
                    alert('Erro ao deletar arquivo!');
                }
            });
        }
    }
    function saveTxt(file) {
        const txt = document.getElementById('txtEdit').value;
        fetch('save_txt.php?file='+encodeURIComponent(file), {
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'content='+encodeURIComponent(txt)
        })
        .then(r=>r.text())
        .then(resp=>{
            if (resp==='OK') {
                closeModal();
                setTimeout(()=>location.reload(), 300);
            } else {
                alert('Erro ao salvar arquivo!');
            }
        });
    }
    function toggleAll(source) {
        const checkboxes = document.querySelectorAll('.file-checkbox');
        checkboxes.forEach(cb => cb.checked = source.checked);
    }
    function deleteSelected(e) {
        e.preventDefault();
        const checked = Array.from(document.querySelectorAll('.file-checkbox:checked')).map(cb => cb.value);
        if (checked.length === 0) {
            alert('Selecione ao menos um arquivo para deletar!');
            return false;
        }
        if (!confirm('Tem certeza que deseja apagar os arquivos selecionados?')) return false;
        fetch('delete_multi.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: checked.map(f => 'files[]='+encodeURIComponent(f)).join('&')
        })
        .then(r=>r.text())
        .then(resp=>{
            if (parseInt(resp) > 0) {
                setTimeout(()=>location.reload(), 300);
            } else {
                alert('Erro ao deletar arquivos!');
            }
        });
        return false;
    }
    // Função para copiar link para a área de transferência
    function copyLink(link) {
        const url = 'https://hospedagem.trindadecorp.com.br/' + link.replace(/^\/+/, '');
        navigator.clipboard.writeText(url).then(() => {
            alert('Link copiado!');
        }, () => {
            alert('Não foi possível copiar o link.');
        });
    }
    </script>
</body>
</html>
