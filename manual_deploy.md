# Manual Deploy

Follow these steps when uploading the web app manually to shared hosting.

## 1. Build Locally

Run this from the local `trophy-app-web` folder:

```bash
npm run build
```

This creates the production CSS/JS files inside:

```text
public/build
```

## 2. Upload Files

Upload these files and folders to the server project folder:

```text
app/
bootstrap/
config/
database/
public/
resources/
routes/
vendor/
artisan
composer.json
composer.lock
```

The most important folder for styles and JavaScript is:

```text
public/build/
```

## 3. Do Not Upload These

Do not upload local cache, logs, or environment files:

```text
.env
node_modules/
public/hot
storage/logs/
storage/framework/cache/
storage/framework/sessions/
storage/framework/views/
bootstrap/cache/*.php
```

Keep the server `.env` file unchanged.

## 4. Enter Server Project Folder

SSH into the server, then go to the Laravel project folder:

```bash
cd ~/greentechexim.bdchefchoice.com
```

## 5. Create Required Laravel Folders

```bash
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
chmod -R 775 storage bootstrap/cache
```

## 6. Clear Old Cache

```bash
/opt/alt/php83/usr/bin/php -d extension=dom.so -d extension=mbstring.so artisan optimize:clear
rm -f public/hot
```

## 7. Run Database Migration

Use this for normal deploys:

```bash
/opt/alt/php83/usr/bin/php -d extension=dom.so -d extension=mbstring.so artisan migrate --force
```

Only use this when you want to delete all database data and seed fresh data:

```bash
/opt/alt/php83/usr/bin/php -d extension=dom.so -d extension=mbstring.so artisan migrate:fresh --seed
```

## 8. Connect Storage

```bash
/opt/alt/php83/usr/bin/php -d extension=dom.so -d extension=mbstring.so artisan storage:link
```

## 9. Rebuild Production Cache

```bash
/opt/alt/php83/usr/bin/php -d extension=dom.so -d extension=mbstring.so artisan config:cache
/opt/alt/php83/usr/bin/php -d extension=dom.so -d extension=mbstring.so artisan route:cache
/opt/alt/php83/usr/bin/php -d extension=dom.so -d extension=mbstring.so artisan view:cache
```

## 10. Hard Refresh Browser

After deploy, hard refresh the website:

```text
Ctrl + Shift + R
```

If the style is still missing, check that this folder exists on the server:

```text
public/build/assets
```
