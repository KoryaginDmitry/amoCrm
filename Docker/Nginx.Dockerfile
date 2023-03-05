FROM nginx

ADD Docker/config/nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/amoCRM
