#!/bin/sh

##########################################################################
#            SCRIPT D'INSTALLATION EN PRODUCTION D'UNE VERSION :
#              - INSTALLATION SUR LE SERVEUR CLIENT
#              - UPDATE Schema Doctrine
#
##########################################################################

TAG_VERSION=$1

cd /tmp
rm -rf matrix*
wget http://10.35.1.10:8081/nexus/content/repositories/softeam/fr/icert/matrix/${TAG_VERSION}/matrix-frontend-${TAG_VERSION}.tgz
wget http://10.35.1.10:8081/nexus/content/repositories/softeam/fr/icert/matrix/${TAG_VERSION}/matrix-backend-${TAG_VERSION}.tgz

scp matrix-frontend-${TAG_VERSION}.tgz root@195.154.32.232:/tmp/
scp matrix-backend-${TAG_VERSION}.tgz root@195.154.32.232:/tmp/

CMD="cd /var/www/espaceclient/"
CMD="$CMD; rm -rf matrix*"
CMD="$CMD; cp /tmp/matrix-frontend-${TAG_VERSION}.tgz ."
CMD="$CMD; tar zxvf matrix-frontend-${TAG_VERSION}.tgz"
CMD="$CMD; cp /tmp/matrix-backend-${TAG_VERSION}.tgz ."
CMD="$CMD; tar zxvf matrix-backend-${TAG_VERSION}.tgz"

CMD="$CMD; cd /var/www/espaceclient/matrix-backend/website"
# CMD="$CMD; php app/console doctrine:schema:update --force"

CMD="$CMD; rm -rf app/cache/*"
CMD="$CMD; rm -rf app/logs/*"
CMD="$CMD; chown -R www-data: /var/www/espaceclient"
CMD="$CMD; chmod -R u+rwx /var/www/espaceclient"
CMD="$CMD; php app/console cache:clear --env=prod"

# DUMP
# CMD="$CMD; cd /var/www/espaceclient/matrix-backend/integration/mysql "
# CMD="$CMD; mysql -umatrix -pRftg541dfg matrix < dump.sql "

# Restart
CMD="$CMD; service apache2 restart"

# Suppression du cache
CMD="$CMD; cd /var/www/espaceclient/matrix-backend/website/app/cache"
CMD="$CMD; rm -rf prod"

echo $CMD | ssh root@195.154.32.232


