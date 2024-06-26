#!/bin/sh

# Define variables
host="$1"
cmd="$2"

# Wait for MySQL to be available
while ! nc -z "$host" 3306; do
  echo "Waiting for MySQL to be ready..."
  sleep 1
done

# Run the specified command
exec $cmd