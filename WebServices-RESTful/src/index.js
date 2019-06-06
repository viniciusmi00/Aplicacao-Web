require('dotenv').config()

const server = require('./server') // A partir do index, é chamado o servidor em index.js na pasta server.

server.listen('3456') // Porta para abrir a aplicação.
