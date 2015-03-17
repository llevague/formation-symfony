#!/bin/sh

##########################################################################
#            SCRIPT DE LIVRAISON EN INTEGRATION :
#              - INSTALLATION SUR LE SERVEUR D'INTEGRATION
#              - UPDATE Schema Doctrine
#
##########################################################################
REPERTOIRE_WWW="/var/www/formation-symfony-LLVNH"
REPERTOIRE_JENKINS="/var/lib/jenkins/jobs/formation-symfony-LLVNH/workspace/"

## INSTALLATION SUR LE SERVEUR D'INTEGRATION
CMD="rm -rf ${REPERTOIRE_WWW} ; "
CMD="$CMD mkdir ${REPERTOIRE_WWW} ; "
CMD="$CMD cp -r ${REPERTOIRE_JENKINS}/* ${REPERTOIRE_WWW} ; "
CMD="$CMD chown -R www-data:www-data ${REPERTOIRE_WWW} ; "
CMD="$CMD chmod -R u+rw ${REPERTOIRE_WWW} ; "

echo $CMD | ssh llevague@127.0.0.1


## UPDATE Schema Doctrine
CMD="su www-data ; "
CMD="$CMD cd  ${REPERTOIRE_JENKINS}/website ; "
CMD="$CMD echo 'drop database formation' | mysql --user=formation --password=formation --host=db ; "
CMD="$CMD php app/console doctrine:database:create ; "
CMD="$CMD php app/console doctrine:schema:update --force ; "
CMD="$CMD php app/console doctrine:fixtures:load --fixtures=src/Societe/Application/MonBundle/Tests/DataFixtures ; "

echo $CMD

echo $CMD | ssh llevague@127.0.0.1


## Modification des parameters pour la production (Information dans le virtualhost apache)"
#CMD="cd ${REPERTOIRE_JENKINS}/website ; "
#CMD="$CMD ant prod-parameters ; "

#echo $CMD | ssh llevague@127.0.0.1


## Redémarrage des containers
#CMD="docker restart db web"

#echo $CMD | ssh llevague@127.0.0.1







