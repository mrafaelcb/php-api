CREATE DATABASE aplicacao;

USE aplicacao;

CREATE TABLE usuario
(
    id              INT AUTO_INCREMENT,
    nome            VARCHAR(60) NOT NULL,
    data_nascimento DATE        NOT NULL,
    cpf             VARCHAR(11) NOT NULL UNIQUE,
    rg              VARCHAR(20) NOT NULL,
    data_criacao    DATETIME DEFAULT NOW(),
    data_alteracao  DATETIME DEFAULT NOW(),
    CONSTRAINT usuario_pk
        PRIMARY KEY (id)
);

CREATE TABLE pais
(
    id    INT AUTO_INCREMENT,
    nome  VARCHAR(80) NOT NULL,
    sigla VARCHAR(15) NOT NULL,
    CONSTRAINT pais_pk
        PRIMARY KEY (id)
);

CREATE TABLE estado
(
    id      INT AUTO_INCREMENT,
    nome    VARCHAR(80) NOT NULL,
    sigla   VARCHAR(15) NOT NULL,
    fk_pais INT         NOT NULL,
    CONSTRAINT estado_pk
        PRIMARY KEY (id),
    FOREIGN KEY (fk_pais) REFERENCES pais (id)
);

CREATE TABLE cidade
(
    id        INT AUTO_INCREMENT,
    nome      VARCHAR(80) NOT NULL,
    fk_estado INT         NOT NULL,
    CONSTRAINT cidade_pk
        PRIMARY KEY (id),
    FOREIGN KEY (fk_estado) REFERENCES estado (id)
);

CREATE TABLE bairro
(
    id        INT AUTO_INCREMENT,
    nome      VARCHAR(80) NOT NULL,
    fk_cidade INT         NOT NULL,
    CONSTRAINT cidade_pk
        PRIMARY KEY (id),
    FOREIGN KEY (fk_cidade) REFERENCES cidade (id)
);

CREATE TABLE endereco
(
    id             INT AUTO_INCREMENT,
    logradouro     VARCHAR(80) NOT NULL,
    complemento    VARCHAR(80),
    numero         VARCHAR(80),
    cep            VARCHAR(10),
    data_criacao   DATETIME DEFAULT NOW(),
    data_alteracao DATETIME DEFAULT NOW(),
    fk_bairro      INT         NOT NULL,
    CONSTRAINT endereco_pk
        PRIMARY KEY (id),
    FOREIGN KEY (fk_bairro) REFERENCES bairro (id)
);

CREATE TABLE telefone
(
    id             INT AUTO_INCREMENT,
    ddd            VARCHAR(2) NOT NULL,
    numero         VARCHAR(9) NOT NULL,
    data_criacao   DATETIME DEFAULT NOW(),
    data_alteracao DATETIME DEFAULT NOW(),
    fk_usuario     INT         NOT NULL,
    CONSTRAINT telefone_pk
        PRIMARY KEY (id),
    FOREIGN KEY (fk_usuario) REFERENCES usuario (id) ON DELETE CASCADE
);

CREATE TABLE usuario_endereco
(
    id          INT AUTO_INCREMENT,
    ativo       BOOLEAN DEFAULT TRUE,
    fk_usuario  INT NOT NULL,
    fk_endereco INT NOT NULL,
    CONSTRAINT usuario_endereco_pk
        PRIMARY KEY (id),
    CONSTRAINT usuario_endereco_pk_usuario FOREIGN KEY (fk_usuario) REFERENCES usuario (id)  ON DELETE CASCADE,
    CONSTRAINT usuario_endereco_pk_endereco FOREIGN KEY (fk_endereco) REFERENCES endereco (id)  ON DELETE CASCADE
);