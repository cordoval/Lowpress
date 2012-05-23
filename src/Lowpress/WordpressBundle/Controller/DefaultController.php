<?php

namespace Lowpress\WordpressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{

    public function indexAction()
    {

        $docroot = $this->getRequest()->server->get('DOCUMENT_ROOT');

        extract($GLOBALS);

        require($docroot.'/wp-blog-header.php');

        $parameters = array_merge($wp_query->query_vars, array(
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
        ));

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

        return $this->render($template, $parameters);
    }
}
