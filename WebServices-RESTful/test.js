//
// Arquivo para executar uma série de testes no código. Para rodar: Terminal: npm test.
// Mais informações em: https://github.com/avajs/ava 
// 

import test from 'ava';

test('foo', t => {
	t.pass();
});

test('bar', async t => {
	const bar = Promise.resolve('bar');
	t.is(await bar, 'bar');
});