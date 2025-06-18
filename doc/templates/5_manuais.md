# Manuais


## Manual técnico do proxecto

### Instalación
O proxecto contén unha aplicación laravel e unha aplicación android, ambas incluidas no repositorio dentro da carpeta `app`:
* `laravel`: Proxecto web en laravel
* `android`: Aplicación mobil

1. Usando git, clonar o repositorio co comando:
````shell
git clone https://gitlab.iessanclemente.net/damo/a17jorgebm.git
````
Tamen se podería optar por descargar o `.zip` do repositorio directamente.

---
#### Aplicacion laravel
Requisitos:
* Linux
* Docker

Para a aplicación web en laravel, é altamente recomendable despregala nun entorno linux, xa que esta usa docker para despregar os servicios.
Docker sobre windows ten un tempo de reposta moito mais alto debido a que precisa unha maquina virtual linux para funcionar, polo que a velocidade da aplicación sufriría drasticamente.

Durante o desenvolvemento do proxecto elaborouse un script que soluciona algúns problemas de permisos coas ferramentas de desenvolvemento, polo que se recomenda usar. Contido do script:
```shell
# 1. meter o id do usuario do equipo actual no .env para leelo dende o docker-compose e que
### non haxa problemas de permisos a hora de crear arquivos dende o contedor
echo "UID=$(id -u)" > .env
echo "GID=$(id -g)" >> .env

# 2. aseguramos que o usuario actual(que é o mismo que o do docker) sexa o propietario do proyecto
### pa evitarnos problemas con npm, artisan, composer...
sudo chown -R "$(id -u)":"$(id -g)" .

# 3. docker compose e build
docker compose up -d --build

# 4. creacion das tablas da base de datos
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
```
1. Situaremonos na carpeta `app/laravel`
2. Executaremos o script con:
```shell
sh setup-app.sh
```
_Opción sen script:_ `docker compose up -d --build` e `docker exec -it laravel_app php artisan migrate` (se este segundo comando da erro, esperar uns segundos e repetilo, pode que mysql non estivese listo ainda)

3. Se queremos ter datos ficticios na aplicación, executaremos o seguinte comando:
```shell
docker exec -it laravel_app php artisan db:seed
```

Poderemos acceder a aplicación mediante un navegador coa url `localhost:8000`. E tamen teremos acceso a base de datos mediante `localhost:8080`:
* usuario: root
* password: root


Indicar que todos os usuarios ficticios xerados na aplicación teñen a contraseña `abc123..`, podese revisar na tabla `users` da base de datos e buscar por un usuario con rol `1` (administrador), copiando o email de ese usuario poderemos acceder e probar a aplicación con datos ficticios.

Por outra banda, sempre poderemos crear unha nova conta de administración para unha nova empresa, dende a que teremos permisos para realizar todas as accións.

Como ultimo apunte, para seguir desenvolvendo o proxecto e ter un **entorno local**:
1. Cambiar a configuración do `.env` polo exemplo en `.env.local`
2. Entrar no contedor docker con `docker exec -it laravel_app bash`
3. Executar o entorno de dev de Vite con `npm run dev`. Con esto teremos actualizacións automaticas de cambios no navegador.

*Sempre que vaiamos a subir os cambios a producción haberá que facer `npm run build` dentro do contedor da aplicación.

---
#### Aplicación android
Requisitos:
* Android studio

Para despregar a aplicación de android usaremos Android Studio:
1. Abriremos o proxecto da carpeta `app/android`
2. Esperaremos a que android studio cargue
3. Executamos a aplicación

## Melloras futuras
Dentro da aplicación existen multiples ámbitos nos que me gustaría mellorar, dende a usabilidade ata as tecnoloxías usadas, así como funcionalidades específicas relacionadas estreitamente coa lóxica de negocio.

Con respecto as tecnoloxías, gustaríame ampliar a app usando algún framework de frontend como `Vue` ou `Livewire`. A comezos do desarrollo do proxecto tiñase en mente usar Livewire xunto con Alpinejs para facer a aplicación mais dinámica e interactuable, gardando cambios sen ter que recargar a páxina completa, pero por cuestión de tempo non o puiden implementar. Finalmente usouse javascript vanilla no front, sobretodo para a pantalla de creación de recollidas, a cal se quedaba algo atrás solo usando Laravel e formularios.

Tamen me gustaría poder usar outro sistema de permisos en base de datos que fora mais flexible que as `Policies` en laravel. Permitindo que o usuario puidera modificar e engadir novos permisos faría que a aplicación fora mais flexible e puidera servir a mais empresas. Un paquete que pode encaixar nestes requisitos sería `spatie/laravel-permission`.

Por último, mellorar a implementación con maps e o sistema de seguimento de rutas en xeral, ainda que foi complicado debido a que cada vez os servizos gratuitos de google maps son mais escasos.