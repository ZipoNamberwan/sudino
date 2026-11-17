<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
	'name' => 'Agen Sudino',
	'language' => 'id',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => array_merge(
            ['csrfParam' => '_csrf-frontend'],
            // Public URL when running behind a reverse proxy (FRONTEND_URL in .env).
            // Left empty, Yii detects host and path from the incoming request.
            env('FRONTEND_URL') ? (function ($url) {
                $parts = parse_url(rtrim($url, '/'));
                $baseUrl = isset($parts['path']) ? $parts['path'] : '';
                return [
                    'hostInfo' => $parts['scheme'] . '://' . $parts['host'] . (isset($parts['port']) ? ':' . $parts['port'] : ''),
                    'baseUrl' => $baseUrl,
                    'scriptUrl' => $baseUrl . '/index.php',
                ];
            })(env('FRONTEND_URL')) : []
        ),
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		'view' => [
			'theme' => [
				'basePath' => '@app/themes/wonder',
				'baseUrl' => '@web',
			],
		],
        'urlManager' => [
            /*'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
            */
        ],
    ],	
	'modules' => [
		'gridview' =>  [
			'class' => '\kartik\grid\Module',
		],
	],
    'params' => $params,
];
