#!/bin/sh

##########################################################################
#            SCRIPT DE LIVRAISON EN INTEGRATION :
#              - INSTALLATION SUR LE SERVEUR D'INTEGRATION
#              - UPDATE Schema Doctrine
#
##########################################################################
REPERTOIRE_WWW="/data/htdocs"
REPERTOIRE_JENKINS="/data/webapps/jenkins.univ-rennes1.fr/conf/jobs/formation"

## INSTALLATION SUR LE SERVEUR D'INTEGRATION
#CMD="rm -rf ${REPERTOIRE_WWW} ; "
#CMD="$CMD mkdir ${REPERTOIRE_WWW} ; "
CMD="scp -r ${REPERTOIRE_JENKINS} tomcat@vmjava-pdevq1/${REPERTOIRE_WWW} ; "
#CMD="$CMD chown -R www-data:www-data ${REPERTOIRE_WWW} ; "
#CMD="$CMD chmod -R u+rw ${REPERTOIRE_WWW} ; "

#echo $CMD | ssh root@127.0.0.1


## UPDATE Schema Doctrine
#CMD="su www-data ; "
#CMD="$CMD cd  ${REPERTOIRE_JENKINS}/website ; "
#CMD="$CMD echo 'drop database matrix' | mysql --user=root --password=matrix --host=db ; "
#CMD="$CMD php app/console doctrine:database:create ; "
#CMD="$CMD php app/console doctrine:schema:update --force ; "
#CMD="$CMD php app/console doctrine:fixtures:load --fixtures=src/ICert/Matrix/RestAPIBundle/Tests/DataFixtures ; "
#
#echo $CMD | ssh root@127.0.0.1


## Modification des parameters pour la production (Information dans le virtualhost apache)"
#CMD="cd ${REPERTOIRE_JENKINS}/website ; "
#CMD="$CMD ant prod-parameters ; "

#echo $CMD | ssh root@127.0.0.1


## Redémarrage des containers
#CMD="docker restart db web"
#
#echo $CMD | ssh root@127.0.0.1







