# Блог

однажды я его доделаю, выложу и начну

## Установка

1) git, composer
2) `docker build -f docker/Dockerfile -t serginhold/blog-phalcon:latest .` \
`docker-compose up -d` \
`docker exec -i -t blog-phalcon bash -c "cd /var/www; bash"`
3) `phalcon migration run`
4) создать единственного admin-пользователя \
`php bin/cli user {login} {password}`
