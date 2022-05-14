/* L�gico_1: */

CREATE TABLE INSTITUICAO_RESPONSAVEL (
    id INTEGER PRIMARY KEY,
    nome VARCHAR,
    tipo_organizacao VARCHAR,
    cep VARCHAR,
    rua VARCHAR,
    numero INTEGER,
    bairro VARCHAR,
    cidade VARCHAR,
    uf CHAR,
    dt_cad DATE,
    ocupacao VARCHAR,
    email VARCHAR,
    telefone VARCHAR
);

CREATE TABLE AGENDA (
    id INTEGER PRIMARY KEY,
    data DATE,
    num_visitantes INTEGER,
    status VARCHAR,
    n_especial VARCHAR,
    FK_INSTITUICAO_RESPONSAVEL_id INTEGER,
    motivo_status VARCHAR,
    hora TIME
);

CREATE TABLE TIPO_NECESSIDADE (
    id INTEGER PRIMARY KEY,
    tipo VARCHAR
);

CREATE TABLE USUARIO (
    id INTEGER PRIMARY KEY,
    usuario VARCHAR,
    senha VARCHAR
);

CREATE TABLE VISITANTE (
    id INTEGER PRIMARY KEY,
    nome VARCHAR,
    ocupacao VARCHAR,
    dt_nascimento DATE,
    cidade VARCHAR,
    uf CHAR,
    mensagem VARCHAR,
    dt_cad DATE
);

CREATE TABLE OBSERVACOES (
    id INTEGER PRIMARY KEY,
    mensagem VARCHAR,
    FK_INSTITUICAO_RESPONSAVEL_id INTEGER
);

CREATE TABLE CLASSIFICA_TIPO (
    id INTEGER PRIMARY KEY,
    FK_AGENDA_id INTEGER,
    FK_TIPO_NECESSIDADE_id INTEGER
);
 
ALTER TABLE AGENDA ADD CONSTRAINT FK_AGENDA_2
    FOREIGN KEY (FK_INSTITUICAO_RESPONSAVEL_id)
    REFERENCES INSTITUICAO_RESPONSAVEL (id)
    ON DELETE RESTRICT;
 
ALTER TABLE OBSERVACOES ADD CONSTRAINT FK_OBSERVACOES_2
    FOREIGN KEY (FK_INSTITUICAO_RESPONSAVEL_id)
    REFERENCES INSTITUICAO_RESPONSAVEL (id)
    ON DELETE RESTRICT;
 
ALTER TABLE CLASSIFICA_TIPO ADD CONSTRAINT FK_CLASSIFICA_TIPO_2
    FOREIGN KEY (FK_AGENDA_id)
    REFERENCES AGENDA (id);
 
ALTER TABLE CLASSIFICA_TIPO ADD CONSTRAINT FK_CLASSIFICA_TIPO_3
    FOREIGN KEY (FK_TIPO_NECESSIDADE_id)
    REFERENCES TIPO_NECESSIDADE (id);