# BRIGEL2-FULLSTACK

## Visão Geral
BRIGEL2-FULLSTACK é uma aplicação web full-stack construída usando Laravel para o backend, MySQL para o banco de dados e Vue.js para o frontend.

## Funcionalidades
- Autenticação e autorização de usuários
- Operações CRUD para gerenciamento de recursos
- Design responsivo com Vue.js
- Integração com API RESTful

## Tecnologias Utilizadas
- **Backend:** Laravel
- **Banco de Dados:** MySQL
- **Frontend:** Vue.js

## Instalação

### Pré-requisitos
- PHP >= 7.3
- Composer
- Node.js & npm
- MySQL

### Passos
1. Clone o repositório:
    ```bash
    git clone https://github.com/yourusername/BRIGEL2-FULLSTACK.git
    cd BRIGEL2-FULLSTACK
    ```

2. Instale as dependências do backend:
    ```bash
    composer install
    ```

3. Instale as dependências do frontend:
    ```bash
    npm install
    ```

4. Configure o arquivo de ambiente:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. Configure o arquivo `.env` com suas credenciais do banco de dados:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_seu_banco_de_dados
    DB_USERNAME=seu_usuario_do_banco_de_dados
    DB_PASSWORD=sua_senha_do_banco_de_dados
    ```

6. Execute as migrações do banco de dados:
    ```bash
    php artisan migrate
    ```

7. Rode o seeder para criar um usuário administrador:
    ```bash
    php artisan db:seed --class=UserSeeder
    ```

    O seeder deve conter:
    ```php
    DB::table('users')->insert([
        'name' => 'Teste de seeder',
        'email' => 'teste@hotmail.com',
        'password' => Hash::make('admin123'),
        'role' => 'admin',
    ]);
    ```

8. Compile os assets do frontend:
    ```bash
    npm run dev
    ```

9. Sirva a aplicação:
    ```bash
    php artisan serve
    ```

## Rodando com Docker Compose

### Pré-requisitos
- Docker
- Docker Compose

### Passos
1. Clone o repositório:
    ```bash
    git clone https://github.com/yourusername/BRIGEL2-FULLSTACK.git
    cd BRIGEL2-FULLSTACK
    ```

2. Configure o arquivo de ambiente:
    ```bash
    cp .env.example .env
    ```

3. Configure o arquivo `.env` com suas credenciais do banco de dados:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=nome_do_seu_banco_de_dados
    DB_USERNAME=seu_usuario_do_banco_de_dados
    DB_PASSWORD=sua_senha_do_banco_de_dados
    ```

4. Construa e inicie os containers:
    ```bash
    docker-compose up --build
    ```

5. Execute as migrações do banco de dados:
    ```bash
    docker-compose exec app php artisan migrate
    ```

6. Rode o seeder para criar um usuário administrador:
    ```bash
    docker-compose exec app php artisan db:seed --class=UserSeeder
    ```

7. Acesse a aplicação em `http://localhost:8000`

## Uso
- Acesse a aplicação em `http://localhost:8000`
- Registre-se ou faça login para começar a usar o aplicativo

## Contribuindo
Contribuições são bem-vindas! Por favor, faça um fork do repositório e crie um pull request.

## Licença
Este projeto está licenciado sob a Licença MIT.

## Contato
Para qualquer dúvida, por favor, entre em contato com loboandre@hotmail.com