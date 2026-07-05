# 🎬 CineManager

Sistema Web de Gerenciamento de Filmes desenvolvido para a disciplina de **Desenvolvimento Web II** do curso de **Análise e Desenvolvimento de Sistemas**.

O sistema permite o gerenciamento completo de filmes e gêneros, contando com autenticação de usuários, operações CRUD e integração com banco de dados MySQL utilizando PHP.

---

## 📚 Sobre o Projeto

O CineManager foi desenvolvido com o objetivo de aplicar os principais conceitos estudados durante a disciplina de Desenvolvimento Web II, incluindo:

- Autenticação de usuários
- Sessões em PHP
- CRUD completo
- Relacionamento entre tabelas
- Validação de formulários
- Organização de arquivos
- Conexão com banco de dados
- Docker
- HTML, CSS e Bootstrap

O sistema possui uma interface inspirada em plataformas de streaming, proporcionando uma navegação simples e agradável.

---

## ✨ Funcionalidades

### 🔐 Autenticação

- Login de usuários
- Senhas criptografadas utilizando `password_hash()`
- Proteção das páginas através de sessões
- Logout

---

### 🎥 Gerenciamento de Filmes

CRUD completo contendo:

- Cadastro
- Listagem
- Edição
- Exclusão

Campos disponíveis:

- Título
- Diretor
- Gênero
- Duração
- Ano de lançamento
- Plataforma de exibição

---

### 🎭 Gerenciamento de Gêneros

CRUD completo para gerenciamento dos gêneros cadastrados.

Funcionalidades:

- Cadastro
- Listagem
- Edição
- Exclusão

O sistema impede a exclusão de um gênero que esteja sendo utilizado por algum filme.

---

## 🛠 Tecnologias Utilizadas

- PHP 8
- MySQL
- HTML5
- CSS3
- Bootstrap 5
- Docker
- phpMyAdmin

---

## 📁 Estrutura do Projeto

```
sistema-filmes/
│
├── css/
│   └── style.css
│
├── filmes/
│   ├── cadastrar.php
│   ├── editar.php
│   ├── excluir.php
│   └── listar.php
│
├── generos/
│   ├── cadastrar.php
│   ├── editar.php
│   ├── excluir.php
│   └── listar.php
│
├── includes/
│   ├── cabecalho.php
│   ├── menu.php
│   ├── rodape.php
│   └── verifica_login.php
│
├── sql/
│   └── banco.sql
│
├── conecta.php
├── index.php
├── login.php
├── logout.php
├── docker-compose.yml
└── Dockerfile
```

---

## 🗄 Banco de Dados

O banco de dados é composto pelas seguintes tabelas:

- usuarios
- filmes
- generos

Relacionamento:

```
generos (1)
      │
      │
      ▼
filmes (N)
```

---

## ▶ Como executar o projeto

### 1. Clonar o repositório

```bash
git clone https://github.com/Guilherme-Morschel/Sistema-de-Gerenciamento-de-Filmes.git
```

---

### 2. Acessar o projeto

```bash
cd Sistema-de-Gerenciamento-de-Filmes
```

---

### 3. Iniciar os containers Docker

```bash
docker compose up -d
```

---

### 4. Importar o banco de dados

Abra o phpMyAdmin:

```
http://localhost:8081
```

Importe o arquivo:

```
sql/banco.sql
```

---

### 5. Criar o usuário administrador

Execute:

```
http://localhost:8080/criar_admin.php
```

Após a criação do usuário, recomenda-se remover ou comentar este arquivo por questões de segurança.

---

### 6. Acessar o sistema

```
http://localhost:8080
```

---

## 🔑 Usuário padrão

Caso o banco esteja vazio, utilize o script `criar_admin.php` para gerar o primeiro usuário administrador.

---

## 📖 Conceitos aplicados

Durante o desenvolvimento foram utilizados os seguintes conceitos:

- Programação em PHP
- Sessões
- Includes
- Prepared Statements
- Relacionamentos entre tabelas
- CRUD
- HTML
- CSS
- Bootstrap
- Docker
- Organização em camadas
- Validação de formulários
- Criptografia de senhas

---

## 👨‍💻 Autor

**Guilherme Morschel**

Curso de Análise e Desenvolvimento de Sistemas

Disciplina: Desenvolvimento Web II

---

## 📄 Licença

Projeto desenvolvido exclusivamente para fins acadêmicos.