## Installation and Guide

- Clone the project and change dir to ``skeleton``
- Run ``composer install``
- Set your DB credentials in .env (is not in .gitignore)
- Run ``php bin/console doctrine:migrations:migrate``
- Run ``php bin/console doctrine:fixtures:load``
- Setup your http server and config
- Make POST request to ``/calculate-price`` and ``/purchase`` endpoints via Postman or via some other request manager

