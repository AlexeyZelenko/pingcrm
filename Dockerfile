# Используем официальный образ PHP 8.2 с FPM
FROM php:8.2-fpm

# Устанавливаем переменную окружения для пути к базе данных
ENV DB_PATH=/tmp/database/database.sqlite
VOLUME ["/tmp/database"]

# Устанавливаем необходимые системные зависимости
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    libexif-dev \
    curl \
    build-essential \
    && rm -rf /var/lib/apt/lists/*  # Убираем лишние файлы для уменьшения размера образа

# Устанавливаем и конфигурируем расширения PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql exif

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Копируем файлы Laravel в рабочую директорию
COPY . .

# Устанавливаем зависимости Laravel с оптимизацией автозагрузчика
RUN composer install --no-dev --optimize-autoloader

# Устанавливаем Node.js и npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*  # Очищаем кэш apt

# Проверяем версию npm
RUN npm --version

# Устанавливаем зависимости для фронтенда
RUN npm install

# Сборка фронтенда
RUN npm run build

# Настройка порта и экспонирование
ENV PORT=8080
EXPOSE 8080

# Запуск PHP-сервера
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
