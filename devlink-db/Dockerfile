# Dockerfile
FROM mysql:8.0

# Variáveis de ambiente
ENV MYSQL_DATABASE=devlink \
    MYSQL_USER=devlink_user \
    MYSQL_PASSWORD=secret_pass \
    MYSQL_ROOT_PASSWORD=root_password

# Copiar SQL inicial (se tiver scripts para rodar automaticamente)
# COPY ./init.sql /docker-entrypoint-initdb.d/

# Porta padrão
EXPOSE 3306
