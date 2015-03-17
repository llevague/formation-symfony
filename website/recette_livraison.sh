#!/bin/sh


##########################################################################
#            SCRIPT D'INSTALLATION EN RECETTE D'UNE VERSION :
#
##########################################################################

TAG_VERSION=$1

cd /tmp
rm -rf matrix*
wget http://10.35.1.10:8081/nexus/content/repositories/softeam/fr/icert/matrix/${TAG_VERSION}/matrix-frontend-${TAG_VERSION}.tgz
wget http://10.35.1.10:8081/nexus/content/repositories/softeam/fr/icert/matrix/${TAG_VERSION}/matrix-backend-${TAG_VERSION}.tgz

if [ -z ${TAG_VERSION} ] ; then echo TAG_VERSION is  empty; exit 12; fi


echo "TAG_VERSION : $TAG_VERSION"




# Livraison sur environnement Recette

cd /tmp
echo "rm -rf /var/www/espaceclient/matrix*" |ssh root@10.35.10.115
scp matrix-backend-$TAG_VERSION.tgz matrix-frontend-$TAG_VERSION.tgz root@10.35.10.115:/var/www/espaceclient/
echo "cd  /var/www/espaceclient/; tar zxf matrix-frontend-$TAG_VERSION.tgz "  |ssh root@10.35.10.115
echo "cd  /var/www/espaceclient/; tar zxf matrix-backend-$TAG_VERSION.tgz "  |ssh root@10.35.10.115
echo "chown -R www-data:www-data /var/www/espaceclient/matrix*; chmod -R u+rw  /var/www/espaceclient/matrix*"  |ssh root@10.35.10.115

CMD="cd /var/www/espaceclient/matrix-backend/website ; "
CMD="$CMD php app/console --env=prod cache:clear ; "
# CMD="$CMD php app/console doctrine:database:drop --force ; "
# CMD="$CMD php app/console doctrine:database:create ; "

CMD="$CMD rm -rf app/cache/* ; "
CMD="$CMD rm -rf app/logs/* ; "


# DUMP
# CMD="$CMD cd /var/www/espaceclient/matrix-backend/integration/mysql ; "
# CMD="$CMD  mysql -umatrix -pRftg541dfg matrix < dump.sql ; "

# MailTrap
CMD="$CMD cd /var/www/espaceclient/matrix-backend/website/app/config ; "
CMD="$CMD cat parameters.yml | sed -e 's/mailtrap_username: 26465a693102eb7dd/mailtrap_username: 26828c35c6a90d719/' > /tmp/parameters.yml ; "
CMD="$CMD cat /tmp/parameters.yml | sed -e 's/mailtrap_password: f655ca67fe8e6b/mailtrap_password: ad63020616f38e/' > parameters.yml ; "

# Suppression du cache
CMD="$CMD cd /var/www/espaceclient/matrix-backend/website/app/cache;"
CMD="$CMD rm -rf prod;"

echo $CMD |ssh root@10.35.10.115
