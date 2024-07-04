# Use the official Python image from the Docker Hub
FROM python:latest

# Set the working directory in the container
WORKDIR /app

# Copy the local code to the container
COPY . /app

# Install any needed packages specified in requirements.txt
RUN pip install -r requirements.txt

# Make port 5000 available to the world outside this container
EXPOSE 5000

# Define environment variables
ENV FLASK_APP=app.py
ENV FLASK_ENV=development

# Run the Flask app
CMD ["flask", "run", "--host=0.0.0.0"]

