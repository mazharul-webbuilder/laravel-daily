# Laravel Redis Caching Setup

This guide provides a step-by-step process for setting up Redis caching in a Laravel
project for local development on a Windows PC and production on a Linux server.

## Step 1: Install Redis Locally on Windows

1. **Download and Install Redis**:
    - Download Redis for Windows from the [Redis GitHub Releases](https://github.com/microsoftarchive/redis/releases). Placed in C drive will be the best choice and never remove this folder.
    - Extract the downloaded file and open the Command Prompt in the extracted directory. Ex: C:/redis
    - **NOTE: Please use windows default command prompt as administrative permission**

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
      
============================================================================

## How to Check if Redis Server is Running

### For Windows

- Note: **To Access redis-cli globally you need to set redis installed path to the global variable, go to windows enviornment variable and in system section, double click on path and add the copied path and save**

1. **Open Command Prompt:**
    - Press `Win + R`, type `cmd`, and press Enter.

2. **Check Redis Status:**
    - Run the following command where your redis is installed. EX: C:/redis:
      ```bash
      redis-cli ping
      ```
    - If the server is running, you should see the response:
      ```
      PONG
      ```
    - If the server is not running, you will receive an error message saying that the server is not responding.

3. **Check Redis Services:**
    - You can also check if the Redis service is running by using:
      ```bash
      sc query redis
      ```
    - Look for the line that says `STATE`, which will tell you if Redis is running (`RUNNING`) or stopped.

### For Linux

1. **Open Terminal:**
    - Use your preferred terminal application.

2. **Check Redis Status:**
    - Use the following command:
      ```bash
      redis-cli ping
      ```
    - If Redis is running, you should get a `PONG` response.

3. **Check Redis Service Status:**
    - Use the following command:
      ```bash
      sudo systemctl status redis
      ```
    - The output will show the service status. If it's running, you will see something like:
      ```
      Active: active (running) ...
      ```
    - If it's not running, it might say `inactive` or `failed`.

4. **Alternative Method:**
    - Use the following command to check if Redis is running on the default port (6379):
      ```bash
      ps aux | grep redis
      ```
    - If Redis is running, you will see it listed in the output.

## Additional Tips

- If Redis is not running, start the service with:
    - **Windows:**
      ```bash
      redis-server
      ```
    - **Linux:**
      ```bash
      sudo systemctl start redis
      ```
- Make sure Redis is configured to start on boot:
    - **Windows:** Set up as a service using Redis configurations.
    - **Linux:**
      ```bash
      sudo systemctl enable redis
      ```

============================================================================


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

============================================================================

## What to do if php_redis extension is not installed?

- **Possible error you will found in windows with xamp**:
```text
Error: Class &quot;Redis&quot; not found in file D:\mazharul\ottapi\vendor\laravel\framework\src\Illuminate\Redis\Connectors\PhpRedisConnector.php on line 79
```
- Which indicate that You need to ensure that the PhpRedis extension is installed and enabled in your PHP setup


## 1. Install the PhpRedis Extension

You need to ensure that the PhpRedis extension is installed and enabled in your PHP setup.

### For Windows:

1. Open your `php.ini` file. You can find it in your PHP installation directory (e.g., `C:\php\php.ini` or `C:\xampp\php\php.ini`).

2. Search for the line with `;extension=redis`. Remove the semicolon (`;`) to enable it:

   ```ini
   extension=redis
   ```
3. If the line does not exist, download the php_redis.dll file from the PECL repository 
4. https://pecl.php.net/package/redis
5.  that matches your PHP version and architecture (e.g., PHP 8.0, x64).

6. Place the downloaded DLL file in the ext directory of your PHP installation (e.g., C:\php\ext).

7. Add the following line to your php.ini file if it’s not already there:
8. ```ini
        extension=php_redis.dll
     ```
9. Restart the xampp.
10. Done

### There is a application where you can manage your redis
```text
"Redis Insight" 
```
https://redis.io/insight/
