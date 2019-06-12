const sha1 = require('sha1')
const jwt = require ('jsonwebtoken')

const auth = deps => {    
    return {

        authenticate: (email, password) => { // Método para autenticar os usuários.

            return new Promise((resolve, reject) => { // Promise para garantir a consulta. Resolve problema com Assincronidade.
                const { connection, errorHandler } = deps                

                const queryString = 'SELECT id, email FROM users WHERE email = ? AND password = ?'
                const queryData = [email, sha1(password)]                

                connection.query(queryString, queryData, (error, results) => { // Query de consulta SQL.
                    console.log(error)
                    
                  if (error || !results.length) { 
                    errorHandler(error, 'Falha ao localizar o usuário', reject) // Passa o error caso exista. E passa o reject. Estão fornecidas pela Promise. 
                    console.error(error)                   
                    return false // retornar false caso o método seja executado, para não cair no resolve.
                  }
              
                  const { email, id } = results[0]
                  const token = jwt.sign({email, id}, process.env.JWT_SECRET, { expiresIn: 60 * 60 * 24 })
                  //console.log(token)
                  resolve( { token } )
                })
            })
        }
    }
}

module.exports = auth