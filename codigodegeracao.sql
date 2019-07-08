

USE ecommerce_conectado;

CREATE TABLE categorias 
  ( 
     id_categoria INT NOT NULL PRIMARY KEY auto_increment, 
     descricao    VARCHAR(50) NOT NULL 
  ); 
select * from clientes;

CREATE TABLE fabricantes 
  ( 
     id_fabricante   INT NOT NULL PRIMARY KEY auto_increment, 
     nome_fabricante VARCHAR(50) NOT NULL 
  ); 
 
CREATE TABLE produto 
  ( 
     id_produto    INTEGER NOT NULL auto_increment, 
     descricao     VARCHAR(100) NOT NULL, 
     id_categoria  INT NOT NULL, 
     id_fabricante INT NOT NULL, 
     preco_custo   DECIMAL(10, 2), 
     preco_venda   DECIMAL(10, 2), 
     PRIMARY KEY(id_produto), 
     FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria), 
     FOREIGN KEY (id_fabricante) REFERENCES fabricantes(id_fabricante) 
  ); 

CREATE TABLE estoque 
  ( 
     id_produto        INT NOT NULL, 
     estoque_total     INT NOT NULL, 
     estoque_livre     INT, 
     estoque_reservado INT, 
     FOREIGN KEY (id_produto) REFERENCES produto(id_produto) 
  ); 

CREATE TABLE clientes 
  ( 
     id_cliente    INT NOT NULL PRIMARY KEY auto_increment, 
     nome          VARCHAR(32) NOT NULL, 
     sobrenome     VARCHAR(32) NOT NULL, 
     email         VARCHAR(60) NOT NULL, 
     senha         VARCHAR(32) NOT NULL, 
     data_nasc     DATE NOT NULL, 
     data_cadastro DATETIME NOT NULL, 
     ult_acesso    DATETIME, 
     ult_compra    DATETIME, 
     situacao      ENUM('A', 'B') NOT NULL -- A= Ativo B= Bloqueado 
  ); 

CREATE TABLE cliente_endereco 
  ( 
     id_endereco INT NOT NULL PRIMARY KEY auto_increment, 
     id_cliente  INT NOT NULL, 
     tipo        ENUM ('P', 'A') NOT NULL,-- P= principal A= Alternativo 
     endereco    VARCHAR(60) NOT NULL, 
     numero      VARCHAR(10) NOT NULL, 
     bairro      VARCHAR(30) NOT NULL, 
     cep         VARCHAR(8) NOT NULL, 
     id_cidade   INT NOT NULL, 
     FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente), 
     FOREIGN KEY (id_cidade) REFERENCES cidades(id_cidade) 
  ); 

CREATE TABLE cond_pagto 
  ( 
     id_pagto  INT NOT NULL PRIMARY KEY auto_increment, 
     descricao VARCHAR(50) NOT NULL, 
     tipo      ENUM ('C', 'D', 'B') NOT NULL 
  -- C= Cartao, D = debito , B= Boleto 
  ); 

CREATE TABLE cond_pagto_det 
  ( 
     id_pagto   INT NOT NULL, 
     parcela    INT NOT NULL, 
     percentual DECIMAL(10, 2) NOT NULL, 
     dias       INT NOT NULL, 
     FOREIGN KEY (id_pagto) REFERENCES cond_pagto(id_pagto) 
  ); 

CREATE TABLE pedidos 
  ( 
     num_pedido       INT NOT NULL PRIMARY KEY auto_increment, 
     id_cliente       INT NOT NULL, 
     id_endereco      INT NOT NULL, 
     id_pagto         INT NOT NULL, 
     total_prod       DECIMAL(10, 2), 
     total_frete      DECIMAL(10, 2), 
     total_desc       DECIMAL(10, 2), 
     total_pedido     DECIMAL(10, 2), 
     data_pedido      DATETIME NOT NULL, 
     previsao_entrega DATE, 
     efetiva_entrega  DATE, 
     status_ped       ENUM('A', 'S', 'F', 'T', 'E'), 
     -- A=aguard Aprov -- S=Separacao F=Faturado T= Em transito E= entregue 
     FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente), 
     FOREIGN KEY (id_endereco) REFERENCES cliente_endereco(id_endereco), 
     FOREIGN KEY (id_pagto) REFERENCES cond_pagto(id_pagto) 
  ); 
