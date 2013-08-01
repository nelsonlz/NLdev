-- DROP TABLE  CdBoletoNovo.Cd_Cliente;
Create table if not exists CdBoletoNovo.Cd_Cliente(ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
                                                                    Contratante_id integer not null,
                                                                     Empresa_id     integer,
                                                                     Filial_id integer,
                                                                     Nome VARCHAR(40) NOT NULL,
                                                                     CPF_CNPJ VARCHAR(24) NOT NULL,
                                                                     RG_IE VARCHAR(24) NOT NULL,
                                                                     CEP VARCHAR(12),
                                                                     Endereco VARCHAR(40),
                                                                     Bairro VARCHAR(40),
                                                                     Cidade     VARCHAR(40),
                                                                     UF VARCHAR(2),
                                                                     Telefone varchar(24),
                                                                     Telefone2 VARCHAR(24),
                                                                     Email VARCHAR(100)
);
                                                                  
-- DROP TABLE IF EXISTS CdBoletoNovo.Cd_Lib;
Create table if not exists CdBoletoNovo.Cd_Cliente(Contratante_id integer not null,
                                                                                     NumeroSerie integer not null

);

-- DROP TABLE IF EXISTS CdBoletoNovo.Cd_Empresa;
Create table if not exists CdBoletoNovo.Cd_Empresa(ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
                                                                                         Contratante_id integer not null,
                                                                                         Nome  varchar(40) not null,
                                                                                         CNPJ varchar(24) not null,
                                                                                         CEP varchar(12),
                                                                                         Endereco varchar(40),
                                                                                         Bairro varchar(40),
                                                                                         Cidade varchar(40),
                                                                                         UF varchar(2),
                                                                                         Telefone varchar(24),
                                                                                         Telefone2 varchar(24),
                                                                                         Email varchar(100)
 );

DROP TABLE IF EXISTS CdBoletoNovo.Cd_Boleto;
Create table if not exists CdBoletoNovo.Cd_Boleto(ID INTEGER NOT NULL , 
                                                                                            Contratante_id integer not null, 
                                                                                            Empresa_id integer not null,
                                                                                            Filial_id integer not null,
                                                                                            Cliente_id integer not null,
                                                                                            Conta_id integer not null,
                                                                                            Vencimento date not null,
                                                                                            Emissao  date,
                                                                                            Consulta date,
                                                                                            ValorNominal float not null,
                                                                                            ValorPago float, 
                                                                                            Desconto float,
                                                                                            Detalhe TEXT,
                                                                                            EnvioEmail date,
                                                                                            DataPagamento date,
                                                                                            aLink varchar(100) PRIMARY KEY
);

-- DROP TABLE IF EXISTS CdBoletoNovo.Cd_Conta;
Create table if not exists CdBoletoNovo.Cd_Conta(ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
                                                                                    Contratante_id integer not null,
                                                                                    Empresa_id integer not null,
                                                                                    Filial_id integer not null,
                                                                                    Banco_id integer not null,
                                                                                    Agencia integer,
                                                                                    DgAgencia integer,
                                                                                    CC integer,
                                                                                    DgCC integer,
                                                                                    CodCedente integer,
                                                                                    DgCodCedente integer,
                                                                                    NumeroConvenio integer,
                                                                                    TipoConvenio integer,
                                                                                    NumeroCarteira integer,
                                                                                    NumeroAplicativo integer,
                                                                                    CodigoMoeda integer,
                                                                                    Modalidade varchar(2),
                                                                                    Aceite varchar(2),  
                                                                                    Especie varchar(3),
                                                                                    Mulda float,
                                                                                    Juros float,
                                                                                    Instrucoes text
);

-- DROP TABLE IF EXISTS CdBoletoNovo.Cd_Filial;
Create table if not exists CdBoletoNovo.Cd_Filial(ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
                                                                                          Contratante_id integer not null,
                                                                                          Empresa_id integer not null,
                                                                                          CNPJ varchar(24),
                                                                                          CEP varchar(12),
                                                                                          Endereco varchar(40),
                                                                                          Bairro varchar(40),
                                                                                          Cidade varchar(40),
                                                                                          UF varchar(2),
                                                                                          Telefone varchar(24),
                                                                                          Telefone2 varchar(24),
                                                                                          Email varchar(100)
);

-- DROP TABLE IF EXISTS CdBoletoNovo.Cd_Banco;
Create table if not exists CdBoletoNovo.Cd_Banco(ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
                                                                                            NumeroBancoCentral varchar(4) not null,
                                                                                            NomeBancoCentral varchar(40),
                                                                                            NomeReduzido varchar(20),
                                                                                            aLogo varchar(40)
);

-- insert into CdBoletoNovo.Cd_Banco(NumeroBancoCentral,NomeBancoCentral,NomeReduzido,aLogo) values("001","Banco do Brasil","BB","logobb.jpg");
-- insert into CdBoletoNovo.Cd_Banco(NumeroBancoCentral,NomeBancoCentral,NomeReduzido,aLogo) values("104","Caixa Economica Federal","Caixa","logocaixa.jpg");
-- insert into CdBoletoNovo.Cd_Banco(NumeroBancoCentral,NomeBancoCentral,NomeReduzido,aLogo) values("341","Itau","Itau","logoitau.jpg");
