import requests
import json
import os

# Internal Docker network URL
API_URL = "http://api:8000/api/v1"

routines = [
    {
        "nombre": "Mañana Maestra",
        "descripcion": "Comienza tu día con intención y claridad usando esta secuencia respaldada científicamente para optimizar tus niveles de cortisol.",
        "icono": "wb_sunny",
        "color": "indigo",
        "es_publica": True,
        "tareas": [
            {"titulo": "Hidratación", "descripcion": "Beber 500ml de agua con limón", "xp_recompensa": 10},
            {"titulo": "Estiramiento", "descripcion": "Movilidad ligera para despertar el cuerpo", "xp_recompensa": 15},
            {"titulo": "Meditación", "descripcion": "Enfoque en la respiración y presencia", "xp_recompensa": 20},
            {"titulo": "Diario de gratitud", "descripcion": "Escribir 3 cosas por las que estás agradecido", "xp_recompensa": 10},
            {"titulo": "Planificación", "descripcion": "Revisar agenda y prioridades del día", "xp_recompensa": 10}
        ]
    },
    {
        "nombre": "Prep. Trabajo Profundo",
        "descripcion": "Elimina distracciones y prepara tu cerebro para una sesión de enfoque intenso y productividad máxima.",
        "icono": "psychology",
        "color": "blue",
        "es_publica": True,
        "tareas": [
            {"titulo": "Limpiar escritorio", "descripcion": "Espacio limpio, mente limpia", "xp_recompensa": 10},
            {"titulo": "Bloquear notificaciones", "descripcion": "Activar modo No Molestar en todos los dispositivos", "xp_recompensa": 5},
            {"titulo": "Timer de 90m", "descripcion": "Establecer bloque de enfoque ininterrumpido", "xp_recompensa": 30}
        ]
    },
    {
        "nombre": "Cierre del Día",
        "descripcion": "Desconéctate del trabajo y prepárate para un sueño reparador para recargar energías.",
        "icono": "nights_stay",
        "color": "purple",
        "es_publica": True,
        "tareas": [
            {"titulo": "Revisar tareas completadas", "descripcion": "Celebrar los logros del día", "xp_recompensa": 10},
            {"titulo": "Reflexiones del diario", "descripcion": "¿Qué salió bien hoy? ¿Qué puedo mejorar?", "xp_recompensa": 15},
            {"titulo": "Preparar lista de mañana", "descripcion": "Vaciar la mente de pendientes", "xp_recompensa": 10}
        ]
    },
    {
        "nombre": "Reinicio Rápido",
        "descripcion": "Impulso rápido de energía para combatir el bajón de media tarde sin cafeína.",
        "icono": "battery_charging_full",
        "color": "teal",
        "es_publica": True,
        "tareas": [
            {"titulo": "Beber Agua", "descripcion": "Hidratación profunda", "xp_recompensa": 5},
            {"titulo": "Respiración cuadrada", "descripcion": "4s inhalar, 4s retener, 4s exhalar, 4s retener", "xp_recompensa": 10},
            {"titulo": "Caminar / Estirar", "descripcion": "Movimiento ligero por 5 minutos", "xp_recompensa": 15}
        ]
    },
    {
        "nombre": "Sesión de Estudio",
        "descripcion": "Optimiza tu aprendizaje utilizando técnicas de repetición espaciada y enfoque activo.",
        "icono": "auto_stories",
        "color": "amber",
        "es_publica": True,
        "tareas": [
            {"titulo": "Técnica Pomodoro", "descripcion": "25m estudio, 5m descanso", "xp_recompensa": 20},
            {"titulo": "Resumen de temas", "descripcion": "Escribir puntos clave con tus propias palabras", "xp_recompensa": 25},
            {"titulo": "Autoevaluación", "descripcion": "Hacerse preguntas sobre lo estudiado", "xp_recompensa": 30}
        ]
    },
    {
        "nombre": "Entrenamiento Express",
        "descripcion": "Mantente en forma con una rutina de alta intensidad que puedes hacer en cualquier lugar.",
        "icono": "fitness_center",
        "color": "emerald",
        "es_publica": True,
        "tareas": [
            {"titulo": "Calentamiento", "descripcion": "3m saltos, rotaciones articulares", "xp_recompensa": 10},
            {"titulo": "Circuito funcional", "descripcion": "Sentadillas, flexiones, burpees x3", "xp_recompensa": 40},
            {"titulo": "Vuelta a la calma", "descripcion": "Estiramiento estático", "xp_recompensa": 10}
        ]
    },
    {
        "nombre": "Limpieza de Domingo",
        "descripcion": "Organiza tu entorno para una semana sin fricciones.",
        "icono": "cleaning_services",
        "color": "rose",
        "es_publica": True,
        "tareas": [
            {"titulo": "Lavandería", "descripcion": "Ropa lista para la semana", "xp_recompensa": 20},
            {"titulo": "Limpiar cocina", "descripcion": "Superficies y platos impecables", "xp_recompensa": 30},
            {"titulo": "Organizar workspace", "descripcion": "Archivar papeles y despejar mesa", "xp_recompensa": 20}
        ]
    }
]

def seed():
    print(f"Iniciando seed de rutinas públicas conectando a {API_URL}...")
    for r in routines:
        # Create Routine
        r_tasks = r.pop("tareas")
        try:
            res = requests.post(f"{API_URL}/rutinas/", json=r)
            if res.status_code == 201:
                rutina_db = res.json()
                r_id = rutina_db["id"]
                print(f"Rutina '{r['nombre']}' creada (ID: {r_id})")
                
                # Create associated tasks
                for t in r_tasks:
                    t["rutina_id"] = r_id
                    t["usuario_id"] = None
                    t_res = requests.post(f"{API_URL}/tareas/", json=t)
                    if t_res.status_code == 201:
                        print(f"  - Tarea '{t['titulo']}' añadida")
                    else:
                        print(f"  - Error añadiendo tarea '{t['titulo']}': {t_res.text}")
            else:
                print(f"Error creando rutina '{r['nombre']}': {res.text}")
        except Exception as e:
            print(f"Error conectando al API: {e}")

if __name__ == "__main__":
    seed()
