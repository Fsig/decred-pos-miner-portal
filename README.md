# pos-miner-portal
*DISCONTINUED* - Decred POS Miner Portal is a simple portal to display the balance and tickets for a POS miner node.

###### Setup for Ubuntu 14.04

Install Apache2 and PHP
```
sudo apt-get update
sudo apt-get install apache2 php5 libapache2-mod-php5
```

Secure Apache2
```
sudo nano /etc/apache2/sites-enabled/000-default.conf

```

Below DocumentRoot /var/www/html add the following
```
<Directory /var/www/html/>
	AllowOverride All
</Directory>
```

Save the file and restart Apache2
```
sudo service apache2 restart
```

Download and extract POS Miner Portal
```
wget https://github.com/Fsig/pos-miner-portal/archive/master.zip
unzip master.zip
cp -R php-miner-portal-master/* /var/www/html/
```

Copy certificates
```
cp /home/ubuntu/.dcrd/rpc.cert /var/www/html/includes/rpc-dcrd.cert
cp /home/ubuntu/.dcrwallet/rpc.cert /var/www/html/includes/rpc-wallet.cert
```

Edit config file
```
sudo nano /var/www/html/includes/config.inc.php
```
