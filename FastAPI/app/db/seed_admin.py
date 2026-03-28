from app.db.database import sesionLocal
from app.models.usuario import Usuario

def seed_admin_user():
    db = sesionLocal()
    try:
        # Check if the admin user already exists by email
        admin_email = "admin@prioritypulse.com"
        user = db.query(Usuario).filter(Usuario.correo == admin_email).first()
        
        if not user:
            # Create new admin user
            raw_password = "Admin2026!"
            hashed_password = raw_password + "notreallyhashed"
            
            new_admin = Usuario(
                nombre_usuario="Administrator",
                correo=admin_email,
                password_hash=hashed_password,
                rol="admin",
                xp_total=0,
                racha_actual=0
            )
            db.add(new_admin)
            db.commit()
            print(f"Successfully seeded admin user: {admin_email}")
        else:
            # Update existing admin user's hash to match the project's logic
            raw_password = "Admin2026!"
            hashed_password = raw_password + "notreallyhashed"
            if user.password_hash != hashed_password:
                user.password_hash = hashed_password
                user.rol = "admin"  # Ensure it is admin
                db.add(user)
                db.commit()
                print(f"Updated existing admin user's credentials: {admin_email}")
            else:
                print(f"Admin user already exists with correct credentials: {admin_email}")
            
    except Exception as e:
        print(f"Error seeding admin user: {e}")
        db.rollback()
    finally:
        db.close()

if __name__ == "__main__":
    seed_admin_user()
