#!/bin/sh

DESTDIR=/var/www/html/lolable-staging
GITURL=https://github.com/dbertouille/lolable

# Clean up existing staging
rm -fr $DESTDIR
mkdir $DESTDIR

# Checkout repo into temp directory
tmpdir=`mktemp -d`
git clone $GITURL $tmpdir

# Move files into staging
# Link to production data since we use the same database
cp -r $tmpdir/www/* $DESTDIR
ln -s /var/www/html/lolable/comics $DESTDIR/comics
ln -s /var/www/html/lolable/avatars $DESTDIR/avatars
ln -s /var/www/html/lolable/podcasts $DESTDIR/podcasts

# Cleanup
rm -fr $tmpdir
