DROP TABLE IF EXISTS contasapagar;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `contasapagar` AS select extract(year_month from `f`.`datavencimento`) AS `MesAno`,year(`f`.`datavencimento`) AS `year`,date_format(`f`.`datavencimento`,'%M') AS `month`,`fd`.`Razao` AS `fornecedor`,format(sum(`f`.`valorPr`),2,'de_DE') AS `soma` from (((((`fatura` `f` join `loja` `lj`) join `fornecedor` `fd`) join `prazo` `pz`) join `operador` `op`) join `situacao` `st`) where `f`.`Operador_id` = `op`.`id` and `f`.`Fornecedor_id` = `fd`.`id` and `f`.`prazo_id` = `pz`.`id` and `f`.`Situacao_id` = `st`.`id` and `f`.`Loja_id` = `lj`.`id` and `f`.`Situacao_id` = 1 or `f`.`Operador_id` = `op`.`id` and `f`.`Fornecedor_id` = `fd`.`id` and `f`.`prazo_id` = `pz`.`id` and `f`.`Situacao_id` = `st`.`id` and `f`.`Loja_id` = `lj`.`id` and `f`.`Situacao_id` = 4 or `f`.`Operador_id` = `op`.`id` and `f`.`Fornecedor_id` = `fd`.`id` and `f`.`prazo_id` = `pz`.`id` and `f`.`Situacao_id` = `st`.`id` and `f`.`Loja_id` = `lj`.`id` and `f`.`Situacao_id` = 7 group by extract(year_month from `f`.`datavencimento`),`fd`.`Razao` order by extract(year_month from `f`.`datavencimento`);

INSERT INTO contasapagar VALUES("202006","2020","June","CONEXÃO IMPORTADORA EIRELI","1.540,00");
INSERT INTO contasapagar VALUES("202006","2020","June","MARTELLI IMPORTADOS","7.254,44");
INSERT INTO contasapagar VALUES("202007","2020","July","BOX DROUBLE IMPORTADORA","643,86");
INSERT INTO contasapagar VALUES("202007","2020","July","MARTELLI IMPORTADOS","3.750,00");
INSERT INTO contasapagar VALUES("202007","2020","July","SIMPLES NACIONAL","6.000,00");
INSERT INTO contasapagar VALUES("202008","2020","August","BOX DROUBLE IMPORTADORA","643,86");
INSERT INTO contasapagar VALUES("202008","2020","August","MARTELLI IMPORTADOS","6.750,00");
INSERT INTO contasapagar VALUES("202008","2020","August","SIMPLES NACIONAL","6.000,00");
INSERT INTO contasapagar VALUES("202009","2020","September","BOX DROUBLE IMPORTADORA","643,86");
INSERT INTO contasapagar VALUES("202009","2020","September","MARTELLI IMPORTADOS","6.750,00");
INSERT INTO contasapagar VALUES("202009","2020","September","SIMPLES NACIONAL","6.000,00");
INSERT INTO contasapagar VALUES("202010","2020","October","BOX DROUBLE IMPORTADORA","643,86");
INSERT INTO contasapagar VALUES("202010","2020","October","MARTELLI IMPORTADOS","3.750,00");
INSERT INTO contasapagar VALUES("202010","2020","October","SIMPLES NACIONAL","6.000,00");
INSERT INTO contasapagar VALUES("202011","2020","November","BOX DROUBLE IMPORTADORA","300,00");
INSERT INTO contasapagar VALUES("202011","2020","November","SIMPLES NACIONAL","6.000,00");



