<?php

namespace Lowpress\WordpressBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LowpressWordpressBundle extends Bundle
{

  public function boot()
  {
    $docroot = $this->container->getParameter('kernel.root_dir').'/../web/';

    $doctrine = $this->container->get('doctrine');
    $conn = $doctrine->getConnection($doctrine->getDefaultConnectionName());

    define('DB_NAME',       $conn->getDatabase());
    define('DB_USER',       $conn->getUsername());
    define('DB_PASSWORD',   $conn->getPassword());
    define('DB_HOST',       $conn->getHost());
    define('DB_CHARSET',    'utf8');
    define('DB_COLLATE',    '');

    define('WP_USE_THEMES', false);

    if (!defined('WP_STANDALONE') || !WP_STANDALONE)
      require_once($docroot.'wp-load.php');

    foreach(get_defined_vars() as $key => $val)
      $GLOBALS[$key] = $val;

    parent::boot();
  }
}
