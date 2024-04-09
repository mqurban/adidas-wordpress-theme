<?php
require_once get_template_directory() . '/inc/geoplugin.class/geoplugin.class.php';

class Weather_Report extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'Weather_Report',
            __('Weather Report', 'W_R'),
            array('description' => __('Display Weather Report based on user location', 'W_R'),)
        );
    }

    public function widget($args, $instance)
    {
        $city = $instance['city'];
        $state = $instance['state'];
        $options = array(
            'use_geolocation' => $instance['use_geolocation'] ? true : false,

        );

        echo $args['before_widget'];

        echo $this->getWeather($city, $state, $options);

        echo $args['after_widget'];
    }


    public function form($instance)
    {
        $title = $instance['title'];
        $city = $instance['city'];
        $state = $instance['state'];
        $use_geolocation = $instance['use_geolocation'];
        $show_humidity = $instance['show_humidity'];
        $temp_type = $instance['temp_type'];
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['use_geolocation'], 'on'); ?> id="<?php echo $this->get_field_id('use_geolocation'); ?>" name="<?php echo $this->get_field_name('use_geolocation'); ?>" />
            <label for="<?php echo $this->get_field_id('use_geolocation');  ?>">Use Geolocation</label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('city'); ?>"><?php _e('City'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" type="text" value="<?php echo esc_attr($city); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('state'); ?>"><?php _e('State:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('state'); ?>" name="<?php echo $this->get_field_name('state'); ?>" type="text" value="<?php echo esc_attr($state); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('temp_type'); ?>"><?php _e('Temperature Type'); ?></label>
            <select name="<?php echo $this->get_field_name('temp_type'); ?>" id="<?php echo $this->get_field_id('temp_type'); ?>" class="widefat" type="text">
                <option value="Fahrenheit'<?php echo ($temp_type == 'Fahrenheit') ? 'selected' : ''; ?>'">Fahrenheit</option>
                <option value="Celsius'<?php echo ($temp_type == 'Celsius') ? 'selected' : ''; ?>'">Celsius</option>
            </select>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_humidity'], 'on'); ?> id="<?php echo $this->get_field_id('show_humidity'); ?>" name="<?php echo $this->get_field_name('show_humidity'); ?>" />
            <label for="<?php echo $this->get_field_id('show_humidity');  ?>">Show Humidity</label>
        </p>
        <?php }

    public function update($new_instance, $old_instance)
    {

        $instance =  array(

            'title' => (!empty($new_instance['title']) ? strip_tags(($new_instance['title'])) : ''),
            'city' => (!empty($new_instance['city']) ? strip_tags(($new_instance['city'])) : ''),
            'state' => (!empty($new_instance['state']) ? strip_tags(($new_instance['state'])) : ''),
            'use_geolocation' => (!empty($new_instance['use_geolocation']) ? strip_tags(($new_instance['use_geolocation'])) : ''),
            'show_humidity' => (!empty($new_instance['show_humidity']) ? strip_tags(($new_instance['show_humidity'])) : ''),
            'temp_type' => (!empty($new_instance['temp_type']) ? strip_tags(($new_instance['temp_type'])) : ''),

        );

        return $instance;
    }

    // Get and display Weather 

    public function getWeather($city, $state, $options)
    {

        // GeoPlugin Init  will automatically detect user location and show weather 
        // $geoplugin = new geoPlugin();
        // $geoplugin->locate();

        // if ($options['use_geolocation']) {
        //     $city = $geoplugin->city;
        // }

        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "," . urlencode($state) . "&appid=294e39394786d918382601972ea071b7";
        // Fetch weather data from API
        $weatherData = file_get_contents($url);

        // Check if data was fetched successfully
        if ($weatherData) {
            $weatherInfo = json_decode($weatherData, true);

            if (isset($weatherInfo['weather'][0]['description'])) {
                $weatherCondition = $weatherInfo['weather'][0]['description'];
                $weatherIcon = $weatherInfo['weather'][0]['icon']; // Icon code

                $location = $weatherInfo['name'];
                $state = $weatherInfo['sys']['country'];
                $currentYear = date("y");
                $currentDate = date("D n.") . $currentYear;
                $currentTimeUnix = $weatherInfo['dt'];
                $timezoneOffset = $weatherInfo['timezone'];
                $currentTime = date("H:i", $currentTimeUnix + $timezoneOffset);
                $temp = floor($weatherInfo['main']['temp'] - 273.15);
                $minTemp = floor($weatherInfo['main']['temp_min'] - 273.15);
                $maxTemp = floor($weatherInfo['main']['temp_max'] - 273.15);   ?>

                <div class="weather-box">
                    <div class="first-sec">
                        <div class="weather-icon">
                            <img src='<?php echo "http://openweathermap.org/img/wn/$weatherIcon.png" ?>' alt='Weather Icon'><br><br>
                        </div>
                        <div class="weather-text">
                            <p><?php echo $currentDate; ?></p>
                            <h2><?php echo $currentTime; ?></h2>
                            <p><?php echo $location; ?></p>

                        </div>
                    </div>


                    <div class="second-sec">
                        <div class="weather-temp">
                            <h2><?php echo $temp . "°"; ?></h2>
                            <p><?php echo $minTemp; ?>~<?php echo $maxTemp . "°"; ?></p>
                            <p><?php echo $weatherCondition; ?></p>
                        </div>
                        <div class="next-weather">
                            <?php
                            $apiKey = "294e39394786d918382601972ea071b7";
                            $url = "https://api.openweathermap.org/data/2.5/forecast?q=" . urlencode($city) . "," . urlencode($state) . "&appid={$apiKey}&units=metric";

                            $forecastData = file_get_contents($url);

                            if ($forecastData) {
                                $forecastInfo = json_decode($forecastData, true);
                            ?>
                                <div class="single-w">
                                    <?php
                                    for ($i = 1; $i < 4; $i++) {
                                        $dayForecast = $forecastInfo['list'][$i * 8]; // Assuming weather data is available every 3 hours
                                        $date = date('D', strtotime($dayForecast['dt_txt']));
                                        $icon = $dayForecast['weather'][0]['icon'];
                                        $minTemp = floor($dayForecast['main']['temp_min']);
                                        $maxTemp = floor($dayForecast['main']['temp_max']);
                                    ?>
                                        <div class="daily-forecast">
                                            <p><?php echo $date; ?></p>
                                            <img src="http://openweathermap.org/img/wn/<?php echo $icon; ?>.png" alt="Weather Icon">
                                            <p><?php echo $minTemp; ?>/<?php echo $maxTemp . "°"; ?></p>
                                        </div>
                                    <?php } ?>
                                </div> <?php
                                    } else {
                                        echo "Failed to fetch forecast data.";
                                    }

                                        ?>
                        </div>
                    </div>
                </div>

<?php
            } else {
                echo "Weather condition not available.";
            }
        } else {
            echo "Failed to fetch weather data.";
        }
    }
}

function register_weather_report()
{
    register_widget('Weather_Report');
}
add_action('widgets_init', 'register_weather_report');






// $url = "https://api.openweathermap.org/data/2.5/weather?q=Lahore, Punjab &appid=294e39394786d918382601972ea071b7";
