# Use the official Python slim image from the Docker Hub
FROM python:3.10-slim

# Set the working directory in the container
WORKDIR /app

RUN python -m pip install --upgrade pip

# Copy the requirements file into the container
COPY requirement.txt .

RUN python3 -m venv ./env
RUN . ./env/bin/activate

# Install the Python dependencies
RUN pip install -r requirement.txt

# Copy the rest of the application code into the container
COPY . .

# Expose the port that the application runs on
EXPOSE 5000

# Run the Flask app
CMD ["flask", "run", "--host=0.0.0.0"]


