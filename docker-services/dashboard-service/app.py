from flask import Flask, render_template, jsonify
from flask_cors import CORS
import requests
import json

app = Flask(__name__)
CORS(app)

TELEMETRY_SERVICE_URL = "http://telemetry-service:3001"

@app.route('/')
def dashboard():
    return render_template('dashboard.html')

@app.route('/api/dashboard/data')
def get_dashboard_data():
    try:
        response = requests.get(f"{TELEMETRY_SERVICE_URL}/api/telemetry/current")
        if response.status_code == 200:
            return response.json()
        else:
            return {"error": "Service télémétrie indisponible"}, 503
    except requests.exceptions.RequestException:
        return {"error": "Connexion au service télémétrie échouée"}, 503

@app.route('/health')
def health():
    return {"status": "OK", "service": "dashboard"}

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=3002, debug=True)
