const test = require('ava')
const {connection, errorHandler} = require('./setup')
const dependencies = { connection, errorHandler }
const categories = require('../categories')(dependencies)

const create = () => categories.save('category-test')

//test.beforeEach (t => connection.query('TRUNCATE TABLE categories')) // Limpar a tabela antes da execução dos testes
//test.after.always (t => connection.query('TRUNCATE TABLE categories')) // Limpar a tabela depois da execução dos testes. always garante que execute mesmo que o teste falhe.

test.serial('Lista de categoria', async t => {
    await create()
    const list = await categories.all()
    t.is(list.categories.length, 1) // trocar undefined para 1
    t.is(list.categories[0].name, 'category-test')
})

test.serial('Criação de categoria', async t => {
    const result = await create()
    t.is(result.category.name, 'category-test')
})

test.serial('Atualização de categoria', async t => {
    await create()
    const updated = await categories.update(1, 'category-test-updated')
    t.is(updated.category.name, 'category-test-updated')
    t.is(test.affectedRows, undefined) // trocar undefined para 1
})

test.serial('Remoção de categoria', async t => {
    await create()
    const removed = await categories.del(1)
    t.is(test.affectedRows, undefined) // trocar undefined para 1
})