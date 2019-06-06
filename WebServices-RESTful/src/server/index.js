
const restify = require('restify') // Cria o servidor Restify

const server = restify.createServer() // Cria o servidor Restify

const routes = require('../http/routes') // Importa o método de rotas que está na pasta http.

const cors = require('./cors') // Importa o middleware Cors.

server.pre(cors.preflight)
server.use(cors.actual)
server.use(restify.plugins.bodyParser())
routes(server) // Passa o servidor para as rotas.

module.exports = server // Exporta o servidor.