select * from pedidos;

CREATE TABLE pedido_itens 
  ( 
     num_pedido INT NOT NULL, 
     id_produto INT NOT NULL, 
     qtd        INT NOT NULL, 
     val_unit   DECIMAL(10, 2) NOT NULL, 
     desconto   DECIMAL(10, 2) NOT NULL, 
     total      DECIMAL(10, 2) NOT NULL, 
     FOREIGN KEY (num_pedido) REFERENCES pedidos(num_pedido), 
     FOREIGN KEY (id_produto) REFERENCES produto(id_produto) 
  ); 

CREATE TABLE nota_fiscal 
  ( 
     num_nota    INT NOT NULL PRIMARY KEY auto_increment, 
     num_ped_ref INT NOT NULL, 
     id_cliente  INT NOT NULL, 
     id_endereco INT NOT NULL, 
     id_pagto    INT NOT NULL, 
     total_prod  DECIMAL(10, 2), 
     total_frete DECIMAL(10, 2), 
     total_desc  DECIMAL(10, 2), 
     total_nf    DECIMAL(10, 2), 
     data_nf     DATETIME NOT NULL, 
     status_nf   ENUM('N', 'C', 'D'),-- N=Normal -- C=Cancelada D=Devolvida 
     id_user     VARCHAR(50), 
     FOREIGN KEY (num_ped_ref) REFERENCES pedidos(num_pedido), 
     FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente), 
     FOREIGN KEY (id_endereco) REFERENCES cliente_endereco(id_endereco), 
     FOREIGN KEY (id_pagto) REFERENCES cond_pagto_det(id_pagto) 
  -- foreign key (id_user) references usuarios(id_user) 
  ); 

CREATE TABLE nf_itens 
  ( 
     num_nota   INT NOT NULL, 
     id_produto INT NOT NULL, 
     qtd        INT NOT NULL, 
     val_unit   DECIMAL(10, 2) NOT NULL, 
     desconto   DECIMAL(10, 2) NOT NULL, 
     total      DECIMAL(10, 2) NOT NULL, 
     FOREIGN KEY (num_nota) REFERENCES nota_fiscal(num_nota), 
     FOREIGN KEY (id_produto) REFERENCES produto(id_produto) 
  ); 

CREATE TABLE nf_obs 
  ( 
     num_nota INT NOT NULL, 
     obs      VARCHAR(255) NOT NULL, 
     FOREIGN KEY (num_nota) REFERENCES nota_fiscal(num_nota) 
  ); 
 
CREATE TABLE carrinho_compras 
  ( 
     sessao          VARCHAR(32) NOT NULL, 
     id_produto      INT NOT NULL, 
     qtd             INT NOT NULL, 
     val_unit        DECIMAL(10, 2) NOT NULL, 
     desconto        DECIMAL(10, 2) NOT NULL, 
     total           DECIMAL(10, 2) NOT NULL, 
     data_hora_sessa DATETIME NOT NULL, 
     FOREIGN KEY (id_produto) REFERENCES produto(id_produto) 
  ); 

CREATE TABLE rastreabilidade 
  ( 
     num_pedido INT NOT NULL, 
     status_ped CHAR(1) NOT NULL, 
     -- A=aguard Aprov -- S=Separacao F=Faturado T= Em transito E= entregue 
     data_hora  DATETIME NOT NULL, 
     id_user    VARCHAR(50), 
     FOREIGN KEY (num_pedido) REFERENCES pedidos(num_pedido) 
  -- foreign key (id_user) references usuarios(id_user) 
  ); 

