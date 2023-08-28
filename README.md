# Prueba DT - Backend PHP

En este repositorio se encuentra alojado el desarrollo de la prueba técnica

## Comenzando 🚀

Instrucciones generales de cómo correr el proyecto de forma local

### Pre-requisitos 📋

Para poder ejecutar el proyecto de forma local se deben tener instalados los siguientes programas:

1. Tener instalado Git para poder clonar el repositorio
2. Visual Studio Code (O cualquier otro editor de tecto de preferencia)
3. Tener instalado Mysql motor de base de datos
4. PHP lenguaje de programación necesario para correr el aplicativo
5. Composer para el manejador de dependencias de PHP

### Instalación 🔧

Asumiendo que se cuentan con los programas previamente mencionados para poder ejecutar esta parte del proyecto, el siguiente paso a paso describirá cómo poder desplegar el proyecto de forma local

1. Se debe clonar el repositorio en una carpeta dentro del equipo en que se quiere desplegar
2. Luego se debe acceder a la carpeta raíz donde quedó el repositorio y allí abrir una consola de comandos y ejecutar el comando: "composer install"
3. Seguido se ejecuta el comando: "npm install"
4. Posteriormente crear una base de datos en MySQL la cual se llamará "rickandmorty"
5. Continuando, se debe crear el archivo .env. Se puede duplicar el archivo .env.example y renombrarlo como .env
6. Luego se genera la clave de la aplicación ejecutando el comando: "php artisan key:generate"
7. Por último, ejecutamos las migraciones y los seeder con el comando: "php artisan migrate:fresh --seed"
8. Una vez finalizado el proceso, se ejecuta el comando: "php artisan serve --port=7000"

## Despliegue 📦

Este comando "php artisan serve --port=7000" desplegará de forma local la aplicación, la cual se desplegará en el puerto 7000.

## Explicación ⚙️

Al iniciar la aplicación en la consola arrojara "Server running on [http://127.0.0.1:7000]"

Se tienen endpoints tipos GET, POST, PUT, PATCH y DELETE, los cuales consumen los recursos de las 3 entidades: Character, Location, Episode

Estos pueden ser consumidos mediante:

→/crud/characters
→/characters
|| Consumo de los endpoints tipo GET, POST, PUT, PATCH, DELETE para la entidad Character.

→/crud/locaitions
→/locaitions
|| Consumo de los endpoints tipo GET, POST, PUT, PATCH, DELETE para la entidad Location.

→/crud/episodes
→/episodes
|| Consumo de los endpoints tipo GET, POST, PUT, PATCH, DELETE para la entidad Episode.

Cabe aclarar que los endpoints tipo PUT, PATCH, DELETE necesitan ser suminstrados con un parametro 'id', esto para especificar el registro exacto de la entidad.

-   El archivo ubicado en public/files/Informe prueba técnica DT.docx, describe brevemente el proceso de análisis, entendimiento, desarrollo y complicaciones encontradas en la resolución del reto.

## Construido con 🛠️

-   [Laravel](https://laravel.com/docs/10.x)

## Autor

-   Steveen Dominguez
