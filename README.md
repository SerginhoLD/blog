# Блог

однажды я его доделаю, выложу и начну

## Установка

1) git, composer
2) создать .env файл
3) `docker build -f docker/Dockerfile -t serginhold/blog:latest .` \
`docker-compose up -d`

## Console
`docker exec -i -t blog bash -c "cd /var/www; bash"`
