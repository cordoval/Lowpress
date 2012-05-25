<?php
    /*
    Plugin Name: Sample Symfony Widget
    Plugin URI: http://www.lowpress.com
    Description: Sample Symfony Widget
    Author: Mikee Franklin
    Version: 1.0
    Author URI: http://www.lowpress.com
    */


class Example_Symfony_Widget extends WP_Widget
{
  function Example_Symfony_Widget()
  {
    $widget_ops = array('classname' => 'Example_Symfony_Widget', 'description' => 'My Sample Symfony Widget Description');
    $this->WP_Widget('Example_Symfony_Widget', 'Symfony Widget', $widget_ops);
  }

  function form($instance)
  {
    $instance = wp_parse_args((array) $instance, array( 'title' => '' ));
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }

  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

  function widget($args, $instance)
  {
    global $kernel;
    echo $kernel->getContainer()->get('templating.helper.actions')->render('LowpressTestBundle:Default:widget', array_merge($args, array('instance'=>$instance)));
  }
}

add_action( 'widgets_init', create_function('', 'return register_widget("Example_Symfony_Widget");') );

?>
