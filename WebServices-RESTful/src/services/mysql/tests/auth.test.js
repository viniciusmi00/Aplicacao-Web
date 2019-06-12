const test = require('ava')
const {connection, errorHandler} = require('./setup')
const dependencies = { connection, errorHandler }
const users = require('../users')(dependencies)
const auth = require('../auth')(dependencies)
const create = () => users.save('user@test.com', '123456')

test.beforeEach(t => connection.query('TRUNCATE TABLE users')) // Limpar a tabela antes da execução dos testes
test.afterEach(t => connection.query('TRUNCATE TABLE users')) // Limpar a tabela depois da execução dos testes. always garante que execute mesmo que o teste falhe.
test.after.always(t => connection.query('TRUNCATE TABLE users')) // Limpar a tabela depois da execução dos testes. always garante que execute mesmo que o teste falhe.

test('Login de usuários - sucesso', async t => {
    await create()
    const result = await auth.authenticate('user@test.com', '123456')
    t.not(result.token, null)
    t.not(result.token.length, 0)
})

// test('Login de usuários - falha', async t => {
//     await create()
//     const promise = auth.authenticate('email_nao_criado@test.com', '123456')
//     const error = await t.throws(promise)
//     t.is(error.error, 'Falha ao localizar o usuário')    
// })