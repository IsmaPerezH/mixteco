import json
import os

archivo_palabras = r"c:\xampp\htdocs\mixteco\recursos\palabras.txt"
output_jsonl = r"c:\xampp\htdocs\mixteco\recursos\mixteco_dataset.jsonl"

def procesar_palabras():
    pares = []
    esp = None
    mix = None

    with open(archivo_palabras, 'r', encoding='utf-8') as f:
        for line in f:
            line = line.strip()
            if not line:
                continue
            if line.upper().startswith("ESPAÑOL:"):
                esp = line.split(":", 1)[1].strip()
            elif line.upper().startswith("MIXTECO:"):
                mix = line.split(":", 1)[1].strip()

            if esp is not None and mix is not None:
                pares.append({"espanol": esp, "mixteco": mix})
                esp = None
                mix = None

    print(f"Total pares encontrados en palabras.txt: {len(pares)}")

    prompts = []
    for par in pares:
        prompts.append({
            "instruction": "Traduce la siguiente oración al Mixteco de San Miguel El Grande (Tu'un Savi).",
            "input": par["espanol"],
            "output": par["mixteco"]
        })
        prompts.append({
            "instruction": "Traduce la siguiente oración del Mixteco de San Miguel El Grande (Tu'un Savi) al Español.",
            "input": par["mixteco"],
            "output": par["espanol"]
        })
        prompts.append({
            "instruction": "Eres un experto en la lengua Tu'un Savi de San Miguel El Grande, Oaxaca. Responde la pregunta.",
            "input": f"¿Cómo se dice en Mixteco: '{par['espanol']}'?",
            "output": par["mixteco"]
        })

    with open(output_jsonl, 'w', encoding='utf-8') as out:
        for p in prompts:
            out.write(json.dumps(p, ensure_ascii=False) + '\n')

    print(f"Total prompts guardados en mixteco_dataset.jsonl: {len(prompts)}")

if __name__ == "__main__":
    procesar_palabras()
