from flask import Flask, request, jsonify,render_template
import pymysql

app = Flask(__name__)

# Configure MySQL connection parameters
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_PORT'] = 3306  # Specify the port number
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = 'rootpass'
app.config['MYSQL_DB'] = 'mes_db'

# Establish the MySQL connection
mysql = pymysql.connect(
    host=app.config['MYSQL_HOST'],
    port=app.config['MYSQL_PORT'],  # Use the port from the configuration
    user=app.config['MYSQL_USER'],
    password=app.config['MYSQL_PASSWORD'],
    db=app.config['MYSQL_DB']
)

def create_table():
    try:
        print('Creating Table Started =====')
        cur = mysql.cursor()
        cur.execute(
            '''
            CREATE TABLE IF NOT EXISTS items (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                description TEXT
            )
            '''
        )
        mysql.commit()
        cur.close()
        print('Items Table Created =====')
    except Exception as e:
        print("Error while creating table", e)

@app.route('/')
def index():
    return render_template('index.html')
@app.route('/create.html')
def create_page():
    return render_template('create.html')

@app.route('/update.html')
def update_page():
    return render_template('update.html')

@app.route('/create', methods=['POST'])
def add_items():
    try:
        # Get the JSON data from the request
        data = request.get_json()
        
        # Extract the 'name' and 'description' fields from the JSON data
        name = data['name']
        description = data['description']
        
        # Create a cursor object for interacting with the MySQL database
        cur = mysql.cursor()
        
        # Execute an SQL query to insert the 'name' and 'description' into the 'items' table
        cur.execute('INSERT INTO items (name, description) VALUES (%s, %s)', (name, description))
        
        # Commit the changes to the database
        mysql.commit()
        
        # Close the database cursor
        cur.close()
        
        # Create a response dictionary for a successful operation
        response = {
            'error': False,
            'message': 'Item Added Successfully',
            'data': data         
        }
        
        # Return a JSON response with HTTP status code 201 (Created)
        return jsonify(response), 201
    except Exception as e:
        # Handle any exceptions that may occur during the process
        response = {
            'error': True,
            'message': f'Error Occurred: {e}',
            'data': None         
        }
        
        # Return a JSON response with HTTP status code 500 (Internal Server Error)
        return jsonify(response), 500

@app.route('/items', methods=['GET'])
def get_items():
    try:
        # Create a cursor object for interacting with the MySQL database
        cur = mysql.cursor()
        
        # Execute an SQL query to select all items from the 'items' table
        cur.execute('SELECT * FROM items')
        
        # Fetch all the data (items) from the executed query
        data = cur.fetchall()
        
        # Close the database cursor
        cur.close()
        
        # Create a list of dictionaries to structure the retrieved items
        items = [{'id': item[0], 'name': item[1], 'description': item[2]} for item in data]
        
        # Create a response dictionary for a successful operation
        response = {
            'error': False,
            'message': 'Items Fetched Successfully',
            'data': items         
        }
        
        # Return a JSON response with HTTP status code 200 (OK)
        return jsonify(response), 200
    except Exception as e:
        # Handle any exceptions that may occur during the process
        response = {
            'error': True,
            'message': f'Error Occurred: {e}',
            'data': None         
        }
        
        # Return a JSON response with HTTP status code 500 (Internal Server Error)
        return jsonify(response), 500

@app.route('/update/<int:item_id>', methods=['PUT'])
def update_item(item_id):
    try:
        # Get the JSON data from the request
        data = request.get_json()
        
        # Extract the 'name' and 'description' fields from the JSON data
        name = data['name']
        description = data['description']
        
        # Create a cursor object for interacting with the MySQL database
        cur = mysql.cursor()
        
        # Execute an SQL query to update the 'name' and 'description' of an item with a specific 'item_id'
        cur.execute('UPDATE items SET name = %s, description = %s WHERE id = %s', (name, description, item_id))
        
        # Commit the changes to the database
        mysql.commit()
        
        # Close the database cursor
        cur.close()
        
        # Create a response dictionary for a successful update
        response = {
            'error': False,
            'message': 'Item Updated Successfully',
            'data': {'item_id': item_id}
        }
        
        # Return a JSON response with HTTP status code 200 (OK)
        return jsonify(response), 200
    except Exception as e:
        # Handle any exceptions that may occur during the process
        response = {
            'error': True,
            'message': f'Error Occurred: {e}',
            'data': None         
        }
        
        # Return a JSON response with HTTP status code 500 (Internal Server Error)
        return jsonify(response), 500

@app.route('/delete/<int:item_id>', methods=['DELETE'])
def delete_items(item_id):
    try:
        # Create a cursor object for interacting with the MySQL database
        cur = mysql.cursor()
        
        # Execute an SQL query to delete an item with a specific 'item_id'
        cur.execute('DELETE FROM items WHERE id = %s', (item_id,))
        
        # Commit the changes to the database
        mysql.commit()
        
        # Close the database cursor
        cur.close()
        
        # Create a response dictionary for a successful deletion
        response = {
            'error': False,
            'message': 'Item Deleted Successfully',
            'data': {'item_id': item_id}
        }
        
        # Return a JSON response with HTTP status code 200 (OK)
        return jsonify(response), 200
    except Exception as e:
        # Handle any exceptions that may occur during the process
        response = {
            'error': True,
            'message': f'Error Occurred: {e}',
            'data': None         
        }
        
        # Return a JSON response with HTTP status code 500 (Internal Server Error)
        return jsonify(response), 500

if __name__ == '__main__':
    create_table()
    app.run(debug=True)
