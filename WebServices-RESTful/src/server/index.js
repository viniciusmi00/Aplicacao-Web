
const restify = require('restify') // Cria o servidor Restify

const server = restify.createServer() // Cria o servidor Restify

const routes = require('../http/routes') // Importa o método de rotas que está na pasta http.

const cors = require('./cors') // Importa o middleware Cors.

const jwtMiddleware = require('./jwtMiddleware')

server.pre(cors.preflight)
server.use(cors.actual)
server.use(restify.plugins.bodyParser())
routes(server) // Passa o servidor para as rotas.

server.use(jwtMiddleware())

module.exports = server // Exporta o servidor.
