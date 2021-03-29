<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="100">
<img src="storage/readme-images/sys-bank.png" width="40">
</a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<!-- ![alt text](storage/readme-images/localhost.png) -->

## Pré-requisitos

O projeto foi desenvolvido utilizando o [PHP 8.0](https://www.php.net/) com framework [Laravel 8.x.x](https://laravel.com/) e [Docker for Windows 20.10.5](https://www.docker.com/). Siga as instruções de instalação e os pré-requisitos para executar o projeto localmente na sua máquina.

- [Docker For Windows v20.10.5](https://www.docker.com/get-started)

Outros requisitos como **PHP**, **Composer**, **Postgres** serão provisionados através dos containers docker que serão criados.

## Características do projeto

- Boas práticas de clean code;
- Desenvolvimento orientado à objetos;
- Aplicado conceito de [SOLID](https://medium.com/desenvolvendo-com-paixao/o-que-%C3%A9-solid-o-guia-completo-para-voc%C3%AA-entender-os-5-princ%C3%ADpios-da-poo-2b937b3fc530);
- Versionamento de banco de dados (migrations);
- Dados pré-processados (Seeders);
- REST Api;
- Banco de dados [PostgresSQL](https://www.postgresql.org/)
- [Laravel Passport](https://laravel.com/docs/8.x/passport) autenticação jwt.

## Instalação

Faça o clone do respositório do projeto:

```
git clone https://github.com/fabinhoc/sys-bank
```
Entre na pasta do projeto clonado e execute o comando abaixo:
```
$ ~/ cd sys-bank
$ ~/sys-bank/ docker-compose up -d
```
Após executar esse comando, o seu terminal deverá retornar isso: 

![image-docker-installed](storage/readme-images/docker-containers.png)

Execute o comando abaixo para baixar as dependências do projeto e instalar o Laravel Framework:
```
$ ~/sys-bank/ docker-compose exec composer install
```
Após a instalação do projeto copiar o arquivo ``` .env.example ``` e renomear para ``` .env ```

Alterar variáveis de ambiente do arquivo ```.env ``` para acesso ao banco de dados:

```
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=sys-bank
DB_USERNAME=sys-bank
DB_PASSWORD=sys-bank
```

Após isso executar o seguinte comando:

```
$ ~/sys-bank/ docker-compose exec php-fpm php artisan key:generate
```
Acessar o link [http://localhost:8000](http://localhost:8000)

![image-localhost](storage/readme-images/localhost.png)

Executar os seguintes comandos:

```
$ ~/sys-bank/ docker-compose exec php-fpm php artisan migrate
```

![image-localhost](storage/readme-images/migrations.png)

```
$ ~/sys-bank/ docker-compose exec php-fpm php artisan passport:install
```
![image-localhost](storage/readme-images/passport-install.png)

```
$ ~/sys-bank/ docker-compose exec php-fpm php artisan passport:client --password
```
![image-localhost](storage/readme-images/passport-client.png)

**ATENÇÃO: Guarde as credencias que são exibidas após esse comando pois ela será utilizada para realizar nossos testes unitários e conectar nosso frontend com backend. CLIENT ID e CLIENT SECRET.**

Após isso executar o comando para gerar os seeds:
``` 
$ ~/sys-bank/ docker-compose exec php-fpm php artisan db:seed
```
![image-localhost](storage/readme-images/seeds.png)

alterar arquivo ``` sys-bank/tests/Unit/ClientData.php ```
com as credenciais geradas pelo passport

```
return [
    'grant_type' => 'password',
    'client_id' => SEU CLIENT ID,
    'client_secret' => 'SEU CLIENT SECRET',
    'username' => 'fabio@gmail.com', // USUARIO CRIADO PARA TESTES
    'password' => 'admin',
    'scope' => ''
];
```
Após isso ja podemos executar nossos testes unitários, para isso execute o comando:

```
$ ~/sys-bank/ docker-compose exec php-fpm php artisan tests
```
![image-localhost](storage/readme-images/tests.png)

## Frontend do projeto
Acesse este repositório [https://github.com/fabinhoc/sys-bank-frontend](https://github.com/fabinhoc/sys-bank-frontend) para ter acesso ao frontend do projeto.
