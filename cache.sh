#!/bin/bash

php bin/console cache:clear --env=dev
sudo -s chmod -R 777 app/cache
