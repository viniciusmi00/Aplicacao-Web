

const categories = deps => {
    
    return {
        all: () => { // Método para mostrar todos os usuários.

            return new Promise((resolve, reject) => { // Promise para garantir a consulta. Resolve problema com Assincronidade.
                const { connection, errorHandler } = deps

                connection.query('SELECT * From categories', (error, results) => { // Query de consulta SQL.
                  if (error) { 
                    errorHandler(error, 'Falha ao listar as categorias', reject) // Passa o error caso exista. E passa o reject. Estão fornecidas pela Promise.
                    return false // retornar false caso o método seja executado, para não cair no resolve.
                  }
                  resolve( { categories: results } )
                })
            })
        },

        save: (name) => { // Método para salvar um usuário.

            return new Promise((resolve, reject) => { // Promise para garantir a consulta. Resolve problema com Assincronidade.
                const { connection, errorHandler } = deps

                connection.query('INSERT INTO categories (name) VALUES (?);',[name], (error, results) => { // Query de consulta SQL.
                  if (error) { 
                    errorHandler(error, `Falha ao salvar a categoria ${name}`, reject) // Passa o error caso exista. E passa o reject. Estão fornecidas pela Promise.
                    return false // retornar false caso o método seja executado, para não cair no resolve.
                  }
                  resolve( { category: {name, id:results.insertId} } )
                })
            })
        },

        update: (id, name) => {
            
            return new Promise((resolve, reject) => { // Promise para atualizar. Resolve problema com Assincronidade.
                const { connection, errorHandler } = deps

                connection.query('UPDATE categories SET name = ? WHERE id = ?;',[name, id], (error, results) => { // Query de consulta SQL.
                  if (error || !results.affectedRows) { 
                    errorHandler(error, `Falha ao atualizar a categoria ${id} ${name}`, reject) // Passa o error caso exista. E passa o reject. Estão fornecidas pela Promise.
                    return false // retornar false caso o método seja executado, para não cair no resolve.
                  }
                  resolve( { category: {name, id} } )
                })
            })
        },

        del: (id) => {

            return new Promise((resolve, reject) => { // Promise para atualizar. Resolve problema com Assincronidade.
                const { connection, errorHandler } = deps

                connection.query('DELETE FROM categories WHERE id = ?;',[id], (error, results) => { // Query de consulta SQL.
                  if (error || !results.affectedRows) { 
                    errorHandler(error, `Falha ao deletar a categoria ${id}`, reject) // Passa o error caso exista. E passa o reject. Estão fornecidas pela Promise.
                    return false // retornar false caso o método seja executado, para não cair no resolve.
                  }
                  resolve( { message: 'Categoria removida com sucesso!' } )
                })
            })

        }
    }
}

  module.exports = categories  