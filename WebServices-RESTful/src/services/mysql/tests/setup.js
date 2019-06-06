require('dotenv').config()

const mysqlServer = require('mysql')

const connection = mysqlServer.createConnection({ // Conexão para conectar o MySQL passando o objeto de configuração.
    host: process.env.MYSQL_HOST, // Local a ser conectado.
    user: process.env.MYSQL_USER, // Usuário para login da conexão.
    password: process.env.MYSQL_PASSWORD, // Senha para login da conexão.
    database: process.env.MYSQL_TEST_DATABASE, // Database que será conextado.
    port: process.env.MYSQL_PORT
  })
  
  const errorHandler = (error, msg, rejectFunction) =>{
      console.error(error) // Faz o console error do errorHandler. Pode até mandar para um serviço externo de Logs.
      rejectFunction({ error: msg })// Executa o reject que veio da Promise, passando a mensagem de erro. Vai para o Catch de routes.js
  }

  module.exports = { connection, errorHandler}