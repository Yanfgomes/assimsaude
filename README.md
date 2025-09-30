# assimsaude
Código criado para etapa do processo seletivo

📌 Projeto MVC em PHP

Este projeto é um exemplo básico de aplicação PHP seguindo o padrão MVC (Model-View-Controller).
Ele utiliza XAMPP como servidor local e MySQL como banco de dados.

🚀 Tecnologias utilizadas

PHP → Linguagem principal do projeto

XAMPP → Ambiente local que fornece Apache (servidor web) e MySQL (banco de dados)

MySQL → Banco de dados relacional usado para persistência das informações

⚙️ Pré-requisitos

Antes de rodar o projeto, você precisa ter instalado em sua máquina:

XAMPP

Instala Apache + MySQL + PHP juntos.

Recomendado instalar na pasta padrão C:\xampp.

🔧 Configuração do banco de dados

Inicie o XAMPP Control Panel e ative:
✅ Apache
✅ MySQL

Depois crie um novo banco de dados chamado "assimsaude" e importe o arquivo assimsaude.sql para gerar as tabelas

▶️ Como rodar o projeto

Copie a pasta do projeto para dentro de:
C:\xampp\htdocs\

Acesse no navegador:
http://localhost/assim_saude/home

Agora o sistema estará rodando 🚀

✅ Recursos implementados

Estrutura MVC organizada (Models, Views, Controllers)
Rotas amigáveis via .htaccess
CRUD básico em MySQL com PDO
Sistema de mensagens de sessão (flash messages)
Suporte a CSRF Token para formulários
