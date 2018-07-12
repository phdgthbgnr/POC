// const http = require('http');
// const hostname = 'localhost';
// const port = 3000;

// const server = http.createServer((req,res) =>{
//     res.statusCode = 200;
// })

const express = require('express')
const app = express()

// app.get('/', (req, res) => res.send('Hello World!'))
app.get('/', function(req, res){
    res.sendFile(__dirname + '/public/index.html');
});
app.use('/', express.static('public'))

app.listen(8080, () => console.log('Server listening on port 8080!'))