set @ano:=10;
set @data_cad=120;
 INSERT INTO CLIENTES (NOME,SOBRENOME,EMAIL,SENHA,Data_nasc,data_cadastro,situacao)
 SELECT A.FIRST_NAME,LAST_NAME,
       lower(concat(A.FIRST_NAME,a.LAST_NAME,'@meuemail.com'))email,
       -- essa parte é uma funcao que criptografa a senha
       md5(A.FIRST_NAME)as senha,
       DATE_ADD(a.LAST_UPDATE, INTERVAL -@ano:=@ano+1 year) data_nasc,
       DATE_ADD(a.LAST_UPDATE, INTERVAL +@data_cad:=@data_cad+1 month) data_cad,
       'A' situacao
       -- banco de dadso publico da microsoft "sakila"
 FROM SAKILA.ACTOR A
 limit 20;
-- verificando carga
desc clientes;
select * from clientes;

-- carga condicao e pagto

describe cond_pagto;

insert into cond_pagto (descricao,tipo) values ('A vista','B');
insert into cond_pagto (descricao,tipo) values ('A vista','D');
insert into cond_pagto (descricao,tipo) values ('10 X','C');
insert into cond_pagto (descricao,tipo) values ('5 X','C');
insert into cond_pagto (descricao,tipo) values ('3 X','C');

-- verificando carga
 select * from cond_pagto;

-- estrutura tabela tabela
describe cond_pagto_det;
-- carga detalhe pagto
-- condicao 1
insert into cond_pagto_det values (1,1,100,1);
-- condicao 2 
insert into cond_pagto_det values (2,1,100,1);

-- condicao 3
insert into cond_pagto_det values (3,1,10,30);
insert into cond_pagto_det values (3,2,10,60);
insert into cond_pagto_det values (3,3,10,90);
insert into cond_pagto_det values (3,4,10,120);
insert into cond_pagto_det values (3,5,10,150);
insert into cond_pagto_det values (3,6,10,180);
insert into cond_pagto_det values (3,7,10,210);
insert into cond_pagto_det values (3,8,10,240);
insert into cond_pagto_det values (3,9,10,270);
insert into cond_pagto_det values (3,10,10,300);

-- condicao 4
insert into cond_pagto_det values (4,1,20,30);
insert into cond_pagto_det values (4,2,20,60);
insert into cond_pagto_det values (4,3,20,90);
insert into cond_pagto_det values (4,4,20,120);
insert into cond_pagto_det values (4,5,20,150);

-- condicao 5
insert into cond_pagto_det values (5,1,33.33,30);
insert into cond_pagto_det values (5,2,33.33,60);
insert into cond_pagto_det values (5,3,33.34,90);


-- verificando cargas

-- carga de produtos
describe produto;

insert into produto (descricao,id_categoria,id_fabricante,preco_custo,preco_venda)
values
('Jogo Infantil',1,1,50,200),
('Jogo Acao',1,1,50,200),
('Jogo Estrategia',1,1,50,200);

insert into produto (descricao,id_categoria,id_fabricante,preco_custo,preco_venda)
values
('Smart Tv 42',2,2,1300,2000),
('Notebook 15',2,2,2200,3000),
('SmartPhone',2,2,550,1200);

insert into produto (descricao,id_categoria,id_fabricante,preco_custo,preco_venda)
values
('Caixa de Som BOOM',3,3,750,1500),
('Som automotivo',3,3,250,500),
('Sound MIX',3,3,750,1200);

insert into produto (descricao,id_categoria,id_fabricante,preco_custo,preco_venda)
values
('Geladeira',4,4,780,1580),
('Batedeira',4,4,200,450),
('Aspirador de Pó',4,4,200,4500);

-- verificando carga
select * from produto;

-- carga estoque


insert into estoque (id_produto,estoque_total,estoque_livre,estoque_reservado) values
				    ('1','100','100','0'),('2','100','100','0'),('3','100','100','0'),
                ('4','100','100','0'),('5','100','100','0'),('6','100','100','0'),
                ('7','100','100','0'),('8','100','100','0'),('9','100','100','0'),
                ('10','100','100','0'),('11','100','100','0'),('12','100','100','0');
                
