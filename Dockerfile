# Usa uma imagem base oficial do Python
FROM python:3.11-slim

# Define o diretório de trabalho dentro do container
WORKDIR /app

# Copia os arquivos do projeto para o container
COPY . .

# Instala as dependências
RUN pip install --no-cache-dir -r requirements.txt

# Expõe a porta padrão (ajuste conforme seu app usa)
EXPOSE 8000

# Comando para rodar sua aplicação
CMD ["python", "index.py"]
