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
    const sqlQuery = 'CREATE TABLE IF NOT EXISTS dashboards(id int AUTO_INCREMENT, data text, PRIMARY KEY(id))';
    db.query(sqlQuery, (err) => {
        if (err) throw err;
        res.send('Table created!');
    });
});


// Route to get all dashboards
app.get('/dashboards', (req, res) => {
    const sqlQuery = 'SELECT * FROM dashboards';
    db.query(sqlQuery, (err, results) => {
        if (err) throw err;
        res.json(results);
    });
});

// Start the server
app.listen(3001, () => {
    console.log('Server running on http://localhost:3001');
});