DROP TABLE IF EXISTS contaspg;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `contaspg` AS select extract(year_month from `f`.`datavencimento`) AS `MesAno`,year(`f`.`datavencimento`) AS `year`,date_format(`f`.`datavencimento`,'%M') AS `month`,`fd`.`Razao` AS `fornecedor`,sum(`f`.`valorPr`) AS `soma` from (((((`fatura` `f` join `loja` `lj`) join `fornecedor` `fd`) join `prazo` `pz`) join `operador` `op`) join `situacao` `st`) where `f`.`Operador_id` = `op`.`id` and `f`.`Fornecedor_id` = `fd`.`id` and `f`.`prazo_id` = `pz`.`id` and `f`.`Situacao_id` = `st`.`id` and `f`.`Loja_id` = `lj`.`id` and `f`.`Situacao_id` = 1 or `f`.`Operador_id` = `op`.`id` and `f`.`Fornecedor_id` = `fd`.`id` and `f`.`prazo_id` = `pz`.`id` and `f`.`Situacao_id` = `st`.`id` and `f`.`Loja_id` = `lj`.`id` and `f`.`Situacao_id` = 4 or `f`.`Operador_id` = `op`.`id` and `f`.`Fornecedor_id` = `fd`.`id` and `f`.`prazo_id` = `pz`.`id` and `f`.`Situacao_id` = `st`.`id` and `f`.`Loja_id` = `lj`.`id` and `f`.`Situacao_id` = 7 group by extract(year_month from `f`.`datavencimento`),`fd`.`Razao` order by extract(year_month from `f`.`datavencimento`);

INSERT INTO contaspg VALUES("202006","2020","June","CONEXÃO IMPORTADORA EIRELI","1540");
INSERT INTO contaspg VALUES("202006","2020","June","MARTELLI IMPORTADOS","7254.4400000000005");
INSERT INTO contaspg VALUES("202007","2020","July","BOX DROUBLE IMPORTADORA","643.86");
INSERT INTO contaspg VALUES("202007","2020","July","MARTELLI IMPORTADOS","3750");
INSERT INTO contaspg VALUES("202007","2020","July","SIMPLES NACIONAL","6000");
INSERT INTO contaspg VALUES("202008","2020","August","BOX DROUBLE IMPORTADORA","643.86");
INSERT INTO contaspg VALUES("202008","2020","August","MARTELLI IMPORTADOS","6750");
INSERT INTO contaspg VALUES("202008","2020","August","SIMPLES NACIONAL","6000");
INSERT INTO contaspg VALUES("202009","2020","September","BOX DROUBLE IMPORTADORA","643.86");
INSERT INTO contaspg VALUES("202009","2020","September","MARTELLI IMPORTADOS","6750");
INSERT INTO contaspg VALUES("202009","2020","September","SIMPLES NACIONAL","6000");
INSERT INTO contaspg VALUES("202010","2020","October","BOX DROUBLE IMPORTADORA","643.86");
INSERT INTO contaspg VALUES("202010","2020","October","MARTELLI IMPORTADOS","3750");
INSERT INTO contaspg VALUES("202010","2020","October","SIMPLES NACIONAL","6000");
INSERT INTO contaspg VALUES("202011","2020","November","BOX DROUBLE IMPORTADORA","300");
INSERT INTO contaspg VALUES("202011","2020","November","SIMPLES NACIONAL","6000");



DROP TABLE IF EXISTS fatura;

