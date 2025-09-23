
==== DIRECTORY PERMISSIONS after storage:link command ====

sudo usermod -a -G www-data username
sudo chown -R $USER:www-data /var/www/<your-project>

Then I set all my directories to 755 and files to 644 like so:

sudo find /var/www/<your-project> -type f -exec chmod 644 {} \;
sudo find /var/www/<your-project> -type d -exec chmod 755 {} \;

Then I give the web server the permissions to read and write to the storage and bootstrap/cache directories as required by Laravel.

In your project root:

sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
