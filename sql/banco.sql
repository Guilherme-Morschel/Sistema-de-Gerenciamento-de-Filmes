-- =====================================================
-- Banco de Dados - Sistema de Gerenciamento de Filmes
-- =====================================================

USE sistema_filmes;

DROP TABLE IF EXISTS filmes;
DROP TABLE IF EXISTS generos;
DROP TABLE IF EXISTS usuarios;

-- =====================================================
-- Tabela: usuarios
-- =====================================================

CREATE TABLE usuarios (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(100) NOT NULL,

    login VARCHAR(50) NOT NULL UNIQUE,

    senha VARCHAR(255) NOT NULL

);

-- =====================================================
-- Tabela: generos
-- =====================================================

CREATE TABLE generos (

    id INT AUTO_INCREMENT PRIMARY KEY,

    genero VARCHAR(50) NOT NULL UNIQUE

);

-- =====================================================
-- Tabela: filmes
-- =====================================================

CREATE TABLE filmes (

    id INT AUTO_INCREMENT PRIMARY KEY,

    titulo VARCHAR(150) NOT NULL,

    diretor VARCHAR(100) NOT NULL,

    id_genero INT NOT NULL,

    duracao INT NOT NULL,

    ano_lancamento YEAR NOT NULL,

    plataforma ENUM('Streaming','Cinema','Ambos') NOT NULL,

    CONSTRAINT fk_filme_genero
        FOREIGN KEY (id_genero)
        REFERENCES generos(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT

);

-- =====================================================
-- Dados iniciais
-- =====================================================

INSERT INTO generos (genero) VALUES

('Ação'),
('Aventura'),
('Animação'),
('Comédia'),
('Documentário'),
('Drama'),
('Fantasia'),
('Ficção Científica'),
('Romance'),
('Suspense'),
('Terror');

-- =====================================================
-- Usuário Administrador
-- =====================================================
--
-- Será inserido posteriormente utilizando
-- password_hash() no PHP.
--
-- Login:
-- admin
--
-- Senha:
-- admin
--