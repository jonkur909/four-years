# Four years

A private anniversary letter. PHP and a little JavaScript, meant for a LAMP stack on Debian.

The look is black, ivory, and gold — Versace-adjacent in colour only. There is no brand logo.

## Run locally

From this folder:

```bash
php -S localhost:8080
```

Then open http://localhost:8080

## Make it yours

1. Edit `config.php`: her name, the date line, your name.
2. Put photos in `assets/img/photos/` (jpg, png, or webp). They show up in filename order.
3. Change the wording in `index.php` if you want a specific meeting story.

`config.php` is blocked from the web by `.htaccess` (needs Apache `AllowOverride`).

## Deploy on Debian (Apache + PHP)

```bash
sudo apt update
sudo apt install apache2 php libapache2-mod-php
sudo a2enmod rewrite
```

Copy the project to the server, for example `/var/www/four-years`, and point a vhost at this directory:

```apache
<VirtualHost *:80>
    ServerName anniversary.example.com
    DocumentRoot /var/www/four-years

    <Directory /var/www/four-years>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Then:

```bash
sudo systemctl reload apache2
```

Put HTTPS in front of it (Caddy, nginx, or Certbot) before you share the link. Add basic auth or keep the URL private — this is not a public marketing site.
