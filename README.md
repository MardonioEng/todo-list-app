<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200"></a></p>


## ToDo List App - REST API

Descrição da API e tecnologias utilizadas...



## Features

- [ ] Cada item da lista deve possuir os atributos nome, data de criação, categoria e usuário
- [ ] Cada categoria deve possuir os atributos nome e descrição
- [ ] O sistema deve permitir o cadastro e edição de usuários. Cada usuário deve ter os atributos nome, senha e e-mail
- [ ] Ao inserir um usuário, o sistema deve enviar um e-mail de confirmação de cadastro
- [ ] A aplicação deverá permitir a redefinição de senha via e-mail
- [ ] A autenticação será feita usando JWT
- [ ] Cada usuário poderá exportar sua lista no formato PDF
- [ ] A API será documentada usando Swagger





### Inicialização do projeto

````
composer create-project --prefer-dist laravel/laravel app_locadora_carros
````

### **Criação de Models, Controllers e Migrations**

````php
php artisan make:model --migration --controller Categoria
````

````php
php artisan make:model --migration --controller Usuario
````

````php
php artisan make:model --migration --controller Item
````



