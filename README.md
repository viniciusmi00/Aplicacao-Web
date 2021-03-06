# Aplicação Web

Aplicação Web e Mobile utilizando Web Service RESTFul, Restify e banco de dados MySQL.  
Middleware: restify-cors-middleware.  
Restify: Servidor para prover as rotas da aplicação.

1° - Instalar o Node LTS direto do site: https://nodejs.org<br /><br />

2° - Terminal: 
```Bash
npm install
```

*Caso tenha pegado todos os arquivos deste projeto no Github e esteja na pasta raiz do projeto, e não na pasta WebServices-RESTful, execute o seguinte comando no terminal antes de npm install:

Terminal:
```Bash
cd ./WebServices-RESTful
```

*Caso queira atualizar todas as dependencias do projeto:

Terminal: 
```Bash
npm update
```

> Eslint serve para padronizar a escrita de códigos, gerando códigos mais bonitos e com menos variação na escrita.

> Pode pular a etapa 3 caso não queira instalar o eslint.

3° - Terminal: 
```Bash
sudo ./node_modules/.bin/eslint --init


Selecionar: Use a popular style guid

Selecionar: Standard

Selecionar: JSON, Selecionar Yes Install
```

4° - Instalar nodemon (reinicia o servidor node automaticamente toda vez que salvar o projeto).

Terminal: 
```Bash
npm i -g nodemon
```

5° - Instalar restify-cors-middleware

Terminal: 
```Bash
npm i --save-dev restify-cors-middleware
```

6° - Duplicar o arquivo .env.example, renomear para .env e colocar as informações de conexão com o MySQL.

7° - Rodar a aplicação.

Terminal
```Bash
npm run dev
```

# Testes

Solução utilizaça: AVA - JavaScript Test Runner

[AVA](https://github.com/avajs/ava "Github AVA - JavaScript Test Runner")