#cài đặt dos2unix trên wsl ubuntu nếu chưa cài
sudo apt-get install dos2unix

#cài đặt .env
/bin/bash ./setup-env.sh
JWT_SECRET=4m7zidEiDXPY2pF72fBCTKy9QO0UMmAaOw1U0b2FmhfpwU0joFeGilY7GGiUzNRG
MEILISEARCH_KEY=P_bKjtUOiDg6h01Ex75vwkQvbtm7W21EkMZOz0d3IcE

#build dự án laravel
docker-compose build --no-cache

#chạy dự án
docker-compose up -d

#tạo app key
docker compose exec -it --user www-data laravel /bin/bash -c "php artisan key:generate"

#chạy composer install
docker compose exec -it --user www-data laravel /bin/bash -c "composer install"

#setup database
docker compose exec -it --user www-data laravel /bin/bash -c "php artisan migrate"
docker compose exec -it --user www-data laravel /bin/bash -c "php artisan db:seed"

#Laravel http://localhost:8080/
#Meilisearch http://localhost:7700/
#ReactJS http://localhost:3000/
