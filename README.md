Aplicação Web

Aplicação Web e Mobile utilizando Web Service RESTFul, Restify e banco de dados MySQL.
Middleware: restify-cors-middleware.
Restify: Servidor para prover as rotas da aplicação.

1° - Instalar o Node LTS direto do site: https://nodejs.org<br /><br />

2° - Terminal: npm install

*Caso tenha pegado todos os arquivos deste projeto no Github e esteja na pasta raiz do projeto, e não na pasta WebServices-RESTful, execute o seguinte comando no terminal antes de npm install:

Terminal: cd ./WebServices-RESTful

*Caso queira atualizar todas as dependencias do projeto:

Terminal: npm update<br /> <br />

*** Eslint serve para padronizar a escrita de códigos, gerando códigos mais bonitos e com menos variação na escrita. ***
*** Pode pular a etapa 3 caso não queira instalar o eslint. ***

3° - Terminal: sudo ./node_modules/.bin/eslint --init

Selecionar: Use a popular style guid

Selecionar: Standard

Selecionar: JSON, Selecionar Yes Install<br /><br />

4° - Instalar nodemon (reinicia o servidor node automaticamente toda vez que salvar o projeto).

Terminal: npm i -g nodemon<br /><br />

5° - Instalar restify-cors-middleware

Terminal: npm i --save-dev restify-cors-middleware<br /><br />

6° - Duplicar o arquivo .env.example, renomear para .env e colocar as informações de conexão com o MySQL.

Terminal: npm run dev<br /><br />

7° - Rodar a aplicação.

Terminal: npm run dev
