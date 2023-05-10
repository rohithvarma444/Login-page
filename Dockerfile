FROM debian:buster-slim

# Update package lists and install dependencies
RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y apache2 php libapache2-mod-php php-mysql mariadb-server && \
    rm -rf /var/lib/apt/lists/*

# Start the Apache service and enable PHP module
RUN service apache2 start && \
    #a2enmod php && \
    service apache2 restart

# Create a SQL database and user
RUN service mysql start && \
    mysql -u root -e "CREATE DATABASE websitelogins;" && \
    mysql -u root -e "USE websitelogins; CREATE TABLE users(username varchar(60),password varchar(100),email varchar(100));" && \
    mysql -u root -e "USE websitelogins; CREATE USER 'user1'@'localhost' IDENTIFIED BY 'user1';" && \
    mysql -u root -e "USE websitelogins; GRANT ALL PRIVILEGES ON websitelogins.* TO 'user1'@'localhost'" && \
    mysql -u root -e "FLUSH PRIVILEGES;"

# Copy website files to Apache document root
COPY ./php /var/www/html/

# Set the ServerName in Apache configuration
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Expose port 80 for HTTP traffic
EXPOSE 80

# Start Apache in foreground mode when container is run
CMD service mysql start &&  /usr/sbin/apache2ctl -D  FOREGROUND