--  verificando produtos estoque
select a.id_produto,a.descricao,a.preco_custo,a.preco_venda,
  b.nome_fabricante,c.descricao categoria,
  d.estoque_total as est_tot,d.estoque_livre as est_livre,d.estoque_reservado as est_reser
from
produto a
inner join fabricantes b
on a.id_fabricante=b.id_fabricante
inner join categorias c
on a.id_categoria=c.id_categoria
inner join estoque d
on a.id_produto=d.id_produto;

use mini_ec;

-- a trigger que criei
DELIMITER //
CREATE TRIGGER Tgr_insert_status_ped AFTER INSERT
ON pedidos
FOR EACH ROW
BEGIN
	insert into rastreabilidade values (new.num_pedido,new.status_ped,now(),user());
END//
DELIMITER ;

DELIMITER //
CREATE TRIGGER Tgr_update_status_ped AFTER UPDATE
ON pedidos
FOR EACH ROW
BEGIN
	insert into rastreabilidade values (new.num_pedido,new.status_ped,now(),user());
END//
DELIMITER ;

-- codigo das procedures (especificacao pede)
DELIMITER //
create procedure proc_carga_carrinho (v_sessao varchar(32),
                                      v_id_prod int,
                                      v_qtd int,
                                      OUT resposta VARCHAR(50))
main: begin
        DECLARE v_qtd_livre int;
        DECLARE v_preco_venda decimal(10,2);
        DECLARE cod_erro CHAR(5) DEFAULT '00000';
	     DECLARE msg TEXT;
	     DECLARE rows INT;
	     -- DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    	BEGIN
	      GET DIAGNOSTICS CONDITION 1
	      cod_erro = RETURNED_SQLSTATE, msg = MESSAGE_TEXT;
      END;
		
    
    -- Lendo qtd no estoque e atribuindo a variavel
    select estoque_Livre into v_qtd_livre from estoque
    where id_produto=v_id_prod;
    
    select v_qtd_livre;
    -- verificando se existe saldo disponivel
    IF v_qtd>v_qtd_livre then
    	SET resposta='Quantidade Indisponivel';
    LEAVE main;
	END IF;
    
    -- pegando preco de venda
    select preco_venda into v_preco_venda from unidade_federalproduto
    where id_produto=v_id_prod;
    -- carga no carrinho de compras
    -- inicia transacao
    START TRANSACTION;
    -- carregando carrinhos
    insert into carrinho_compras values 
      (md5(v_sessao),v_id_prod,v_qtd,v_preco_venda,0,v_qtd*v_preco_venda,now());
	
    -- atualizando disponibilidade estoque
   update estoque set estoque_livre=estoque_livre-v_qtd,
                      estoque_reservado=estoque_reservado+v_qtd
	where id_produto=v_id_prod;
    
-- checando excessao com IF

 IF cod_erro = '00000' THEN
    	  GET DIAGNOSTICS rows = ROW_COUNT;
		  SET resposta = CONCAT('Atualizacao com Sucesso  = ',rows);
          commit;
	ELSE
		SET resposta = CONCAT('Erro na atualizacao, error = ',cod_erro,', message = ',msg);
        rollback;
  END IF;
	
END//
DELIMITER ;

select * from carrinho_compras;
-- paramentros
-- v_sessao varchar(32),
-- v_id_prod int,
-- v_qtd int,
-- OUT resposta VARCHAR(50))

call proc_carga_carrinho(2,10,5,@resposta);
select * from carrinho_compras;
select * from estoque;
desc clientes;
desc sessao;
-- drop procedure proc_fecha_carrinho
-- fecha o carriho, gera pedido
DELIMITER //
create procedure proc_fecha_carrinho (v_sessao varchar(32),
                                      v_id_cliente int,
                                      v_id_pagto int,
                                      v_frete decimal(10,2), 
                                      v_ender char(1), -- P principal -- A alternativo
                                      OUT resposta VARCHAR(255))
