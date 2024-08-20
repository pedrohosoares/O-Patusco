
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

O projeto possui interfaces, serviços, repositórios, classes abstratas e policies. Tentei isolar cada entidade no controller e serviços para especificar bastante a responsabilidade de cada uma.

Criei classes abstratas para os métodos não se repetirem também e só sobrescrevi elas colocando as permissões das policies.

Ele usa o Laravel / Sanctum para autenticar requisições e gerar tokens.

Para fazer requisições, você precisa fazer um get para: http://localhost:8000/sanctum/csrf-cookie e em seguida, realizar o login pelo endpoint http://localhost:8000/api/login, passando seu e-mail e senha nos campos (email, password) via post.

# Usuários

Todos usuários possuem a senha 'password', sendo eles:

medico@gmail.com - Para o médico

recepcionista@gmail.com - Para a recepcionista

cliente@gmail.com - Para o utente

Você pode usar eles para fazer o login e averiguar as permissões.


## Testes

Rode os testes com o comando 'php artisan test'

## Comandos 

Rode o comando php artisan migrate, php artisan db:seed e php artisan insert:users

# Endpoints:

**GET** /sanctum/csrf-cookie -> Prepara o login

**POST** /api/login -> Faz o login na aplicação com os campos email e password

**POST** /api/logout -> Faz logout

## Para médicos e recepcionistas:

**GET** /api/receptionists/schedules -> Aceita parametros como race, date_start e date_end

**GET** /api/receptionists/schedules/show/{schedule_id}

**DELETE** /api/receptionists/schedules/{schedule_id}

**POST** /api/receptionists/schedules/store -> dados usados abaixo:

- user[name]
- user[email]
- animal[name]
- animal[birthday]
- race[name]
- order[symptoms]
- schedule[date]
- schedule[time]

**PUT** /receptionists/schedules/update/{schedule_id} -> Atualiza a agenda

**POST** /receptionists/schedules/join_doctor/{schedule_id}/{doctor_id} -> Adiciona um médico a uma agenda

**POST** /receptionists/schedules/remove_doctor/{schedule_id}/{doctor_id} -> Remove um médico de uma agenda

**GET** /api/doctors/schedules -> Recupera todos os médicos

## Médico

**GET** /api/doctors/schedules -> Visualiza a agenda de um médico

**PUT** /api/doctors/schedules/{id} -> Atualiza uma agenda especifica

**GET** /doctors/schedules/show/{id} -> Visualiza uma agenda especifica



