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
          global $kernel, $posts, $post, $wp_did_header, $wp_did_template_redirect, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

          if ($symfony_template = get_symfony_template_name($_template_file))
          {
            $kernel
              ->getContainer()
              ->get('twig')
              ->loadTemplate($symfony_template)
              ->display(array_merge($wp_query->query_vars, array(
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
            return true;
          }
          return load_template_old($_template_file, $require_once);
        }
      }
    }



?>