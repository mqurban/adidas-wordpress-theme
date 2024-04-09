<?php
// Register Widget 
function register_facebook_page_plugin()
{
    register_widget('Facebook_Page_Plugin_Widget');
}

add_action('widgets_init', 'register_facebook_page_plugin');

// Widget Class 

class Facebook_Page_Plugin_Widget extends WP_Widget
{
    // Construct 
    public function __construct()
    {
        parent::__construct(
            'facebook_page_plugin_widget',  // Base ID
            __('Facebook Page Plugin', 'ffp-domain'), // Name
            array('description' => __('Shows a FAcebook page plugin in widget ', 'fpp-domain'))
        );
    }
    // Display Widget 
    public function widget($args, $instance)
    {
        $data = array();
        $data['page_url'] = esc_attr($instance['page_url']);
        $data['show_timeline'] = esc_attr($instance['show_timeline']);
        $data['width'] = esc_attr($instance['width']);
        $data['height'] = esc_attr($instance['height']);
        $data['adapt_container'] = esc_attr($instance['adapt_container']);
        $data['hide_cover'] = esc_attr($instance['hide_cover']);
        $data['use_small_header'] = esc_attr($instance['use_small_header']);
        $data['show_facepile'] = esc_attr($instance['show_facepile']);

        echo $args['before_widget'];
        echo $args['before_title'];

        // echo $instance['title'];

        // Get Main Content

        echo $this->getPagePlugin($data);

        // echo $args['after_title'];
        echo $args['after_widget'];
    }

    // Backend Widget Form 
    public function form($instance)
    {
        // Get title
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Like us on Facebook', 'fpp-domain');
        }

        // Get Page URL 
        if (isset($instance['page_url'])) {
            $page_url = $instance['page_url'];
        } else {
            $page_url = 'https://facebook.com/facebook';
        }
        // Get Adapt Container
        if (isset($instance['adapt_container'])) {
            $adapt_container = $instance['adapt_container'];
        } else {
            $adapt_container = 'true';
        }
        // Get width
        if (isset($instance['width'])) {
            $width = $instance['width'];
        } else {
            $width = 320;
        }
        // Get height
        if (isset($instance['height'])) {
            $height = $instance['height'];
        } else {
            $height = 300;
        }
        // Get show_timeline
        if (isset($instance['show_timeline'])) {
            $show_timeline = $instance['show_timeline'];
        } else {
            $show_timeline = 'true';
        }

        // Get show_facepile
        if (isset($instance['show_facepile'])) {
            $show_facepile = $instance['show_facepile'];
        } else {
            $show_facepile = 'true';
        }

