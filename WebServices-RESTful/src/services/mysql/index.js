
const mysqlServer = require('mysql') // Constante para o módulo MySQL.

const connection = mysqlServer.createConnection({ // Conexão para conectar o MySQL passando o objeto de configuração.
  host: process.env.MYSQL_HOST, // Local a ser conectado.
  user: process.env.MYSQL_USER, // Usuário para login da conexão.
  password: process.env.MYSQL_PASSWORD, // Senha para login da conexão.
  database: process.env.MYSQL_DATABASE, // Database que será conextado.
  port: process.env.MYSQL_PORT
})

const errorHandler = (error, msg, rejectFunction) =>{
    if (error) console.error(error) // Faz o console error do errorHandler. Pode até mandar para um serviço externo de Logs.
    rejectFunction({ error: msg })// Executa o reject que veio da Promise, passando a mensagem de erro. Vai para o Catch de routes.js
}

const categoryModule = require('./categories')({ connection, errorHandler })
const usersModule = require('./users')({ connection, errorHandler })
const authModule = require('./auth')({ connection, errorHandler })
//const productsModule = require('./products')({ connection, errorHandler })

module.exports = {
  categories: () => categoryModule, // Exporta categories para que eu possa ler fora do arquivo do serviço.
  users: () => usersModule,
  auth: () => authModule
}