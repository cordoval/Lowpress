<?php
    /*
    Plugin Name: Symfony2 Bridge
    Plugin URI: http://www.lowpress.com
    Description: Integrate Symfony2 and Wordpress
    Author: Mikee Franklin
    Version: 1.0
    Author URI: http://www.lowpress.com
    */

    function rename_template_functions()
    {
      $theme_file = ABSPATH . WPINC.'/theme.php';
      $contents = file_get_contents($theme_file);
      $contents = preg_replace("/function\s+(locate|load)_template(\s*)/", "function \\1_template_old\\2", $contents);
      file_put_contents($theme_file, $contents);
    }

    if (function_exists('locate_template') || function_exists('load_template'))
    {
      rename_template_functions();
    }
    else
    {

      function get_symfony_template_name($template_name)
      {
        global $kernel;
        $fileinfo = pathinfo($template_name);
        $templatename = 'LowpressWordpressBundle:Default:'.$fileinfo['filename'].'.html.twig';
        $template = '';

        try
        {
          if ($kernel->getContainer()->get('twig.loader')->getCacheKey($templatename))
          {
            return $templatename;
          }
        }
        catch(Exception $e)
        {
          return null;
        }
      }

      if (!function_exists('locate_template'))
      {
        function locate_template($template_names, $load = false, $require_once = true )
        {
          if (!is_array($template_names)) $template_names = array($template_names);
          foreach ($template_names as $template_name)
          {
            if($symfony_template = get_symfony_template_name($template_name))
            {
              if ($load)
              {
                return load_template($template_name, $require_once);
              }
              return $templatename;
            }
          }
          return locate_template_old($template_names, $load, $require_once);
        }
      }
      if (!function_exists('load_template'))
      {
        function load_template( $_template_file, $require_once = true )
        {
          if ($symfony_template = get_symfony_template_name($_template_file))
          {
            global $kernel;
            render_twig_include($kernel->getContainer()->get('twig'), $symfony_template);
            return true;
          }
          return load_template_old($_template_file, $require_once);
        }
      }
    }

    function render_wordpress_twig_template($kernel){


      $template = false;
      if     (is_404()):            throw $this->createNotFoundException('The product does not exist');
      elseif (is_search()):         $template = 'LowpressWordpressBundle:Default:search.html.twig';
      elseif (is_tax()):            $template = 'LowpressWordpressBundle:Default:taxonomy.html.twig';
      elseif (is_front_page()):     $template = 'LowpressWordpressBundle:Default:front-page.html.twig';
      elseif (is_home()):           $template = 'LowpressWordpressBundle:Default:home.html.twig';
      elseif (is_attachment()):     $template = 'LowpressWordpressBundle:Default:attachment.html.twig';
                                    remove_filter('the_content', 'prepend_attachment');
      elseif (is_single()):         $template = 'LowpressWordpressBundle:Default:single.html.twig';
      elseif (is_page()):           $template = 'LowpressWordpressBundle:Default:page.html.twig';
      elseif (is_category()):       $template = 'LowpressWordpressBundle:Default:category.html.twig';
      elseif (is_tag()):            $template = 'LowpressWordpressBundle:Default:tag.html.twig';
      elseif (is_author()):         $template = 'LowpressWordpressBundle:Default:author.html.twig';
      elseif (is_date()):           $template = 'LowpressWordpressBundle:Default:date.html.twig';
      elseif (is_archive()):        $template = 'LowpressWordpressBundle:Default:archive.html.twig';
      elseif (is_comments_popup()): $template = 'LowpressWordpressBundle:Default:comments-popup.html.twig';
      elseif (is_paged()):          $template = 'LowpressWordpressBundle:Default:paged.html.twig';
      else :
        $template = 'LowpressWordpressBundle:Default:index.html.twig';
      endif;

      $container = $kernel->getContainer();

      $container->set('request', \Symfony\Component\HttpFoundation\Request::createFromGlobals());
      $container->enterScope('request');
      render_twig_include($container->get('twig'), $template);

    }

    function render_twig_include($twig, $template){

      global $posts, $post, $wp_did_header, $wp_did_template_redirect, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

      $twig->loadTemplate($template)->display(array_merge($wp_query->query_vars, array(
                  'posts'                     => $posts,
                  'post'                      => $post,
                  'wp_did_header'             => $wp_did_header,
                  'wp_did_template_redirect'  => $wp_did_template_redirect,
                  'wp_query'                  => $wp_query,
                  'wp_rewrite'                => $wp_rewrite,
                  'wpdb'                      => $wpdb,
                  'wp_version'                => $wp_version,
                  'wp'                        => $wp,
                  'id'                        => $id,
                  'comment'                   => $comment,
                  'user_ID'                   => $user_ID
     )));

    }
?>