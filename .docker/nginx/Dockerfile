FROM nginx:alpine

# Instalar inotify-tools
RUN apk add --no-cache inotify-tools

# Adicionar o arquivo de configuração do Nginx (opcional)
ADD .docker/nginx/nginx.conf /etc/nginx/conf.d
ADD .docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf

# Comando para iniciar o inotify e o Nginx
CMD ["/bin/sh", "-c", "inotifywait -m -e modify /etc/nginx/conf.d/default.conf | while read; do nginx -s reload; done & nginx -g 'daemon off;'"]