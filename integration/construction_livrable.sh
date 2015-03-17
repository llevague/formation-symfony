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

echo "> Tag Formation"
mkdir /tmp/formation
cd /tmp/formation

if [ ! -z ${BRANCHE} ] 
then
	echo "Déplacement Branche $BRANCHE"
	git checkout 
	git pull 

	echo "Tag"
	git tag -a $VERSION -m "Formation $BRANCHE "
	git push origin $VERSION
else
	echo "Déplacement Branche Master"
	git checkout master
	git pull

	echo "Merge Branch Develop > Master"
	git merge origin/develop
	git push origin master

	echo "Tag"
	git tag -a $VERSION -m "Formation master "
	git push origin $VERSION
fi

echo "> Construction du livrable Formation"

cd /tmp/formation/website
composer update
composer install
cd /tmp
# Suppression du mode dev
rm -f formation/website/web/app_dev.php

tar zcf formation-$VERSION.tgz formation --exclude="photo/**/*"





