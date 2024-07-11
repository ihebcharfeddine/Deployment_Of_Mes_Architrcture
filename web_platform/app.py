from flask import Flask, render_template, request, redirect, url_for
import MySQLdb

app = Flask(__name__)

# Update MySQL connection parameters to connect to the Docker container
db = MySQLdb.connect(
    host="mysql-db",  # Use 127.0.0.1 for TCP/IP connections
    port=3306,         # Specify the port number
    user="root",      # MySQL root user
    passwd="rootpass", # MySQL root password
    db="mytododb"     # MySQL database name
)
cursor = db.cursor()

@app.route('/')
def index():
    cursor.execute("SELECT id, name FROM tasks")
    tasks = cursor.fetchall()
    return render_template('index.html', tasks=tasks)

@app.route('/add_task', methods=['POST'])
def add_task():
    task_name = request.form.get('task_name')
    if task_name:
        cursor.execute("INSERT INTO tasks (name) VALUES (%s)", (task_name,))
        db.commit()
    return redirect(url_for('index'))

@app.route('/delete_task/<int:task_id>', methods=['GET'])
def delete_task(task_id):
    cursor.execute("DELETE FROM tasks WHERE id = %s", (task_id,))
    db.commit()
    return redirect(url_for('index'))

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)