main: begin
        DECLARE v_total_ped decimal(10,2);
        DECLARE v_total_desc decimal(10,2);
		  DECLARE v_num_ped int;
        DECLARE v_id_endereco int;
        DECLARE cod_erro CHAR(5) DEFAULT '00000';
	     DECLARE msg TEXT;
	     DECLARE rows INT;
	     DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    	BEGIN
		GET DIAGNOSTICS CONDITION 1
	      cod_erro = RETURNED_SQLSTATE, msg = MESSAGE_TEXT;
		END;
		
    
    -- Peganto tatol carrinho atribuindo a variavel
    select sum(total)as tot,sum(desconto) as descto into v_total_ped,v_total_desc
    from carrinho_compras
    where sessao=MD5(v_sessao);
    
    
    -- pegando emdereço cliente
    select id_endereco into v_id_endereco from cliente_endereco
    where id_cliente=v_id_cliente limit 1;
    -- carga no carrinho de compras
    -- inicia transacao
    START TRANSACTION;
    
     insert into pedidos 
     (id_cliente,id_endereco,id_pagto,total_prod,
                         total_frete,total_desc,total_pedido,data_pedido,status_ped)
				values 
      (v_id_cliente,v_id_endereco,v_id_pagto,v_total_ped,v_frete,v_total_desc,
              ((v_total_ped+v_frete)-v_total_desc),now(),'A');
              
	  -- pegando id do pedido
      set v_num_ped=LAST_INSERT_ID();
      -- inserindo pedido itens
      insert into pedido_itens
      (num_pedido,id_produto,qtd,val_unit,desconto,total)
      select v_num_ped,id_produto,qtd,val_unit,desconto,total
      from carrinho_compras
      where sessao=MD5(v_sessao);
      -- eliminando itens do carrinho
      delete from carrinho_compras
      where sessao=MD5(v_sessao);  

-- checando excessao com IF

 IF cod_erro = '00000' THEN
    	  GET DIAGNOSTICS rows = ROW_COUNT;
		  SET resposta = CONCAT('Atualizacao com Sucesso  = ',rows);
          commit;
	ELSE
		SET resposta = CONCAT('Erro na atualizacao, error = ',rows,cod_erro,', message = ',msg);
        rollback;
  END IF;

END//
DELIMITER ;


-- variaveis da procedure
-- v_sessao varchar(32),
-- v_id_cliente int,
-- v_id_pagto int,
-- v_frete decimal(10,2), 
-- v_ender char(1), -- P principal -- A alternativo
-- OUT resposta VARCHAR(50))
call proc_fecha_carrinho(1,1,3,9.00,'P');-- ,@resposta);
select @resposta;

call proc_fecha_carrinho(2,10,5,15.00,'P',@resposta);
select @resposta;

select * from carrinho_compras;
select * from estoque;
select * from pedidos;
select * from pedido_itens;
select * from rastreabilidade;

