<?php

// if you don't want to setup permissions the proper way, just uncomment the following PHP line
// read http://symfony.com/doc/current/book/installation.html#configuration-and-setup for more information
//umask(0000);

// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], array(
        '127.0.0.1',
        '::1',
    ))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

require_once __DIR__.'/../app/bootstrap.php.cache';
require_once __DIR__.'/../app/AppKernel.php';

use Symfony\Component\HttpFoundation\Request;

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$response = $kernel->handle(Request::createFromGlobals());

if ($response->getStatusCode() !== 404)
{
  $response->send();
}
else
{
    $doctrine = $kernel->getContainer()->get('doctrine');
    $conn = $doctrine->getConnection($doctrine->getDefaultConnectionName());
    define('DB_NAME',       $conn->getDatabase());
    define('DB_USER',       $conn->getUsername());
    define('DB_PASSWORD',   $conn->getPassword());
    define('DB_HOST',       $conn->getHost());
    define('DB_CHARSET',    'utf8');
    define('DB_COLLATE',    '');
    define('WP_USE_THEMES', false);
    require('./wp-blog-header.php');
    render_wordpress_twig_template($kernel);
}

