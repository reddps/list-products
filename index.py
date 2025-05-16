"""
requirements.txt
----------------
Flask==2.3.3
Flask-Cors==4.0.0
python-dotenv==1.0.1
"""

from flask import Flask, jsonify
from flask_cors import CORS
from dotenv import load_dotenv

app = Flask(__name__)
CORS(app)
load_dotenv()

@app.route('/')
def home():
    return jsonify({"mensagem": "API funcionando corretamente!"})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8000)