-- drop procedure proc_fat_pedido
-- fecha o carriho, gera pedido
	DELIMITER //
	create procedure proc_fat_pedido (v_num_ped int,
											  OUT resposta VARCHAR(255))
	main: begin
			DECLARE cod_erro CHAR(5) DEFAULT '00000';
			 DECLARE msg TEXT;
			DECLARE v_num_nf int;
			DECLARE v_qtd int;
			DECLARE v_id_prod int;
			 DECLARE rows INT;
			DECLARE EXIT HANDLER FOR SQLEXCEPTION
	   BEGIN
			GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE, 
			@nroerro = MYSQL_ERRNO, @msgerro = MESSAGE_TEXT;
			SET @msg_erro_completa = CONCAT("ERRO: ", @nroerro, " (", @sqlstate, "): ", @msgerro);
			SELECT @msg_erro_completa;
	  END; 

	  IF (select count(*) from pedidos where num_pedido=v_num_ped 
	  and status_ped in ('F','T','E'))>0 then
	  SET resposta='Pedido Ja Faturado';
			LEAVE main;
	  END IF;
		-- inicia a transacao
		START TRANSACTION;
		
		-- lendo pedido e inserindo nfe
		insert into nota_fiscal (num_ped_ref,id_cliente,id_endereco,id_pagto,
								 total_prod,total_frete,total_desc,total_nf,
								 data_nf,status_nf,id_user)
		select num_pedido,id_cliente,id_endereco,id_pagto,total_prod,total_frete,
			   total_desc,total_pedido,now(),'N',user()
		from pedidos
		where num_pedido=v_num_ped;
		-- pegando numero da nfe
		set v_num_nf=LAST_INSERT_ID();
		
		-- lendo pedido itens e inserindo nota itens
		
		  insert into nf_itens
		  (num_nota,id_produto,qtd,val_unit,desconto,total)
		  select v_num_nf,id_produto,qtd,val_unit,desconto,total
		  from pedido_itens
		  where num_pedido=v_num_ped;
		
		-- Atualizando status ped
		  UPDATE PEDIDOS SET status_ped='F'
		   where num_pedido=v_num_ped;
		  
	-- atualizando estoque
		-- atualizando estoque,
	 
		UPDATE estoque
			INNER JOIN
		pedido_itens 
			ON estoque.id_produto = pedido_itens.id_produto 
	SET estoque.estoque_total = estoque.estoque_total - pedido_itens.qtd,
		estoque.estoque_reservado = estoque.estoque_reservado - pedido_itens.qtd
	WHERE
		pedido_itens.num_pedido = v_num_ped;
		
	-- checando excessao com IF

	 IF cod_erro = '00000' THEN
			  GET DIAGNOSTICS rows = ROW_COUNT;
			  SET resposta = CONCAT('Atualizacao com Sucesso  = ',rows);
			  commit;
		ELSE
			SET resposta = CONCAT('Erro na atualizacao, error = ',rows,cod_erro,', message = ',msg);
			rollback;
	  END IF;
	   
	  select concat('resposta ',resposta)
	  union all
	  SELECT concat('cod_erro ',cod_erro);
		
	END//
	DELIMITER ;


-- variaveis da procedure
-- v_pedido
-- OUT resposta VARCHAR(50))
call proc_fat_pedido(2,@resposta);
select @resposta;

select * from carrinho_compras;
select * from estoque;
select * from pedidos;
select * from pedido_itens;
select * from rastreabilidade order by 1;
select * from nota_fiscal;
select * from nf_itens;


create view v_financeiro
as
select a.num_nota,
       a.id_cliente,
       d.nome,
		 a.id_pagto,
		 b.descricao,
		 b.tipo,
       a.total_nf,
		 a.data_nf,
		 c.parcela,
		 c.percentual,
		 c.dias,
		 cast(a.total_nf/100*c.percentual as decimal(10,2)) valor_parcela,
		 cast(date_add(a.data_nf,interval c.dias day) as date) vencimento
from nota_fiscal a
inner join cond_pagto b
on a.id_pagto=b.id_pagto
inner join cond_pagto_det c
on a.id_pagto=b.id_pagto
and a.id_pagto=c.id_pagto
inner join clientproduto_caracteres d
on a.id_cliente=d.id_cliente
where a.status_nf='N';

-- view



desc pedidos;

-- Cinco consultas em Álgebra relacional, onde cada consulta envolva pelo menos 3 tabelas. 
-- 1
create view v_financeiro
as
select a.num_nota,
       a.id_cliente,
		 a.id_pagto,
		 b.descricao,
		 b.tipo,
       a.total_nf,
		 a.data_nf,
		 c.parcela,
		 c.percentual,
		 c.dias,
		 cast(a.total_nf/100*c.percentual as decimal(10,2)) valor_parcela,
		 cast(date_add(a.data_nf,interval c.dias day) as date) vencimento
from nota_fiscal a
inner join cond_pagto b
on a.id_pagto=b.id_pagto
inner join cond_pagto_det c
on a.id_pagto=b.id_pagto
and a.id_pagto=c.id_pagto
where a.status_nf='N';

 select * from v_financeiro;

-- 2  verificando produtos estoque
select a.id_produto,a.descricao,a.preco_custo,a.preco_venda,
  b.nome_fabricante,c.descricao categoria,
  d.estoque_total as est_tot,d.estoque_livre as est_livre,d.estoque_reservado as est_reser
