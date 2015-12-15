ZF2 Rest Server Demo Application Module
======================================

Introduction
------------
This is a ZF2 Rest Server Demo Application Module using Doctrine. 

Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies:

    curl -s https://getcomposer.org/installer | php --

You would then invoke `composer` to install dependencies. Add to your composer.json

	"ledsinclouds/rest-server-demo": "dev-master"

Configuration
-------------

Once module installed, you could declare the module into your "config/application.config.php" by adding "LedsAlbum" & "Doctrine". 
	
        'Application',	
        'DoctrineModule',
		'DoctrineORMModule',
		'RestServerDemo'

Copy/Paste the configuration file and change configuration options according to your social accounts.
Note: You must create applications for that...

    cp vendor/ledsinclouds/rest-server-demo/config/doctrine.local.php.dist config/autoload/doctrine.local.php
	
Create your Database and:

	./vendor/bin/doctrine-module orm:validate-schema
	./vendor/bin/doctrine-module orm:schema-tool:update --force
