<?php
namespace Lowpress\WordpressBundle\Twig;

class WordpressExtension extends \Twig_Extension {

    public function getFunctions() {
      return array(
          'lowpress_*' => new \Twig_Function_Method($this, 'wordpress_function')
        );
    }


    public function wordpress_function($name)
    {
      $args = func_get_args();
      array_shift($args);
      return call_user_func_array('\\'.$name, $args);
    }

    public function getName()
    {
        return 'wordpress_extension';
    }

}