from
produto a
inner join fabricantes b
on a.id_fabricante=b.id_fabricante
inner join categorias c
on a.id_categoria=c.id_categoria
inner join estoque d
on a.id_produto=d.id_produto;

-- 3 -- verificando cadastrados
select a.id_produto,a.descricao,a.preco_custo,a.preco_venda,
  b.nome_fabricante,c.descricao categoria
from
produto a
inner join fabricantes b
on a.id_fabricante=b.id_fabricante
inner join categorias c
on a.id_categoria=c.id_categoria;

-- 4 Clientes com seus pedidos e detalhes sobre os itens
select b.nome, b.email, a.total_prod, a.data_pedido, c.val_unit ,c.qtd
from pedidos a
inner join clientes b 
on a.id_cliente = b.id_cliente
inner join pedido_itens c
on a.num_pedido = c.num_pedido;

-- 5 Relacao do estoque
select a.id_produto, a.preco_custo, b.nome_fabricante, c.estoque_total, c.estoque_livre
from produto a 
inner join fabricantes b
on a.id_fabricante = b.id_fabricante
inner join estoque c
on a.id_produto = c.id_produto
where c.estoque_livre > 55;


-- SELECT 'mysql' dbms,t.TABLE_SCHEMA,t.TABLE_NAME,c.COLUMN_NAME,c.ORDINAL_POSITION,c.DATA_TYPE,c.CHARACTER_MAXIMUM_LENGTH,n.CONSTRAINT_TYPE,k.REFERENCED_TABLE_SCHEMA,k.REFERENCED_TABLE_NAME,k.REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.TABLES t LEFT JOIN INFORMATION_SCHEMA.COLUMNS c ON t.TABLE_SCHEMA=c.TABLE_SCHEMA AND t.TABLE_NAME=c.TABLE_NAME LEFT JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE k ON c.TABLE_SCHEMA=k.TABLE_SCHEMA AND c.TABLE_NAME=k.TABLE_NAME AND c.COLUMN_NAME=k.COLUMN_NAME LEFT JOIN INFORMATION_SCHEMA.TABLE_CONSTRAINTS n ON k.CONSTRAINT_SCHEMA=n.CONSTRAINT_SCHEMA AND k.CONSTRAINT_NAME=n.CONSTRAINT_NAME AND k.TABLE_SCHEMA=n.TABLE_SCHEMA AND k.TABLE_NAME=n.TABLE_NAME WHERE t.TABLE_TYPE='BASE TABLE' AND t.TABLE_SCHEMA NOT IN('INFORMATION_SCHEMA','mysql','performance_schema');

-- 6 estoque--fabricante/processo de normalizacao (prints)
SELECT a.id_produto, a.descricao ,a.preco_custo,a.preco_venda,b.id_categoria, b.descricao  , c.estoque_total, c.estoque_livre,c.estoque_reservado,d.id_fabricante, d.nome_fabricante
,e.num_pedido, e.qtd, e.val_unit, e.desconto,e.total
from produto a 
inner join categorias b
on a.id_categoria = b.id_categoria
inner join estoque c
on a.id_produto = c.id_produto
inner join fabricantes d
on a.id_fabricante = d.id_fabricante
inner join pedido_itens e
on a.id_produto = e.id_produto;

-- 7 processo de normalizacao (prints)
SELECT a.id_produto, a.descricao ,a.preco_custo,a.preco_venda,c.estoque_total, c.estoque_livre,c.estoque_reservado,e.num_pedido, e.qtd, e.val_unit, e.desconto,e.total
from produto a
inner join estoque c
on a.id_produto = c.id_produto
inner join pedido_itens e
on a.id_produto = e.id_produto;

select * from fabricantes;
select * from categorias;

select * from estoque;

select a.id_produto, b.num_pedido, b.qtd, b.val_unit, b.desconto, b.total  
from produto a
inner join pedido_itens b
on a.id_produto = b.id_produto;

select * from produto;

 




