window.onload = function() {
    // Caminho do arquivo TXT
    const filePath = './mlb1.txt'; // Certifique-se de que o arquivo está no mesmo diretório ou ajuste o caminho conforme necessário.

    // Usando fetch para ler o arquivo
    fetch(filePath)
        .then(response => {
            if (!response.ok) {
                throw new Error('Arquivo não encontrado ou erro ao carregar');
            }
            return response.text(); // Retorna o conteúdo do arquivo como texto
        })
        .then(data => {
            // Exibe o conteúdo do arquivo na div com id 'fileContent'
            document.getElementById('fileContent').innerText = data;
        })
        .catch(error => {
            // Caso haja erro, exibe uma mensagem de erro
            document.getElementById('fileContent').innerText = 'Erro ao ler o arquivo: ' + error.message;
        });
};
