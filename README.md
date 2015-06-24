# eeti.me

## Install

(We're going to safely assume that you know how to set up PHP, MySQL, the web server of your choice, and git,
and that you're on something Linux-based.)

```
git clone https://github.com/eeti/eeti
cd eeti
cp includes/settings.php.dist includes/settings.php
$EDITOR includes/settings.php
cp meetime/config.php.dist meetime/config.php
$EDITOR meetime/config.php
mysql -u some-user -p my-eeti-database < update.sql
mysql -u some-user -p my-eeti-database < meetime/shortenedurls.sql
echo "myusername,$(`php mkpasswd.php my secret password`)" > wherever-you-specified-in-settings.php.txt
```

## PRs

pls
