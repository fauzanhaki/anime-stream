var express = require('express');
var app = express();
var path = require('path'),
    cookieParser = require('cookie-parser'),
    session = require('express-session'),
    RedisStore = require('connect-redis')(session);
    const { createClient } = require("redis")
    let redisClient = createClient({ legacyMode: true })
    redisClient.connect().catch(console.error)
// must specify options hash even if no options provided!
var phpExpress = require('php-express')({

  // assumes php is in your PATH
  binPath: 'php'
});

app.use(express.static(path.join(__dirname,'/assets')));
app.use('/assets',express.static(path.join(__dirname,'/assets')));

app.use(express.static(path.join(__dirname,'/admin')));
app.use('/admin',express.static(path.join(__dirname,'/admin')));

// set view engine to php-express
app.set('views', './');
app.engine('php', phpExpress.engine);
app.set('view engine', 'php');

app.use(cookieParser());
app.use(
  session({
    store: new RedisStore({ client: redisClient,prefix: "session:php" }),
    saveUninitialized: false,
    name: 'PHPSESSID',
    secret: 'node.js rules',
    resave: false
  })
)
// routing all .php file to php-express
app.all(/.+\.php$/, phpExpress.router);

var server = app.listen(80, function () {
  console.log("Server sudah berjalan");
});