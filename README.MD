# SETUP PROJECT

# Docker setup.

1. cp env.example .env
2. set .env variables
3. docker-compose up
4. docker exec -it RoomBooking-backend bash

# Generate tables in database.

5. php artisan migrate

# Upload database with basic datas.

6. php artisan db:seed

# Create admin user.

7. php artisan app:admin
