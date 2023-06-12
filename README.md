# Aplicaci�n bancaria en PHP (DDD + Arq. Hex.)

Implementaci�n de una aplicaci�n bancaria en PHP usando DDD y Arquitectura Hexagonal.  Permite:
* crear un usuario
* crear una cuenta
* realizar dep�sitos
* realizar transferencias
* visualizar una cuenta, con todos sus movimientos

## Instalaci�n

Para usar la aplicaci�n hay que seguir estos pasos.
Clonar el repositorio:
```sh
git clone https://github.com/oscarpascualbakker/ddd-hex-arch-banking.git
```

Levantar el contenedor Docker:

```sh
$ docker compose up -d
```

Entrar en el contenedor y ejecutar la instalaci�n de composer:
```sh
$ composer install
```

Los endpoints generados son los siguientes:


| Tipo | Endpoint | Objetivo |
|---|---|---|
| POST | /users | Crear usuario |
| POST | /accounts | Crear cuenta |
| POST | /accounts/{accountId}/deposit | Realizar dep�sito en una cuenta |
| GET | /accounts/{accountId} | Obtener info de una cuenta |
| POST | /transfer | Realizar transferencia |


No he generado un entorno de test tipo Swagger UI.

A partir de aqu�, la mejor manera de visualizar el funcionamiento de la aplicaci�n es la ejecuci�n de los tests, ya que incluye un test de integraci�n que visualiza el resultado de las operaciones realizadas.

Desde el directorio /var/www/html/api se ejecuta la siguiente instrucci�n:

```sh
$ vendor/bin/phpunit
```

Este es el resultado esperado de los tests:
![Resultado de los tests](https://oscarpascual.com/test-results.jpg)