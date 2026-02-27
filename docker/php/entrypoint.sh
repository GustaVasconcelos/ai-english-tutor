#!/bin/sh

echo "🚀 Iniciando container Laravel..."

/usr/local/bin/wait-for-mysql.sh

echo "🔐 Ajustando permissões..."

mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

if [ ! -d "vendor" ]; then
    echo "📦 Instalando dependências do Composer..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if ! grep -q "APP_KEY=" .env || [ -z "$(grep APP_KEY= .env | cut -d '=' -f2)" ]; then
    echo "🔐 Gerando APP_KEY..."
    php artisan key:generate
fi

echo "🗄 Rodando migrations..."
php artisan migrate --force --seed

if [ ! -L "public/storage" ]; then
    echo "🔗 Criando storage link..."
    php artisan storage:link
fi

echo "✅ Laravel pronto!"

exec "$@"