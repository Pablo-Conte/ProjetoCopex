CREATE DATABASE site;

USE site;

CREATE TABLE IF NOT EXISTS administrador (
	id_administrador INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255),
    senha VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    siape VARCHAR(255) UNIQUE
);

INSERT INTO administrador (
    nome,
    senha,
    email,
    siape   
) VALUES (
    "Ronise",
    "$2y$10$bM1wqToYnC7gzqwDfl1hyOgWU5SWiuMxqPwiJsDVCkkqnDE3o70HW",
    "ronise@gmail.com",
    "1"
);

CREATE TABLE IF NOT EXISTS empresa (
	id_empresa INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    cnpj VARCHAR(14) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    numero VARCHAR(11) UNIQUE NOT NULL
);

CREATE TABLE IF NOT EXISTS vaga (
	id_vaga INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    salario VARCHAR(255) NOT NULL,
    curso VARCHAR(100) NOT NULL,
    cargo VARCHAR(255) NOT NULL, 
    descricao VARCHAR(1000) NOT NULL,
    id_emp INT,
    CONSTRAINT fk_id_emp FOREIGN KEY (id_emp) REFERENCES empresa (id_empresa) 
);

CREATE TABLE IF NOT EXISTS aluno (
	id_aluno INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    numero VARCHAR(11) UNIQUE NOT NULL,
    matricula VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    curso INT
);


