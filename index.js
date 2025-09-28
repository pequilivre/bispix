// index.js
import express from 'express';
import { engine } from 'express-handlebars';
import session from 'express-session';
import cookieParser from 'cookie-parser';
import Tokens from 'csrf';

import PrincipalControlador from './controladores/PrincipalControlador.js';

import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
const tokens = new Tokens();

// Servir arquivos estáticos (CSS, JS, imagens)
app.use(express.static(path.join(__dirname, 'public')));

// Middlewares básicos
app.use(cookieParser());
app.use(session({
  secret: 'segredo_super_secreto', // 🔑 troque isso em produção
  resave: false,
  saveUninitialized: true,
}));
app.use(express.urlencoded({ extended: true }));

// Porta do servidor
const PORT = process.env.PORT || 3000;

app.engine('hbs', engine({
    extname: '.hbs',
    partialsDir: path.join(__dirname, 'visoes/fragmentos'),
    defaultLayout: false
}));
app.set('view engine', 'hbs');
app.set('views', './visoes');

// Middleware para gerar o CSRF Token (igual ao @csrf do Laravel)
app.use((req, res, next) => {
  if (!req.session.csrfSecret) {
    req.session.csrfSecret = tokens.secretSync();
  }
  res.locals.csrfToken = tokens.create(req.session.csrfSecret);
  next();
});

// Rota inicial
app.get('/', PrincipalControlador.index);

// Inicia o servidor
app.listen(PORT, () => {
  console.log(`🚀 Servidor rodando em http://localhost:${PORT}`);
});