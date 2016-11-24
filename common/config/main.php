<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
	'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@frontend/web/uploads/edt',
            'uploadUrl' => 'http://www.demo.com/uploads/edt',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
    ],
];
