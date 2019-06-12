
const sha1 = require('sha1')

const users = deps => {
    
    return {
        all: () => { // Método para mostrar todos os usuários.

            return new Promise((resolve, reject) => { // Promise para garantir a consulta. Resolve problema com Assincronidade.
                const { connection, errorHandler } = deps

                connection.query('SELECT id, email From users', (error, results) => { // Query de consulta SQL.
                  if (error) { 
                    errorHandler(error, 'Falha ao listar os usuários', reject) // Passa o error caso exista. E passa o reject. Estão fornecidas pela Promise.
                    return false // retornar false caso o método seja executado, para não cair no resolve.
                  }
                  resolve( { users: results } )
                })
            })
        },

        save: (email, password) => {

            return new Promise((resolve, reject) => { // Promise para garantir a consulta. Resolve problema com Assincronidade.
                const { connection, errorHandler } = deps                

                connection.query('INSERT INTO users (email, password) VALUES (?, ?);',[email, sha1(password)], (error, results) => { // Query de consulta SQL.
                                    
                    if (error) { 
                    errorHandler(error, `Falha ao salvar a usuário ${email}`, reject) // Passa o error caso exista. E passa o reject. Estão fornecidas pela Promise.
                    return false // retornar false caso o método seja executado, para não cair no resolve.
                  }
                  resolve( { user: {email, id:results.insertId} } )
                })
            })
        },

        update: (id, password) => { // Método para atualizar um usuário.
            
            return new Promise((resolve, reject) => { // Promise para atualizar um usuário. Resolve problema com Assincronidade.
                const { connection, errorHandler } = deps

                connection.query('UPDATE users SET password = ? WHERE id = ?;',[sha1(password), id], (error, results) => { // Query de consulta SQL.
                  if (error || !results.affectedRows) { 
                    errorHandler(error, `Falha ao atualizar o usuário de ${id}`, reject) // Passa o error caso exista. E passa o reject. Estão fornecidas pela Promise.
                    return false // retornar false caso o método seja executado, para não cair no resolve.
                  }
                  resolve( { user: {id} } )
                })
            })
        },

        del: (id) => {

            return new Promise((resolve, reject) => { // Promise para deletar um usuário. Resolve problema com Assincronidade.
                const { connection, errorHandler } = deps

                connection.query('DELETE FROM users WHERE id = ?;',[id], (error, results) => { // Query de consulta SQL.
                  if (error || !results.affectedRows) { 
                    errorHandler(error, `Falha ao deletar o usuário ${id}`, reject) // Passa o error caso exista. E passa o reject. Estão fornecidas pela Promise.
                    return false // retornar false caso o método seja executado, para não cair no resolve.
                  }
                  resolve( { message: 'Usuário removido com sucesso!' } )
                })
            })

        }
    }
}

  module.exports = users  