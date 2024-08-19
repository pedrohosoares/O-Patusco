
# O Patusco

# Para instalar
- 1 - Instale o composer
- 2 - Na pasta do projeto, rode o comando: composer install
- 3 - Rode o comando: php artisan key:generate
- 4 - Crie uma base de dados e a configura no arquivo .env.
- 5 - Rode o comando php artisan migrate
- 6 - Rode o comando php artisan db:seed.
- 6.1 - Rode o comando php artisan insert:users
- 7 - Rode php artisan serve
- 8 - Com isso, seu back-end estará configurado e rodando.
- 9 - Instale o Node 18 - 20
- 10 - Instale o npm
- 11 - Rode o npm run prod

O projeto possui interfaces, serviços, repositórios e policies.

Ele usa o Laravel / Sanctum para autenticar requisições e gerar tokens.

Para fazer requisições, você precisa fazer um get para: http://localhost:8000/sanctum/csrf-cookie e em seguida, realizar o login pelo endpoint http://localhost:8000/api/login, passando seu e-mail e senha nos campos (email, password) via post.

# Usuários

Todos usuários possuem a senha 'password', sendo eles:

medico@gmail.com - Para o médico

recepcionista@gmail.com - Para a recepcionista

cliente@gmail.com - Para o utente

Você pode usar eles para fazer o login e averiguar as permissões.


# Endpoints:

**POST** /api/login -> Faz o login na aplicação

## Para médicos e recepcionistas:

**GET** /api/receptionists/schedules 

**GET** /api/receptionists/schedules/show/{id}

**DELETE** /api/receptionists/schedules/{id}

**POST** /api/receptionists/schedules/store

**PUT** /receptionists/schedules/update/{id}

**POST** /receptionists/schedules/join_doctor/{schedule_id}/{doctor_id}

**POST** /receptionists/schedules/remove_doctor/{schedule_id}/{doctor_id}

## Médico

**GET** /api/doctors/schedules

**PUT** /api/doctors/schedules/{id}

**GET** /doctors/schedules/show/{id}



