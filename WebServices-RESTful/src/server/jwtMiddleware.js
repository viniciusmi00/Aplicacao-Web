const jwt = require('jsonwebtoken')

const jwtMiddleware = () => {
    return async (req, res, next) => {
        const token = req.headers['x-access-token']
        
            if(!token){
                res.send(403,{error:'Token não fornecido'})
                return false
            }
        
            await jwt.verify(token, process.env.JWT_SECRET, (error, decoded) => {
                if (error){
                    res.send(403, {error: 'Falha ao autenticar o token'})            
                } else{
                    req.decoded = decoded
                }
            })
        
            // alguma verificação no token
            next()
        }
}

module.exports = jwtMiddleware