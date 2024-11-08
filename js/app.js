const express = require('express');
const path = require('path');
const bcrypt = require('bcrypt');
const session = require('express-session');
const multer = require('multer');
const app = express();
const mysql = require('mysql2');

// Conexión a la base de datos MySQL
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'user_db'
});

db.connect((err) => {
  if (err) {
    console.error('Error al conectar con la base de datos MySQL:', err.message);
    return;
  }
  console.log('Conectado a la base de datos MySQL.');
});

// Configuración de sesiones
app.use(session({
  secret: 'secreto',
  resave: false,
  saveUninitialized: true,
}));

db.query(`
  CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE,
    password VARCHAR(255)
  )
`, (err) => {
  if (err) {
    console.error('Error creando la tabla users:', err.message);
  }
});

db.query(`
  CREATE TABLE IF NOT EXISTS alerts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    content TEXT,
    image VARCHAR(255),
    date_created DATETIME,
    resolved BOOLEAN DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id)
  )
`, (err) => {
  if (err) {
    console.error('Error creando la tabla alerts:', err.message);
  }
});


// Configuración de almacenamiento de imágenes
const storage = multer.diskStorage({
  destination: './uploads/',
  filename: (req, file, cb) => {
    cb(null, Date.now() + path.extname(file.originalname));
  }
});
const upload = multer({ storage });

// Rutas aquí (las agregaremos en el siguiente paso)

app.get('/registers', (req, res) => {
    res.sendFile(path.join(__dirname, 'views/register.html'));
  });
  
  app.post('/registers', (req, res) => {
    const { username, password } = req.body;
    const hashedPassword = bcrypt.hashSync(password, 10);
  
    db.query(`INSERT INTO users (username, password) VALUES (?, ?)`, [username, hashedPassword], function(err) {
      if (err) {
        console.error(err.message);
        return res.redirect('/register?error=Usuario%20ya%20existe');
      }
      res.redirect('/login');
    });
  });


  app.get('/login', (req, res) => {
    res.sendFile(path.join(__dirname, 'views/index.html'));
  });
  
  app.post('/login', (req, res) => {
    const { username, password } = req.body;
  
    db.query(`SELECT * FROM users WHERE username = ?`, [username], (err, results) => {
      if (err) {
        console.error('Error al buscar usuario:', err.message);
        return res.redirect('/login?error=Error%20de%20servidor');
      }
  
      const user = results[0]; // Los resultados en MySQL son devueltos en un array
      if (!user || !bcrypt.compareSync(password, user.password)) {
        return res.redirect('/login?error=Credenciales%20inválidas');
      }
  
      req.session.userId = user.id;
      res.redirect('/menu');
    });
  });
  

  // Nueva ruta para el menú
app.get('/menu', isAuthenticated, (req, res) => {
  res.sendFile(path.join(__dirname, 'menu.html'));
});
  
function isAuthenticated(req, res, next) {
  if (req.session.userId) {
    return next();
  }
  res.redirect('/login');
}

app.get('/dashboard', isAuthenticated, (req, res) => {
    res.sendFile(path.join(__dirname, 'views/dashboard.html'));
  });
  
  app.post('/alert', isAuthenticated, upload.single('image'), (req, res) => {
    const { content } = req.body;
    const image = req.file ? req.file.filename : null;
    const dateCreated = new Date();
  
    db.query(`INSERT INTO alerts (user_id, content, image, date_created) VALUES (?, ?, ?, ?)`, 
      [req.session.userId, content, image, dateCreated], (err, results) => {
        if (err) {
          console.error('Error al crear la alerta:', err.message);
          return res.redirect('/dashboard?error=No%20se%20pudo%20crear%20la%20alerta');
        }
        res.redirect('/dashboard?success=Alerta%20creada');
    });
  });
  

app.get('/alerts', isAuthenticated, (req, res) => {
    const oneWeekAgo = new Date();
    oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
    const dateLimit = oneWeekAgo.toISOString();
  
    db.all(`SELECT * FROM alerts WHERE resolved = 0 AND date_created >= ?`, [dateLimit], (err, rows) => {
      if (err) {
        console.error(err.message);
        return res.status(500).send('Error al obtener alertas');
      }
      res.json(rows);
    });
  });

app.get('/logout', (req, res) => {
  req.session.destroy();
  res.redirect('/login');
});

app.get('/profile', isAuthenticated, (req, res) => {
    res.sendFile(path.join(__dirname, 'views/profile.html'));
  });
  
  app.post('/profile', isAuthenticated, (req, res) => {
    const { password } = req.body;
    const hashedPassword = bcrypt.hashSync(password, 10);
  
    db.run(`UPDATE users SET password = ? WHERE id = ?`, [hashedPassword, req.session.userId], function(err) {
      if (err) {
        console.error(err.message);
        return res.redirect('/profile?error=No%20se%20pudo%20actualizar%20la%20contraseña');
      }
      res.redirect('/profile?success=Contraseña%20actualizada');
    });
  });



// Para servir archivos estáticos desde la carpeta 'views/uploads'
app.use('/sitio-alertas', express.static(__dirname + '/views'));



// Otras rutas y configuraciones
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname,  'index.html'));
});


app.listen(4002, () => {
  console.log('Servidor iniciado en el puerto 4002');
});

