"""
FASE 3: Servidor de traducción (Flask)
=======================================
Corre el modelo entrenado localmente y expone un endpoint HTTP
que tu página PHP puede llamar para traducir textos al Mixteco.

INSTALACIÓN:
    pip install flask transformers peft torch

USO:
    python fase3_servidor_traductor.py

DESDE PHP (historias, diccionario, etc.):
    $response = file_get_contents('http://localhost:5000/traducir?texto=Buenos días');
"""

from flask import Flask, request, jsonify
from transformers import AutoModelForCausalLM, AutoTokenizer
from peft import PeftModel
import torch
import os

app = Flask(__name__)

# =============================================
# CONFIGURACIÓN — Cambia estas rutas si es necesario
# =============================================
BASE_MODEL     = "unsloth/Llama-3.2-3B-Instruct"
LORA_ADAPTER   = r"c:\xampp\htdocs\mixteco\recursos\mixteco_lora_model"
DEVICE         = "cuda" if torch.cuda.is_available() else "cpu"
DTYPE          = torch.float16 if torch.cuda.is_available() else torch.float32

ALPACA_PROMPT = """A continuación hay una instrucción que describe una tarea de traducción.
Escribe una respuesta que complete correctamente la solicitud.

### Instrucción:
{}

### Entrada:
{}

### Respuesta:
"""

print(f"[Servidor] Cargando modelo en {DEVICE} ({DTYPE})...")
tokenizer = AutoTokenizer.from_pretrained(BASE_MODEL)
base_model = AutoModelForCausalLM.from_pretrained(BASE_MODEL, torch_dtype=DTYPE)

if os.path.exists(LORA_ADAPTER):
    model = PeftModel.from_pretrained(base_model, LORA_ADAPTER)
    print("[Servidor] ✅ Adaptadores LoRA cargados — usando modelo entrenado en Mixteco.")
else:
    model = base_model
    print("[Servidor] ⚠️  Adaptadores LoRA no encontrados — usando modelo base sin entrenar.")

model.to(DEVICE)
model.eval()
print("[Servidor] ✅ Modelo listo.")

# =============================================
# ENDPOINTS
# =============================================

@app.route('/', methods=['GET'])
def inicio():
    """Página de inicio del servidor de traducción."""
    return jsonify({
        'mensaje': 'Servidor Traductor Mixteco-Español Activo',
        'endpoints': {
            'traducir_get': '/traducir?texto=Buenos días',
            'traducir_post': '/traducir (JSON: {"texto": "...", "direction": "es_mx"})',
            'salud': '/salud'
        }
    })

@app.route('/traducir', methods=['GET', 'POST'])
def traducir():
    """
    Traduce texto Español → Mixteco.
    GET:  /traducir?texto=Buenos días
    POST: JSON { "texto": "Buenos días", "direction": "es_mx" }
    """
    if request.method == 'POST':
        datos = request.get_json(silent=True) or {}
        texto = datos.get('texto', '')
        direction = datos.get('direction', 'es_mx')  # es_mx = Español→Mixteco, mx_es = Mixteco→Español
    else:
        texto = request.args.get('texto', '')
        direction = request.args.get('direction', 'es_mx')

    if not texto.strip():
        return jsonify({'error': 'El campo texto está vacío.'}), 400

    if direction == 'mx_es':
        instruccion = "Traduce la siguiente oración del Mixteco de San Miguel El Grande (Tu'un Savi) al Español."
    else:
        instruccion = "Traduce la siguiente oración al Mixteco de San Miguel El Grande (Tu'un Savi)."

    prompt = ALPACA_PROMPT.format(instruccion, texto)
    inputs = tokenizer(prompt, return_tensors='pt').to(DEVICE)

    with torch.no_grad():
        outputs = model.generate(
            **inputs,
            max_new_tokens=200,
            do_sample=False,
            temperature=1.0,
            pad_token_id=tokenizer.eos_token_id
        )

    resultado_completo = tokenizer.decode(outputs[0], skip_special_tokens=True)
    traduccion = resultado_completo.split('### Respuesta:')[-1].strip()

    return jsonify({
        'original': texto,
        'traduccion': traduccion,
        'direction': direction
    })

@app.route('/salud', methods=['GET'])
def salud():
    """Verificar que el servidor está activo."""
    return jsonify({'estado': 'activo', 'dispositivo': DEVICE})

if __name__ == '__main__':
    print("[Servidor] 🚀 Iniciando en http://localhost:5000")
    app.run(host='0.0.0.0', port=5000, debug=False)
