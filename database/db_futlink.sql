create database db_futlink;
use db_futlink;

create table tbl_usuarios(
	id_user INT auto_increment primary key,
    nome varchar(150) not null,
    email varchar(150) not null,
    senha varchar(100) not null,
    data_nasc date not null,
    telefone varchar(20) not null,
    foto_perfil varchar(200) not null,
    data_registro_conta date not null
);

create table tbl_jogador(
	id_jogador int auto_increment primary key,
    id_user int,
    posicao varchar(150),
    altura varchar(150),
    peso decimal(5,2),
    foreign key(id_user) references tbl_usuarios(id_user)
);

create table tbl_funcionario(
	id_func int auto_increment primary key,
    id_user int,
    cargo varchar(100) not null,
    departamento varchar(100) not null,
    salario decimal(10,2) not null,
    data_admissao date,
    foreign key(id_user) references tbl_usuarios(id_user)
);

create table tbl_organizacao(
	id_org int auto_increment primary key,
    nome varchar(100) not null,
    slogan varchar(100) not null,
    tipo varchar(100) not null,
    data_criacao date,
    local varchar(50) not null
);

create table tbl_time(
	id_time int auto_increment primary key,
    id_org int,
    nome varchar(150),
    data_fundacao varchar(150),
    foreign key(id_org) references tbl_organizacao(id_org)
);

create table tbl_jogo(
	id_jogo int auto_increment primary key,
    id_time_casa int not null,
    id_time_fora int not null,
    data_jogo date,
	placar_casa int not null,
    placar_fora int not null,
	foreign key(id_time_casa) references tbl_time(id_time),
    foreign key(id_time_fora) references tbl_time(id_time)
);

-- tabelas relacionais

create table tbl_func_time(
	id_func_time int auto_increment primary key,
    id_func int,
    id_time int,
    foreign key(id_func) references tbl_funcionario(id_func),
    foreign key(id_time) references tbl_time(id_time)
);

create table tbl_hist_contrato(
	id_hist_contrato int auto_increment primary key,
    id_org int,
    id_time int,
    id_jogador int,
    foreign key(id_org) references tbl_organizacao(id_org),
    foreign key(id_time) references tbl_time(id_time),
    foreign key(id_jogador) references tbl_jogador(id_jogador)
);


-- INSERINDO DADOS NA TABELA

insert into tbl_usuarios (nome, email, senha, data_nasc, telefone, foto_perfil, data_registro_conta)
values
('João Silva', 'joao.silva@example.com', 'senha123', '1990-05-12', '11987654321', 'foto1.jpg', '2025-02-20'),
('Maria Oliveira', 'maria.oliveira@example.com', 'senha456', '1985-08-22', '21987654322', 'foto2.jpg', '2025-02-21'),
('Carlos Pereira', 'carlos.pereira@example.com', 'senha789', '1992-11-30', '31987654323', 'foto3.jpg', '2025-02-22'),
('Ana Costa', 'ana.costa@example.com', 'senha101112', '1998-02-10', '41987654324', 'foto4.jpg', '2025-02-23'),
('Paulo Souza', 'paulo.souza@example.com', 'senha131415', '1995-06-15', '51987654325', 'foto5.jpg', '2025-02-24');

insert into tbl_jogador (id_user, posicao, altura, peso)
values
(1, 'Atacante', '1.80m', 75.5),
(2, 'Meio-campo', '1.70m', 68.0),
(3, 'Goleiro', '1.90m', 85.0),
(4, 'Zagueiro', '1.85m', 80.0),
(5, 'Lateral-esquerdo', '1.75m', 72.0);

insert into tbl_funcionario (id_user, cargo, departamento, salario, data_admissao)
values
(1, 'Treinador', 'Técnico', 5000.00, '2025-01-01'),
(2, 'Assistente Técnico', 'Técnico', 3000.00, '2025-01-15'),
(3, 'Fisioterapeuta', 'Saúde', 2500.00, '2025-01-20'),
(4, 'Médico', 'Saúde', 3500.00, '2025-02-01'),
(5, 'Preparador Físico', 'Físico', 4000.00, '2025-02-05');

insert into tbl_organizacao (nome, slogan, tipo, data_criacao, local)
values
('FutLink FC', 'Unidos pelo Futebol', 'Clube', '2000-03-15', 'São Paulo'),
('Futebol Brasil', 'Futebol para todos', 'Clube', '1995-05-20', 'Rio de Janeiro'),
('Atlético Link', 'Vencer sempre!', 'Clube', '2010-08-10', 'Belo Horizonte'),
('Nordeste Futebol', 'A força do nordeste', 'Clube', '2005-07-22', 'Salvador'),
('Elite Futebol', 'Onde os campeões se encontram', 'Clube', '2015-09-30', 'Curitiba');

insert into tbl_time (id_org, nome, data_fundacao)
values
(1, 'FutLink Stars', '2000'),
(2, 'Brasil Futebol Clube', '1995'),
(3, 'Atlético Link FC', '2010'),
(4, 'Nordeste United', '2005'),
(5, 'Elite FC', '2015');

insert into tbl_jogo (id_time_casa, id_time_fora, data_jogo, placar_casa, placar_fora)
values
(1, 2, '2025-03-01', 2, 1),
(3, 4, '2025-03-02', 3, 3),
(5, 1, '2025-03-03', 1, 0),
(2, 5, '2025-03-04', 2, 2),
(4, 3, '2025-03-05', 0, 1);


insert into tbl_func_time (id_func, id_time)
values
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

insert into tbl_hist_contrato (id_org, id_time, id_jogador)
values
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

select * from tbl_usuarios;

select * from tbl_jogador;

select * from tbl_funcionario;

select * from tbl_usuarios as u
join tbl_jogador as j
on j.id_user = u.id_user;

