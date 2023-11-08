use pit;

create table usuario (
	id int primary key auto_increment,
    nome varchar(250) not null,
    email varchar(250) not null,
    senha varchar(250) not null,
    cpf char(14) not null
);

CREATE TABLE pedido (
	id int NOT NULL AUTO_INCREMENT,
	preco double NOT NULL,
	quantidade int NOT NULL,
	tipo_pagamento bit(1) NOT NULL,
	codigo varchar(250),
    id_usuario int,
    id_lanchonete int,
    status varchar(100),
    foreign key (id_usuario) references usuario(id),
	foreign key (id_lanchonete) references lanchonete(id),
	PRIMARY KEY (`id`)
);

create table lanchonete (
	id int primary key auto_increment,
    id_usuario int not null,
    nome varchar(250) not null,
    cnpj char(18) not null,
	titulo varchar(250) not null,
	descricao varchar(250) not null,
    foreign key (id_usuario) references usuario(id)
);

create table produto (
	id int primary key auto_increment,
    id_lanchonete int not null,
    categoria varchar(100) not null,
    preco decimal(10,4) not null,
    nome varchar(250) not null,
    foreign key (id_lanchonete) references lanchonete(id)
);