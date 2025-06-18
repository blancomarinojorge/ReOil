# 1. meter o id do usuario do equipo actual no .env para leelo dende o docker-compose e que
### non haxa problemas de permisos a hora de crear arquivos dende o contedor
echo "UID=$(id -u)" > .env
echo "GID=$(id -g)" >> .env

# 2. aseguramos que o usuario actual(que é o mismo que o do docker) sexa o propietario do proyecto
### pa evitarnos problemas con npm, artisan, composer...
sudo chown -R "$(id -u)":"$(id -g)" .

# 3. docker compose e build
docker compose up -d --build

# 4. creacion das tablsa da base de datos
## espero a que mysql estea listo para recibir conexions, se tarda mais de 30 segundos canceloo
echo "Esperando a que mysql estea listo para facer as migracions..."

MAX_RETRIES=15 #15*2seg = 30seg
count=0
until docker exec laravel_mysql mysqladmin ping -h "localhost" --silent; do
  count=$((count+1))
  if [ $count -ge $MAX_RETRIES ]; then
    echo "Non se puido establecer conexions co contedor mysql, cancelando migracions..."
    exit 1
  fi

  echo "A base de datos sigue sen estar lista... esperando 2 segundos"
  sleep 2
done

echo "Base de datos lista, facendo migracions..."
sleep 4
docker exec -it laravel_app php artisan migrate || {
  echo "Erro executando as migracions, podes intentalo de novo co comando:"
  echo "docker exec -it laravel_app php artisan migrate"
  exit 1
}

echo "\nTodo listo! Podes acceder a aplicación en http://localhost:8000"