#!/bin/bash
# รันครั้งเดียวหลัง Jenkins container start ครั้งแรก
# ติดตั้ง Docker CLI และ curl ใน Jenkins container

docker exec -it jenkins bash -c "
    apt-get update -qq && \
    apt-get install -y curl docker.io && \
    curl --version && \
    docker --version && \
    echo '✅ Docker CLI and curl installed in Jenkins container'
"
