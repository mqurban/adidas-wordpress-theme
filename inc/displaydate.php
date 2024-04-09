<?php

// register display_date widget
function register_display_date_widget()
{
    register_widget('display_date');
}
add_action('widgets_init', 'register_display_date_widget');

/**
 * Adds display_date widget.
 */
class display_date extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'date_time_widget',
            __('Date & Time', 'D_T'),
            array('description' => __('Display Date and Time of a specific city', 'D_T'),)
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        $city2 = $instance['city2']; // Changed variable name to city2

        echo $args['before_widget'];

        echo $this->displayDate($city2);

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {
        $city2 = !empty($instance['city2']) ? $instance['city2'] : 'Lahore'; // Changed variable name to city2

?>
        <p>
            <label for="<?php echo $this->get_field_id('city2'); ?>"><?php _e('City2'); ?></label> <!-- Changed label to City2 -->
            <input class="widefat" id="<?php echo $this->get_field_id('city2'); ?>" name="<?php echo $this->get_field_name('city2'); ?>" type="text" value="<?php echo esc_attr($city2); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array(
            'city2' => (!empty($new_instance['city2']) ? strip_tags(($new_instance['city2'])) : ''), // Changed variable name to city2
        );

        return $instance;
    }
    public function displayDate($city2)
    {
        $url2 = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city2) . "&appid=294e39394786d918382601972ea071b7"; // Changed variable name to url2

        $weatherData2 = file_get_contents($url2); // Changed variable name to weatherData2

        if ($weatherData2) { // Changed variable name to weatherData2
            $weatherInfo2 = json_decode($weatherData2, true); // Changed variable name to weatherInfo2

            $currentTimeUnix = time() + $weatherInfo2['timezone']; // Changed variable name to weatherInfo2
            $formattedDate2 = date("l, j F, Y", $currentTimeUnix); // Changed variable name to formattedDate2
            $formattedTime2 = date("H:i:s", $currentTimeUnix); // Changed variable name to formattedTime2
        ?>
            <div class="date-time">
                <p><?php echo $formattedDate2; ?></p>
                <h3><?php echo $formattedTime2; ?></h3>
            </div>

<?php
        } else {
            echo "Failed to fetch weather data."; // Adjusted error message
        }
    }
}
