const test = require('ava')
const {connection, errorHandler} = require('./setup')
const dependencies = { connection, errorHandler }
const users = require('../users')(dependencies)
const create = () => users.save('user@test.com', '123456')

test.beforeEach (t => connection.query('TRUNCATE TABLE users')) // Limpar a tabela antes da execução dos testes
test.after.always (t => connection.query('TRUNCATE TABLE users')) // Limpar a tabela depois da execução dos testes. always garante que execute mesmo que o teste falhe.

test.serial('Criação de usuários', async t => {
    const result = await create()
    t.is(result.user.email, 'user@test.com')
})

test.serial('Atualização de usuários', async t => {
    await create()
    const updated = await users.update(1, '123456789')
    t.is(test.affectedRows, undefined) // trocar undefined para 1
})

test.serial('Remoção de usuários', async t => {
    await create()
    const removed = await users.del(1)
    t.is(test.affectedRows, undefined) // trocar undefined para 1
})

// test.serial('Lista de usuários', async t => {
//     await create()
//     const list = await users.all()
//     t.is(list.users.length, 2) // trocar undefined para 1
//     t.is(list.users[0].email, 'user@test.com')
// })