1.Ensure db configurations are updated properly.DB Base name should  be in leadsengage_apps.
Db Configuration available in lib/process/config.php

2.Once configuration over then create 2 database in the name of leadsengage_apps and leadsengage_appsbase.
Then restore base.sql file into leadsengage_appsbase and apps.sql file into leadsengage_apps.Cleanup previous entry in leadsengage_apps database tables.Schema files are available in schema folder.

3.Set file permission for mautic root folder.
sudo setfacl -dR -m u:www-data:rwX -m u:$(whoami):rwX /var/www/mauto/
sudo setfacl -R -m u:www-data:rwX -m u:$(whoami):rwX /var/www/mauto/

4.apache configuration:

<VirtualHost *:80>
  DocumentRoot /var/www/
  ServerName  other.example.com
  ServerAlias *.localhost

<Directory /var/www/mautic/>
Options FollowSymLinks
AllowOverride All
Order allow,deny
allow from all
</Directory>
</VirtualHost>

sudo setfacl -dR -m u:www-data:rwX -m u:$(whoami):rwX /var/www/leadsinternal/
sudo setfacl -R -m u:www-data:rwX -m u:$(whoami):rwX /var/www/leadsinternal/

sudo setfacl -dR -m u:www-data:rwX -m u:$(whoami):rwX /var/www/mautic/
sudo setfacl -R -m u:www-data:rwX -m u:$(whoami):rwX /var/www/mautic/

sudo setfacl -dR -m u:www-data:rwX -m u:$(whoami):rwX /var/www/cops/
sudo setfacl -R -m u:www-data:rwX -m u:$(whoami):rwX /var/www/cops/



