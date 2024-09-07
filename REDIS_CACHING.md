# Laravel Redis Caching Setup

This guide provides a step-by-step process for setting up Redis caching in a Laravel 10 project for local development on a Windows PC and production on a Linux server.

## Step 1: Install Redis Locally on Windows

1. **Download and Install Redis**:
    - Download Redis for Windows from the [Redis GitHub Releases](https://github.com/microsoftarchive/redis/releases).
    - Extract the downloaded file and open the Command Prompt in the extracted directory.
    - Run Redis Server:
      ```bash
      redis-server.exe redis.windows.conf
      ```

2. **Run Redis as a Windows Service (Optional)**:
    - Install Redis as a service:
      ```bash
      redis-server --service-install redis.windows.conf --loglevel verbose
      ```
    - Start the Redis service:
      ```bash
      redis-server --service-start
      ```

## Step 2: Install Redis on Production Linux Server

1. **Install Redis on Linux**:
   ```bash
   sudo apt update
   sudo apt install redis-server
   ````
2. **Configure Redis**:

   Edit /etc/redis/redis.conf to configure Redis:
 
   ```
    bind 0.0.0.0
    appendonly yes
   ```


3**Start and Enable Redis Service:**:
   ```bash
      sudo systemctl start redis-server
      sudo systemctl enable redis-server
   ````


## Step 3: Configure Laravel to Use Redis

1. **For Local Development (Predis)**:
   ```bash
   composer require predis/predis
   ````

2. **For Production (PhpRedis on Linux)**:
   ```bash
   sudo apt install php-redis
   ````

2. **Configure Redis in .env File**:
   ```dotenv
    CACHE_DRIVER=redis
    SESSION_DRIVER=redis
    QUEUE_CONNECTION=redis

    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

   ````

3 **Update config/database.php**:
   ```php
    'redis' => [
    'client' => env('REDIS_CLIENT', 'predis'), // Use 'phpredis' for Linux production

    'options' => [
        'cluster' => env('REDIS_CLUSTER', 'redis'),
        'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
    ],

    'default' => [
        'host' => env('REDIS_HOST', '127.0.0.1'),
        'password' => env('REDIS_PASSWORD', null),
        'port' => env('REDIS_PORT', 6379),
        'database' => env('REDIS_DB', 0),
    ],

    'cache' => [
        'host' => env('REDIS_HOST', '127.0.0.1'),
        'password' => env('REDIS_PASSWORD', null),
        'port' => env('REDIS_PORT', 6379),
        'database' => env('REDIS_CACHE_DB', 1),
    ],
],

   ````

## Step 4: Clear and Cache Configuration

Run the following commands to clear and cache the configurations:

```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache

```

## Step 5: Testing Redis in Laravel

1. **Secure Redis**

    Setup a redis password in /etc/redis/redis.conf

```ini
requirepass your_redis_password
```

2. **Update the .env file**

    Setup a redis password in /etc/redis/redis.conf

```dotenv
REDIS_PASSWORD=your_redis_password
```

3. **Performance Tuning:**

   Adjust maxmemory and maxmemory-policy in the Redis configuration file for performance optimization.

## Summary of Key Commands for Each Environment
- **Local (Windows) Setup**:
    - Install Redis and run manually or as a service.
    - Use Predis as the Redis client.
    - Configure `.env` and Laravel configuration files.

- **Production (Linux) Setup**:
    - Install Redis and PhpRedis.
    - Secure Redis with a password and proper configuration.
    - Adjust settings for performance and persistence.

- Follow these steps to set up Redis caching in your Laravel 10 project, ensuring enhanced performance through efficient caching.
