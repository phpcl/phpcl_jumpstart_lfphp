<?php

/**
 * Local configuration.
 *
 * Copy this file to `local.php` and change its settings as required.
 * `local.php` is ignored by git and safe to use for local and sensitive data like usernames and passwords.
 */

declare(strict_types=1);

return [
    'dependencies' => [
		'services' => [
			'db-config' => [
				'driver'   => 'pdo_mysql',
				'host'     => 'localhost',
				'dbname'   => 'jumpstart',
				'username' => 'jumpstart',
				'password' => 'password',
				'options'  => [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION],
			],
		],
	],
];
