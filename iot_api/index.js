const mysql = require('mysql');
const express = require('express');
const { body, validationResult } = require('express-validator');
require('dotenv').config();

// Create MySQL connection
const db = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME,
    port: process.env.DB_PORT
});

db.connect((err) => {
    if (err) {
        console.error('MySQL connection failed: ' + err.message);
    } else {
        console.log('Connected to MySQL database');
    }
});

// Initialize Express app
const app = express();
app.use(express.json());

// Route to initialize database table
app.get('/init', (req, res) => {
    const sqlQuery = 'CREATE TABLE IF NOT EXISTS emails(id int AUTO_INCREMENT, firstname VARCHAR(50), lastname VARCHAR(50), email VARCHAR(50), PRIMARY KEY(id))';
    db.query(sqlQuery, (err) => {
        if (err) throw err;
        res.send('Table created!');
    });
});

// Route to subscribe
app.post('/subscribe',
    body('email').isEmail().normalizeEmail(),
    body('firstname').not().isEmpty().escape(),
    body('lastname').not().isEmpty().escape(),
    (req, res) => {
        const errors = validationResult(req);
        if (errors.array().length > 0) {
            res.send(errors.array());
        } else {
            const subscriber = {
                firstname: req.body.firstname,
                lastname: req.body.lastname,
                email: req.body.email
            };
            const sqlQuery = 'INSERT INTO emails SET ?';
            db.query(sqlQuery, subscriber, (err) => {
                if (err) throw err;
                res.send('Subscribed successfully!');
            });
        }
    }
);

// Route to get all emails
app.get('/emails', (req, res) => {
    const sqlQuery = 'SELECT * FROM emails';
    db.query(sqlQuery, (err, results) => {
        if (err) throw err;
        res.json(results);
    });
});

// Start the server
app.listen(3000, () => {
    console.log('Server running on http://localhost:3000');
});

