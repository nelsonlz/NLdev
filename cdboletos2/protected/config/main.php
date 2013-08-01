<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'CdBoleto',
	'theme'=>'bootstrap',
                  'language' => 'pt_br',
//                  'sourceLanguage'=>'pt',
	// preloading 'log' component
	'preload'=>array('log',
                        'bootstrap'
                ),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'cordon',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                                                     'generatorPaths'=>array(
                                                                                        'bootstrap.gii',
                                                    ),
		),
		
	),

	// application components
	'components'=>array(
		
		'bootstrap'=>array(
                                        'class'=>'bootstrap.components.Bootstrap',
                                        'responsiveCss'=>true,
                                    ),
            
                                    'mailer' => array(
                                          'class' => 'application.extensions.mailer.EMailer',
                                          'pathViews' => 'application.views.email',
                                          'pathLayouts' => 'application.views.email.layouts'
                                   ),
		
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/admin',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                                                                        '<controller:\w+>/<action:\w+>/<id:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
                                    */
                 
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=CdBoletoNovo',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'master',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'nelson@scordon.com.br',
	),
);