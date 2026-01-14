#!/usr/bin/env python3
import sys
import json

try:
    # Leer nombre desde argumento
    nombre_buscar = sys.argv[1].lower()

    # Abrir archivo JSON
    with open("data/personas.json", "r", encoding="utf-8") as f:
        personas = json.load(f)

    # Buscar coincidencia
    for persona in personas:
        if persona["nombre"].lower() == nombre_buscar:
            print(json.dumps({
                "encontrado": True,
                "nombre": persona["nombre"],
                "edad": persona["edad"]
            }))
            sys.exit(0)

    # Si no se encontró
    print(json.dumps({
        "encontrado": False
    }))

except Exception as e:
    print(json.dumps({
        "error": str(e)
    }))