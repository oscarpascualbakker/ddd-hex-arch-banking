# Aplicación bancaria en PHP (DDD + Arq. Hex.)

Implementación de una aplicación bancaria en PHP usando DDD y Arquitectura Hexagonal.  Permite:
* crear un usuario
* crear una cuenta
* realizar depósitos
* realizar transferencias
* visualizar una cuenta, con todos sus movimientos

## Instalación

Para usar la aplicación hay que seguir estos pasos.
Clonar el repositorio:
```sh
git clone https://github.com/oscarpascualbakker/ddd-hex-arch-banking.git
```

Levantar el contenedor Docker:

```sh
$ docker compose up -d
```

Entrar en el contenedor y ejecutar la instalación de composer:
```sh
$ composer install
```

A partir de aquí, la mejor manera de visualizar el funcionamiento de la aplicación es la ejecución de los tests, ya que incluye un test de integración que visualiza el resultado de las operaciones realizadas.

```sh
$ docker container run -it --rm dijkstra vendor/bin/phpunit ./tests
```

Este es el resultado esperado de los tests:
![Resultado de los tests](https://oscarpascual.com/test-results.jpg)