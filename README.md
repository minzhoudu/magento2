# magento2-internship #

## Initial Project Setup
1. Generate SSH key pair and add it to your GitHub account
2. Clone the repository
3. Enter ```magento2-internship``` directory

## Magento 2 Setup
1. Go to docker folder and run ```docker-compose up -d --build``` (```--build``` tag only first time to rebuild local images) .
2. Run ```cp ./config/env.php ../magento2/app/etc/env.php```.
3. After that run ```bin/composer install``` from the same folder.
4. Credentials for packages download are stored in ```magento2/auth.json```.
5. Add ```127.0.0.1 magento2-internship.test``` to your ```/etc/hosts``` file.
6. Import database with the command ```bin/import-db ../db_dumps/local-initial.sql```.
7. You might need to run ```bin/magento setup:upgrade``` after that.
8. Check if you can access your website at ```magento2-internship.test```.