<?php

namespace Lowpress\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('LowpressTestBundle:Default:index.html.twig');
    }

    public function widgetAction($instance)
    {
        return $this->render('LowpressTestBundle:Default:widget.html.twig', array('instance' => $instance));
    }
}
