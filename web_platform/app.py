from flask import Flask, render_template
import pymysql

app = Flask(__name__)

# Configure MySQL connection parameters
app.config['MYSQL_HOST'] = '127.0.0.1'
app.config['MYSQL_PORT'] = 3306
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = 'rootpass'
app.config['MYSQL_DB'] = 'mes_db'

# Establish the MySQL connection
def get_db_connection():
    connection = pymysql.connect(
        host=app.config['MYSQL_HOST'],
        port=app.config['MYSQL_PORT'],
        user=app.config['MYSQL_USER'],
        password=app.config['MYSQL_PASSWORD'],
        db=app.config['MYSQL_DB']
    )
    return connection

@app.route('/')
def index():
    try:
        connection = get_db_connection()
        cursor = connection.cursor(pymysql.cursors.DictCursor)
        # Fetch posts data
        cursor.execute('SELECT * FROM posts')
        posts = cursor.fetchall()
        # Fetch students data
        cursor.execute('SELECT * FROM students')
        students = cursor.fetchall()
        cursor.close()
        connection.close()
        return render_template('index.html', posts=posts, students=students)
    except Exception as e:
        print(f"Error occurred: {e}")
        return "An error occurred", 500

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=3000)
