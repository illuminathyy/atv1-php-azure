# Atividade: Aplicação PHP com Banco de Dados Azure SQL

Este projeto é uma atividade prática para demonstrar a criação de um banco de dados na nuvem (Microsoft Azure), sua manipulação com SQL e o desenvolvimento de uma aplicação web em PHP para consumir esses dados.

## Objetivo

O objetivo é criar uma página web simples que se conecta a um banco de dados SQL Server hospedado no Azure e exibe os registros de uma tabela de clientes em uma tabela HTML com linhas de cores alternadas.

---

## Como Configurar o Banco na Azure

1.  **Criação do Recurso:** Acesse o portal da Microsoft Azure e crie um novo recurso do tipo "Banco de Dados SQL".
2.  **Configuração do Servidor:** Durante a criação, configure um novo servidor SQL, definindo um login e senha de administrador.
3.  **Firewall:** Nas configurações de rede do servidor SQL, adicione uma regra de firewall para permitir o acesso do seu endereço IP local e habilite a opção "Permitir que serviços e recursos do Azure acessem este servidor".
4.  **Execução do Script SQL:** Utilize o "Editor de Consultas" do portal para executar os comandos SQL presentes no arquivo `database.sql` deste repositório. Isso irá criar a tabela `Clientes` e inserir os 30 registros de teste.

---

## Como Executar a Aplicação PHP

**Pré-requisitos:**
* XAMPP instalado (ou outro ambiente com Apache e PHP).
* Drivers da Microsoft para PHP para SQL Server instalados e configurados no `php.ini`.
* Git instalado (para clonar este repositório).

**Passos para Execução:**

1.  **Clone o Repositório:**
    ```bash
    git clone [https://github.com/SEU_USUARIO/NOME_DO_SEU_REPOSITORIO.git](https://github.com/SEU_USUARIO/NOME_DO_SEU_REPOSITORIO.git)
    ```
    *Substitua a URL pela URL do seu repositório.*

2.  **Mova para o htdocs:** Mova a pasta clonada para o diretório `htdocs` do seu XAMPP (ex: `C:/xampp/htdocs/`).

3.  **Configure a Conexão:** Abra o arquivo `index.php` e insira suas credenciais do banco de dados Azure (servidor, nome do banco, usuário e senha) nas variáveis de conexão no início do script.

4.  **Inicie o Apache:** Inicie o servidor Apache através do painel de controle do XAMPP.

5.  **Acesse no Navegador:** Abra seu navegador e acesse a URL correspondente ao projeto (ex: `http://localhost/nome-da-pasta-do-projeto/`).

**Observação sobre o Erro:**
*O código PHP está funcional, mas encontrou um erro de conexão (`IM006 - Falha de SQLSetConnectAttr do driver`) relacionado à configuração do driver ODBC no ambiente local, que não foi resolvido a tempo da entrega. O erro indica uma falha na camada de comunicação entre o PHP e o SQL Server, provavelmente devido a uma incompatibilidade com os drivers ODBC instalados no sistema operacional.*