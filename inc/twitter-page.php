<?php
class Twitter_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'twitter_widget',
            __('Twitter Widget', 'figma-wordpress-theme'),
            array('description' => __('Display tweets from a Twitter user', 'figma-wordpress-theme'),)
        );
    }

    public function widget($args, $instance)
    { ?>
        <blockquote class="tweet-container" id="twitter-container">
            <?php

            $username = $instance['username'];

            // Fetch oEmbed data from Twitter's API with hide_media parameter
            $url = "https://publish.twitter.com/oembed?url=https://twitter.com/" . $username;
            $json = file_get_contents($url);

            $data = json_decode($json, true);
            $html = $data['html'];

            // Output the extracted HTML
            echo $html;
            ?>
        </blockquote>
    <?php }


    public function form($instance)
    {
        $username = !empty($instance['username']) ? $instance['username'] : __('Enter Correct Twitter Username', 'figma-wordpress-theme');
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter Username:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>">
        </p>

<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['username'] = (!empty($new_instance['username'])) ? sanitize_text_field($new_instance['username']) : '';
        return $instance;
    }
}

function register_twitter_widget()
{
    register_widget('Twitter_Widget');
}
add_action('widgets_init', 'register_twitter_widget');
