#!/bin/bash

# PHP IMAGE
cd ./src/php
./scripts/build-image.sh
cd ../..

# SPA IMAGE
cd ./src/spa
./scripts/build-image.sh
cd ../..

# REST IMAGE
cd ./src/rest
./scripts/build-image.sh
cd ../..

# SOAP IMAGE
cd ./src/soap
./scripts/build-image.sh
cd ../..