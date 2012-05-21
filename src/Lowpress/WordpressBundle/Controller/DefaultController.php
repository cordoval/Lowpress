<?php

namespace Lowpress\WordpressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{

    public function indexAction()
    {
        $docroot = $this->getRequest()->server->get('DOCUMENT_ROOT');
        require($docroot.'/wp-blog-header.php');
        return new \Symfony\Component\HttpFoundation\Response();
    }
}
