#!/bin/bash

# PHP IMAGE
cd ../tugas-besar-2-php
./scripts/build-image.sh

# SPA IMAGE
cd ../tugas-besar-2-spa
./scripts/build-image.sh

# REST IMAGE
cd ../tugas-besar-2-rest
./scripts/build-image.sh