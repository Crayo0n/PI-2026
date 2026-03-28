from app.db.database import sesionLocal
from app.models.usuario import Usuario

def seed_ranking_users():
    db = sesionLocal()
    try:
        users_data = [
            {"nombre": "Maria Focus", "correo": "maria@example.com", "xp": 12000, "racha": 15},
            {"nombre": "Ana Pulse", "correo": "ana@example.com", "xp": 8500, "racha": 10},
            {"nombre": "Carlos Dev", "correo": "carlos@example.com", "xp": 5000, "racha": 7},
            {"nombre": "Luis Growth", "correo": "luis@example.com", "xp": 3200, "racha": 4},
            {"nombre": "Zack Peak", "correo": "zack@example.com", "xp": 1500, "racha": 2},
        ]

        for u in users_data:
            existing = db.query(Usuario).filter(Usuario.correo == u["correo"]).first()
            if not existing:
                new_user = Usuario(
                    nombre_usuario=u["nombre"],
                    correo=u["correo"],
                    password_hash="testpassword" + "notreallyhashed",
                    rol="user",
                    xp_total=u["xp"],
                    racha_actual=u["racha"]
                )
                db.add(new_user)
                print(f"Added test user: {u['nombre']}")
        
        db.commit()
        print("Ranking seeding completed.")
            
    except Exception as e:
        print(f"Error seeding ranking users: {e}")
        db.rollback()
    finally:
        db.close()

if __name__ == "__main__":
    seed_ranking_users()
