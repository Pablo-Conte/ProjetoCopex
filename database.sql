CREATE DATABASE site;

USE site;

CREATE TABLE IF NOT EXISTS administrador (
	id_administrador INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255),
    senha VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    siape VARCHAR(255) UNIQUE
);

CREATE TABLE IF NOT EXISTS empresa (
	id_empresa INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    cnpj VARCHAR(35) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    numero VARCHAR(20) UNIQUE NOT NULL
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
    numero VARCHAR(20) UNIQUE NOT NULL,
    matricula VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    curso VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS vaga_aluno (
    id_vagaAluno INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_vaga INT,
    id_aluno INT,
    CONSTRAINT fk_id_vaga FOREIGN KEY (id_vaga) REFERENCES vaga (id_vaga),
    CONSTRAINT fk_id_aluno FOREIGN KEY (id_aluno) REFERENCES aluno (id_aluno) 
);

CREATE TABLE IF NOT EXISTS passwordCodeAdmin (
    id_code INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_admin INT,
    code VARCHAR(70)
);

CREATE TABLE IF NOT EXISTS passwordCodeAluno (
    id_code INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_aluno INT,
    code VARCHAR(70)
);

CREATE TABLE IF NOT EXISTS passwordCodeEmpresa (
    id_code INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_empresa INT,
    code VARCHAR(70)
);


-- Adicionando dados fictícios para testes

INSERT INTO aluno (nome,senha,matricula,email,curso,numero) VALUES ("Pablo Conte Correa","$2y$10$giNXQuOifTYENvNhxEC0uepxOzgUigSDxEfZvXjAShfqaAnt2jgGq","1","pablo.correa.nr@gmail.com","Informática","997602457");
INSERT INTO aluno (nome,senha,matricula,email,curso,numero) VALUES ("Luana Conte Correa","$2y$10$giNXQuOifTYENvNhxEC0uepxOzgUigSDxEfZvXjAShfqaAnt2jgGq","2","pablo.correa.nr@gmail.com1","Informática","997602458");
INSERT INTO aluno (nome,senha,matricula,email,curso,numero) VALUES ("Thomas Schimdt","$2y$10$giNXQuOifTYENvNhxEC0uepxOzgUigSDxEfZvXjAShfqaAnt2jgGq","3","pablo.correa.nr@gmail.com2","Informática","997602459");
INSERT INTO aluno (nome,senha,matricula,email,curso,numero) VALUES ("Luis da Silva","$2y$10$giNXQuOifTYENvNhxEC0uepxOzgUigSDxEfZvXjAShfqaAnt2jgGq","4","pablo.correa.nr@gmail.com3","Informática","997602451");
INSERT INTO aluno (nome,senha,matricula,email,curso,numero) VALUES ("Kellen Kern","$2y$10$giNXQuOifTYENvNhxEC0uepxOzgUigSDxEfZvXjAShfqaAnt2jgGq","5","pablo.correa.nr@gmail.com4","Informática","997602452");
INSERT INTO aluno (nome,senha,matricula,email,curso,numero) VALUES ("William Renan Novak","$2y$10$giNXQuOifTYENvNhxEC0uepxOzgUigSDxEfZvXjAShfqaAnt2jgGq","6","pablo.correa.nr@gmail.com5","Informática","997602453");
INSERT INTO aluno (nome,senha,matricula,email,curso,numero) VALUES ("Pâmela","$2y$10$giNXQuOifTYENvNhxEC0uepxOzgUigSDxEfZvXjAShfqaAnt2jgGq","10","pamela@gmail.com","Eletromecânica","9976024578789");

INSERT INTO empresa (nome, senha, cnpj, email, numero) VALUES ("Tec System","$2y$10$giNXQuOifTYENvNhxEC0uepxOzgUigSDxEfZvXjAShfqaAnt2jgGq","1","pablo.correa.nr@gmail.com","5551997602457");
INSERT INTO empresa (nome, senha, cnpj, email, numero) VALUES ("Paipe","$2y$10$giNXQuOifTYENvNhxEC0uepxOzgUigSDxEfZvXjAShfqaAnt2jgGq","2","pablo.correa.nr@gmail.com1","5551997602458");

INSERT INTO vaga (salario, curso, cargo, descricao, id_emp) VALUES (800,"Informática","Suporte","Fará o atendimento ao cliente mais monitoramento de rede proativo etc...",1);
INSERT INTO vaga (salario, curso, cargo, descricao, id_emp) VALUES (1000,"Informática","Desenvolvedor","Será um desenvolvedor fullstack da empresa etc...",1);
INSERT INTO vaga (salario, curso, cargo, descricao, id_emp) VALUES (600,"Informática","Database tester","Será o QA tester de banco de dados da empresa etc...",1);
INSERT INTO vaga (salario, curso, cargo, descricao, id_emp) VALUES (1200,"Informática","NOC","Cuidará da infraestrutura de redes da instituição etc...",1);
INSERT INTO vaga (salario, curso, cargo, descricao, id_emp) VALUES (300,"Informática","Desenvolvedor Mobile","Desenvolverá com linguagens de programação como Kotlin e Java etc...",2);
INSERT INTO vaga (salario, curso, cargo, descricao, id_emp) VALUES (500,"Informática","Desenvolvedor Front-end","Desenvolverá com Angular e React-TS etc...",2);
INSERT INTO vaga (salario, curso, cargo, descricao, id_emp) VALUES (700,"Informática","Desenvolvedor Back-end","Desenvolverá aplicações backend utilizando typescript etc...",2);
INSERT INTO vaga (salario, curso, cargo, descricao, id_emp) VALUES (777,"Informática","Técnico em informática","Prestará serviço básico de informática para escolas etc...",2);
INSERT INTO vaga (salario, curso, cargo, descricao, id_emp) VALUES (900,"Informática","Manutenção de computadores","Fará reparo de computadores e hardwares em geral etc...",2);

INSERT INTO administrador (nome, senha, email, siape) VALUES ("Ronise","$2y$10$bM1wqToYnC7gzqwDfl1hyOgWU5SWiuMxqPwiJsDVCkkqnDE3o70HW","ronise@gmail.com","1");
INSERT INTO administrador (nome, senha, email, siape) VALUES ("Rafael","$2y$10$bM1wqToYnC7gzqwDfl1hyOgWU5SWiuMxqPwiJsDVCkkqnDE3o70HW","ronise@gmail.com1","2");
INSERT INTO administrador (nome, senha, email, siape) VALUES ("Walter","$2y$10$bM1wqToYnC7gzqwDfl1hyOgWU5SWiuMxqPwiJsDVCkkqnDE3o70HW","ronise@gmail.com2","3");
INSERT INTO administrador (nome, senha, email, siape) VALUES ("Katy","$2y$10$bM1wqToYnC7gzqwDfl1hyOgWU5SWiuMxqPwiJsDVCkkqnDE3o70HW","ronise@gmail.com3","4");
INSERT INTO administrador (nome, senha, email, siape) VALUES ("João","$2y$10$bM1wqToYnC7gzqwDfl1hyOgWU5SWiuMxqPwiJsDVCkkqnDE3o70HW","ronise@gmail.com4","5");
INSERT INTO administrador (nome, senha, email, siape) VALUES ("Pablo","$2y$10$bM1wqToYnC7gzqwDfl1hyOgWU5SWiuMxqPwiJsDVCkkqnDE3o70HW","ronise@gmail.com5","6");
INSERT INTO administrador (nome, senha, email, siape) VALUES ("William","$2y$10$bM1wqToYnC7gzqwDfl1hyOgWU5SWiuMxqPwiJsDVCkkqnDE3o70HW","ronise@gmail.com6","7");
INSERT INTO administrador (nome, senha, email, siape) VALUES ("Jorge","$2y$10$bM1wqToYnC7gzqwDfl1hyOgWU5SWiuMxqPwiJsDVCkkqnDE3o70HW","ronise@gmail.com7","8");
INSERT INTO administrador (nome, senha, email, siape) VALUES ("Naira","$2y$10$bM1wqToYnC7gzqwDfl1hyOgWU5SWiuMxqPwiJsDVCkkqnDE3o70HW","ronise@gmail.com8","9");
INSERT INTO administrador (nome, senha, email, siape) VALUES ("Paulo","$2y$10$bM1wqToYnC7gzqwDfl1hyOgWU5SWiuMxqPwiJsDVCkkqnDE3o70HW","ronise@gmail.com9","10");