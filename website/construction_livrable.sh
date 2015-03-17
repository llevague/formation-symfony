#!/bin/sh

##########################################################################
#            SCRIPT DE CREATION DE LIVRABLE :
#              - ARCHIVE DE RECETTE
#
##########################################################################

VERSION=$1
BRANCHE=$2

if [ -z ${VERSION} ] ; then echo VERSION is  empty; exit 12; fi


echo "Version : $VERSION"
echo "Branche : $BRANCHE"

###########################################
#
# BACKEND
#
###########################################

# Tag Backend
echo "> Tag Backend"
cd /tmp/formation-symfony

if [ ! -z ${BRANCHE} ] 
then
	echo "Déplacement Branche $BRANCHE"
	git checkout 
	git pull 

	echo "Tag"
	git tag -a $VERSION -m "$BRANCHE"
	git push origin $VERSION
else
	echo "Déplacement Branche Master"
	git checkout master
	git pull

	echo "Tag"
	git tag -a $VERSION -m "Master"
	git push origin $VERSION
fi




# Construction du livrable Backend
echo "> Construction du livrable Backend"

cd /tmp/formation-symfony/website
composer update
composer install
cd /tmp
# Suppression du mode dev
rm -f mformation-symfony/website/web/app_dev.php

tar zcf formation-symfony-$VERSION.tgz formation-symfony --exclude="photo/**/*"
