# SIP PUSKESMAS ANTAR DESA

## Description

SIP Puskesmas Antar Desa is a web-based application developed to manage health services between villages. The project is built with PHP (version <= 7.4) and MySQL as the database.

## Requirements

- PHP version: 7.4 or lower
- MySQL database

## Installation

### .htaccess code in dev

```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /sip_sindang

    # Removes index.php from URLs
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]

    # RewriteRule ^(.*)$ index.php/$1 [L]
    # RewriteRule .* index.php/$0 [PT,L]

</IfModule>

```

### .htaccess code in prod

```
## LOCAL HTACCESS ###

RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule .* index.php/$0 [PT,L]

RewriteCond %{HTTP_HOST} ^viepkk.com [NC]
RewriteRule ^(.*)$ http://www.viepkk.com/$1 [L,R=301]

RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI}
```
