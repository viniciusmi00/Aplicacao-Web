const db = require('../services/mysql')
// const users = require('./modules/users') //Passar para a pasta módule depois.
const categories = require('./modules/categories')// Modulo de Categorias
const users = require('./modules/users') // Modulo de Usuário

const routes = (server) => { // Utilização do servidor para criação das rotas.

  categories(server)
  users(server)

  server.post('/autenticacao', async (req, res, next) => { // async para tratar o problema do Assíncrono, retornando corretamente a query SQL do arquivo categories.js
    
    try{   
      const {email, password} = req.body   
      res.send(await db.auth().authenticate(email, password))
      
    } catch (error) { // Executado quando a Promise for rejeitada.
        res.send(error)        
    }
    next()
  })

  
}// Fim da const de Routes.

module.exports = routes // Exporta as rotas.