CREATE TABLE `fatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Loja_id` int(11) NOT NULL,
  `Operador_id` int(11) NOT NULL,
  `Fornecedor_id` int(11) NOT NULL,
  `prazo_id` int(11) NOT NULL,
  `Situacao_id` int(11) NOT NULL,
  `notafiscal` varchar(45) DEFAULT NULL,
  `datacompra` date DEFAULT NULL,
  `datavencimento` date DEFAULT NULL,
  `datapgto` date DEFAULT NULL,
  `total` double DEFAULT NULL,
  `valorPr` double DEFAULT NULL,
  `dtbaixa` date DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `numPr` int(11) NOT NULL,
  `duplicata` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `juro` double DEFAULT 0,
  PRIMARY KEY (`id`,`Loja_id`,`Operador_id`,`Fornecedor_id`,`prazo_id`,`Situacao_id`),
  KEY `Loja_id` (`Loja_id`),
  KEY `Operador_id` (`Operador_id`),
  KEY `Fornecedor_id` (`Fornecedor_id`),
  KEY `prazo_id` (`prazo_id`),
  KEY `Situacao_id` (`Situacao_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2241 DEFAULT CHARSET=latin1;

INSERT INTO fatura VALUES("2210","14","7","21","30","2","123456","2020-06-02","2020-06-12","2020-06-02","1500","1500","2020-06-02","FORNECEDOR DE MATERIAIS DE INFORMÁTICA","1","123456/A","Titulo","0");
INSERT INTO fatura VALUES("2211","15","7","23","29","2","78910","2020-06-01","2020-06-02","2020-06-02","15000","3000","2020-06-02","","1","78910/1","Titulo","0");
INSERT INTO fatura VALUES("2212","15","7","23","29","1","78910","2020-06-01","2020-06-01","","15000","3000","","","2","78910/2","Titulo","0");
INSERT INTO fatura VALUES("2213","15","7","23","29","1","78910","2020-06-01","2020-08-30","","15000","3000","","","3","78910/3","Titulo","0");
INSERT INTO fatura VALUES("2214","15","7","23","29","1","78910","2020-06-01","2020-09-29","","15000","3000","","","4","78910/4","Titulo","0");
INSERT INTO fatura VALUES("2215","15","7","23","29","1","78910","2020-06-01","2020-06-02","","15000","3000","","","5","78910/5","Titulo","0");
INSERT INTO fatura VALUES("2216","14","7","24","30","2","12544888777","2020-05-22","2020-06-01","2020-06-02","17000","17000","2020-06-02","","1","12544888777","Imposto","0");
INSERT INTO fatura VALUES("2217","14","7","22","28","1","NEGOCIAÇÃO","2020-06-19","2020-07-19","","1250","312.5","","","1","","Titulo","0");
INSERT INTO fatura VALUES("2218","14","7","22","28","1","NEGOCIAÇÃO","2020-06-19","2020-08-18","","1250","312.5","","","2","","Titulo","0");
INSERT INTO fatura VALUES("2219","14","7","22","28","1","NEGOCIAÇÃO","2020-06-19","2020-09-17","","1250","312.5","","","3","","Titulo","0");
INSERT INTO fatura VALUES("2220","14","7","22","28","1","NEGOCIAÇÃO","2020-06-19","2020-10-17","","1250","312.5","","","4","","Titulo","0");
INSERT INTO fatura VALUES("2221","15","7","24","29","1","125050","2020-06-19","2020-07-19","","30000","6000","","","1","","Titulo","0");
INSERT INTO fatura VALUES("2222","15","7","24","29","1","125050","2020-06-19","2020-08-18","","30000","6000","","","2","","Titulo","0");
INSERT INTO fatura VALUES("2223","15","7","24","29","1","125050","2020-06-19","2020-09-17","","30000","6000","","","3","","Titulo","0");
INSERT INTO fatura VALUES("2224","15","7","24","29","1","125050","2020-06-19","2020-10-17","","30000","6000","","","4","","Titulo","0");
INSERT INTO fatura VALUES("2225","15","7","24","29","1","125050","2020-06-19","2020-11-16","","30000","6000","","","5","","Titulo","0");
INSERT INTO fatura VALUES("2226","15","7","22","29","1","123456","2020-06-19","2020-07-19","","1500","300","","","1","","Imposto","0");
INSERT INTO fatura VALUES("2227","15","7","22","29","1","123456","2020-06-19","2020-08-18","","1500","300","","","2","","Imposto","0");
INSERT INTO fatura VALUES("2228","15","7","22","29","1","123456","2020-06-19","2020-09-17","","1500","300","","","3","","Imposto","0");
INSERT INTO fatura VALUES("2229","15","7","22","29","1","123456","2020-06-19","2020-10-17","","1500","300","","","4","","Imposto","0");
INSERT INTO fatura VALUES("2230","15","7","22","29","1","123456","2020-06-19","2020-11-16","","1500","300","","","5","","Imposto","0");
INSERT INTO fatura VALUES("2231","15","7","23","28","1","NEGOCIAÇÃO","2020-06-20","2020-07-20","","15000","3750","","","1","","Titulo","0");
INSERT INTO fatura VALUES("2232","15","7","23","28","1","NEGOCIAÇÃO","2020-06-20","2020-08-19","","15000","3750","","","2","","Titulo","0");
INSERT INTO fatura VALUES("2233","15","7","23","28","1","NEGOCIAÇÃO","2020-06-20","2020-09-18","","15000","3750","","","3","","Titulo","0");
INSERT INTO fatura VALUES("2234","15","7","23","28","1","NEGOCIAÇÃO","2020-06-20","2020-10-18","","15000","3750","","","4","","Titulo","0");
INSERT INTO fatura VALUES("2235","15","7","22","28","1","123","2020-06-20","2020-07-20","","125.44","31.36","","","1","","Titulo","0");
INSERT INTO fatura VALUES("2236","15","7","22","28","1","123","2020-06-20","2020-08-19","","125.44","31.36","","","2","","Titulo","0");
INSERT INTO fatura VALUES("2237","15","7","22","28","1","123","2020-06-20","2020-09-18","","125.44","31.36","","","3","","Titulo","0");
INSERT INTO fatura VALUES("2238","15","7","22","28","1","123","2020-06-20","2020-10-18","","125.44","31.36","","","4","","Titulo","0");
INSERT INTO fatura VALUES("2239","14","7","23","30","1","123","2020-06-20","2020-06-30","","1254.44","1254.44","","","1","","Titulo","0");
INSERT INTO fatura VALUES("2240","15","7","21","30","1","1725","2020-06-20","2020-06-30","","1540","1540","","testo","1","","Imposto","0");



DROP TABLE IF EXISTS fornecedor;

CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Razao` varchar(100) DEFAULT NULL,
  `Telefone` varchar(14) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

INSERT INTO fornecedor VALUES("21","CONEXÃO IMPORTADORA EIRELI","61995295577","01020304050607");
INSERT INTO fornecedor VALUES("22","BOX DROUBLE IMPORTADORA","61995295579","88888888888888");
INSERT INTO fornecedor VALUES("23","MARTELLI IMPORTADOS","61995295578","77777777777777");
INSERT INTO fornecedor VALUES("24","SIMPLES NACIONAL","","SIMPLES NACIONAL");



DROP TABLE IF EXISTS loja;

CREATE TABLE `loja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razao` varchar(100) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO loja VALUES("15","FILIAL 01","36547896521214");
INSERT INTO loja VALUES("14","LOJA MATRIZ","12345678910112");



DROP TABLE IF EXISTS operador;

CREATE TABLE `operador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO operador VALUES("8","FULANO DE TAL","78911236545","e10adc3949ba59abbe56e057f20f883e");
INSERT INTO operador VALUES("7","usuário teste","123","202cb962ac59075b964b07152d234b70");



DROP TABLE IF EXISTS prazo;

CREATE TABLE `prazo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  `diasDif` int(11) DEFAULT NULL,
  `qtdePr` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

INSERT INTO prazo VALUES("28","30/60/90/120","30","4");
INSERT INTO prazo VALUES("29","30/60/90/120/150","30","5");
INSERT INTO prazo VALUES("30","10 DIAS","10","1");



DROP TABLE IF EXISTS situacao;

CREATE TABLE `situacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stattus` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO situacao VALUES("1","Em aberto");
INSERT INTO situacao VALUES("2","Pago");
INSERT INTO situacao VALUES("3","Cancelado");
INSERT INTO situacao VALUES("4","Negociado");
INSERT INTO situacao VALUES("7","Protestado");



