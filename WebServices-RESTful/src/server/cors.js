const corsMiddleware = require('restify-cors-middleware')

const cors = corsMiddleware({
  preflightMaxAge: 5, // Optional
  origins: ['*'], // origins: ['http://api.myapp.com', 'http://web.myapp.com'],  // O asterisco (*) serve para aceitar qualquer.
  allowHeaders: ['*'], // allowHeaders: ['API-Token'],
  exposeHeaders: ['*'] // exposeHeaders: ['API-Token-Expiry']
})

module.exports = cors
