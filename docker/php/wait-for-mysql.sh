#!/bin/sh

echo "⏳ Aguardando MySQL..."

while ! nc -z mysql 3306; do
  sleep 1
done

echo "✅ MySQL está pronto!"