        // Get use_small_header
        if (isset($instance['use_small_header'])) {
            $use_small_header = $instance['use_small_header'];
        } else {
            $use_small_header = 'false';
        }
        // Get hide_cover
        if (isset($instance['hide_cover'])) {
            $hide_cover = $instance['hide_cover'];
        } else {
            $hide_cover = 'true';
        }
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'fpp-domain') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('page_url'); ?>"><?php _e('Page URL', 'fpp-domain') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('page_url'); ?>" name="<?php echo $this->get_field_name('page_url'); ?>" type="text" value="<?php echo esc_attr($page_url); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('adapt_container'); ?>"><?php _e('Adapt Container', 'fpp-domain') ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('adapt_container'); ?>" name="<?php echo $this->get_field_name('adapt_container'); ?>" type="text" value="<?php echo esc_attr($adapt_container); ?>">
                <option value="true" <?php echo ($adapt_container == 'true') ? 'selected' : '' ?>>True
                <option value="false" <?php echo ($adapt_container == 'false') ? 'selected' : '' ?>>False

            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width', 'fpp-domain') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo esc_attr($width); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height', 'fpp-domain') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo esc_attr($height); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_timeline'); ?>"><?php _e('Show Timeline', 'fpp-domain') ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('show_timeline'); ?>" name="<?php echo $this->get_field_name('show_timeline'); ?>" type="text" value="<?php echo esc_attr($show_timeline); ?>">
                <option value="true" <?php echo ($show_timeline == 'true') ? 'selected' : '' ?>>True
                <option value="false" <?php echo ($show_timeline == 'false') ? 'selected' : '' ?>>False

            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('show_facepile'); ?>"><?php _e('Show facepile', 'fpp-domain') ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('show_facepile'); ?>" name="<?php echo $this->get_field_name('show_facepile'); ?>" type="text" value="<?php echo esc_attr($show_facepile); ?>">
                <option value="true" <?php echo ($show_facepile == 'true') ? 'selected' : '' ?>>True
                <option value="false" <?php echo ($show_facepile == 'false') ? 'selected' : '' ?>>False

            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('use_small_header'); ?>"><?php _e('Use Small Header', 'fpp-domain') ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('use_small_header'); ?>" name="<?php echo $this->get_field_name('use_small_header'); ?>" type="text" value="<?php echo esc_attr($use_small_header); ?>">
                <option value="true" <?php echo ($use_small_header == 'true') ? 'selected' : '' ?>>True
                <option value="false" <?php echo ($use_small_header == 'false') ? 'selected' : '' ?>>False

            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('hide_cover'); ?>"><?php _e('Hide Cover', 'fpp-domain') ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('hide_cover'); ?>" name="<?php echo $this->get_field_name('hide_cover'); ?>" type="text">
                <option value="true" <?php echo ($hide_cover == 'true') ? 'selected' : ''; ?>>True</option>
                <option value="false" <?php echo ($hide_cover == 'false') ? 'selected' : ''; ?>>False</option>
            </select>

        </p>
    <?php
    }



    // Update Values
    public function update($new_instance, $old_instance)
    {
        // Process widgets items to be saved
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['page_url'] = (!empty($new_instance['page_url'])) ? strip_tags($new_instance['page_url']) : '';
        $instance['adapt_container'] = (!empty($new_instance['adapt_container'])) ? strip_tags($new_instance['adapt_container']) : '';
        $instance['width'] = (!empty($new_instance['width'])) ? strip_tags($new_instance['width']) : '';
        $instance['height'] = (!empty($new_instance['height'])) ? strip_tags($new_instance['height']) : '';
        $instance['show_timeline'] = (!empty($new_instance['show_timeline'])) ? strip_tags($new_instance['show_timeline']) : '';
        $instance['show_facepile'] = (!empty($new_instance['show_facepile'])) ? strip_tags($new_instance['show_facepile']) : '';
        $instance['show_timeline'] = (!empty($new_instance['show_timeline'])) ? strip_tags($new_instance['show_timeline']) : '';
        $instance['use_small_header'] = (!empty($new_instance['use_small_header'])) ? strip_tags($new_instance['use_small_header']) : '';
        $instance['hide_cover'] = (!empty($new_instance['hide_cover'])) ? strip_tags($new_instance['hide_cover']) : '';




        return $instance;
    }
    // Show Fronte Content

    public function getPagePlugin($data)
    {
    ?>
        <div style="width: <?php echo $data['width']; ?>px;
        height:<?php echo $data['height']; ?>px;" class="fb-page" data-href="<?php echo $data['page_url']; ?>" <?php if ($data['show_timeline'] == 'true') :  ?> data-tabs="timeline" <?php endif;  ?> data-small-header="<?php echo $data['use_small_header']; ?>" <?php if (isset($data['adapt_container']) && $data['adapt_container'] == 'false') : ?> data-width="<?php echo $data['width']; ?>" data-height="<?php echo $data['height']; ?>" <?php else : ?> data-adapt-container-width="<?php echo $data['adapt_container']; ?>" <?php endif; ?> data-hide-cover="<?php echo $data['hide_cover']; ?>" data-show-facepile="<?php echo $data['show_facepile']; ?>">
        </div>
<?php
    }
}
