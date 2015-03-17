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
cd /tmp/matrix-backend

if [ ! -z ${BRANCHE} ] 
then
	echo "Déplacement Branche $BRANCHE"
	git checkout 
	git pull 

	echo "Tag"
	git tag -a $VERSION -m "Matrix Backend $BRANCHE "
	git push origin $VERSION
else
	echo "Déplacement Branche Master"
	git checkout master
	git pull

	echo "Merge Branch Develop > Master"
	git merge origin/develop
	git push origin master

	echo "Tag"
	git tag -a $VERSION -m "Matrix Backend master "
	git push origin $VERSION
fi




# Construction du livrable Backend
echo "> Construction du livrable Backend"

cd /tmp/matrix-backend/website
composer update
composer install
cd /tmp
# Suppression du mode dev
rm -f matrix-backend/website/web/app_dev.php

tar zcf matrix-backend-$VERSION.tgz matrix-backend --exclude="photo/**/*"

###########################################
#
# FRONTEND
#
###########################################


# Construction du livrable Frontend

# Tag Frontend
echo "> Tag Frontend"
cd /tmp
rm -rf matrix-frontend
git clone https://jenkins:j3nk1ns0@redmine.softeam.fr/git/matrix-frontend.git
cd /tmp/matrix-frontend

if [ ! -z ${BRANCHE} ] 
then
	echo "Déplacement Branche $BRANCHE"
	git checkout $BRANCHE
	git pull 
	echo "Tag"
	git tag -a $VERSION -m "Matrix Frontend $BRANCHE"
	git push origin $VERSION
else
	echo "Déplacement Branche Master"
	git checkout master
	git pull

	echo "Merge Branch Develop > Master"
	git merge origin/develop
	git push origin master

	echo "Tag"
	git tag -a $VERSION -m "Matrix Frontend master"
	git push origin $VERSION
fi


# Construction du livrable Frontend
echo "> Construction du livrable Frontend"

cd /tmp/matrix-frontend
npm install
bower install
bower update
gulp clean
gulp build --env prod
cd /tmp
tar zcf matrix-frontend-$VERSION.tgz matrix-frontend


