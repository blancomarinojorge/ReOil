# 1. meter o id do usuario do equipo actual no .env para leelo dende o docker-compose e que
### non haxa problemas de permisos a hora de crear arquivos dende o contedor
echo "UID=$(id -u)" > .env
echo "GID=$(id -g)" >> .env

# 2. aseguramos que o usuario actual(que é o mismo que o do docker) sexa o propietario do proyecto
### pa evitarnos problemas con npm, artisan, composer...
sudo chown -R "$(id -u)":"$(id -g)" .

# 3. docker compose e build
docker compose up -d --build