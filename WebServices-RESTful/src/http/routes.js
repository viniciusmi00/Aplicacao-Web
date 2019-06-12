const db = require('../services/mysql')
// const users = require('./modules/users') //Passar para a pasta módule depois.

const routes = (server) => { // Utilização do servidor para criação das rotas.

  server.post('/autenticacao', async (req, res, next) => { // async para tratar o problema do Assíncrono, retornando corretamente a query SQL do arquivo categories.js
    
    try{   
      const {email, password} = req.params   
      res.send(await db.auth().authenticate(email, password))
      
    } catch (error) { // Executado quando a Promise for rejeitada.
        res.send(error)        
    }
    next()
  })


  // server.post('/autenticacao', async (req, res, next) => { // async para tratar o problema do Assíncrono, retornando corretamente a query SQL do arquivo categories.js
  //   try{ 
  //     const { email, password} = req.body      
      
  //     res.send(await db.auth().authenticate(email, password))
      
  //   } catch (error) { // Executado quando a Promise for rejeitada.
  //       res.send(422, error)        
  //   }
  //   next()
  // })



  server.get('/categoria', async (req, res, next) => { // async para tratar o problema do Assíncrono, retornando corretamente a query SQL do arquivo categories.js
    
    try{      
      res.send(await db.categories().all())
      
    } catch (error) { // Executado quando a Promise for rejeitada.
        res.send(error)        
    }
    next()
  })




  server.post('/categoria', async (req, res, next) => { // async para tratar o problema do Assíncrono, retornando corretamente a query SQL do arquivo categories.js   
    const { name } = req.params

    try{      
      res.send(await db.categories().save(name))

    } catch (error) { // Executado quando a Promise for rejeitada.
        res.send(error)        
    }  
    next()
  })




  server.put('/categoria', async (req, res, next) => { // async para tratar o problema do Assíncrono, retornando corretamente a query SQL do arquivo categories.js   
    const { id, name } = req.params

    try{      
      res.send(await db.categories().update(id, name))

    } catch (error) { // Executado quando a Promise for rejeitada.
        res.send(error)        
    }
    next()
  })



  
  server.del('/categoria', async (req, res, next) => { // async para tratar o problema do Assíncrono, retornando corretamente a query SQL do arquivo categories.js   
    const { id } = req.params

    try{      
      res.send(await db.categories().del(id))
      
    } catch (error) { // Executado quando a Promise for rejeitada.
        res.send(error)        
    }
    next()
  })



  
}// Fim da const de Routes.

module.exports = routes // Exporta as rotas.
