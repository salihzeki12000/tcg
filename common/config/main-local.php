<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=tcg',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        // 'mailer' => [
        //     'class' => 'yii\swiftmailer\Mailer',
        //     'viewPath' => '@common/mail',
        //     // send all mails to a file by default. You have to set
        //     // 'useFileTransport' to false and configure a transport
        //     // for the mailer to send real emails.
        //     'useFileTransport' => true,
        // ],
        'authManager' => [
              'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'mailer' => [ 
            'class' => 'yii\swiftmailer\Mailer', 
            'viewPath' => '@frontend/views/mail', 
            // send all mails to a file by default. You have to set 
            // 'useFileTransport' to false and configure a transport 
            // for the mailer to send real emails. 
            'useFileTransport' => false, 
            'transport' => [ 
              //这里如果你是qq的邮箱，可以参考qq客户端设置后再进行配置 http://service.mail.qq.com/cgi-bin/help?subtype=1&&id=28&&no=1001256
                'class' => 'Swift_SmtpTransport', 
                'host' => '', 
                'username' => '', 
                'password' => '', 
                'port' => '25', 
                // 'encryption' => 'tls', 
            ], 
            'messageConfig'=>[ 
                'charset'=>'UTF-8', 
                'from'=>['@'=>'test'] 
            ], 
        ],
    ],
];
