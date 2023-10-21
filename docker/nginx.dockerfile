FROM nginx:stable-alpine

# Copies nginx configurations to override the default.
ADD ./nginx/*.conf /etc/nginx/conf.d/
ADD ./nginx/conf.d/ssl/* /etc/nginx/ssl/

# Make html directory
RUN mkdir -p /var/www/html/app

