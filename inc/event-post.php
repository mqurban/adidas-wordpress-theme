<?php


// Register Custom Post Type for Events   
// Backend Code 
function custom_event_post_type()
{
    $labels = array(
        'name'                  => __('Events'),
        'singular_name'         => __('Event'),
        'menu_name'             => __('Events'),
        'all_items'             => __('All Events'),
        'add_new_item'          => __('Add New Event'),
        'add_new'               => __('Add New'),
        'new_item'              => __('New Event'),
        'edit_item'             => __('Edit Event'),
        'update_item'           => __('Update Event'),
        'view_item'             => __('View Event'),
        'view_items'            => __('View Events'),
    );
    $args = array(
        'label'                 => __('Event'),
        'description'           => __('Post type for Events'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'public'                => true,
    );
    register_post_type('event', $args);
}
add_action('init', 'custom_event_post_type');


add_action('add_meta_boxes', 'add_custom_fields_meta_box');

function add_custom_fields_meta_box()
{
    add_meta_box(
        'custom_fields_meta_box',
        __('Event Details'),
        'render_custom_fields_meta_box',
        'event', // Replace with your custom post type slug
        'normal',
        'default'
    );
}

function render_custom_fields_meta_box($post)
{
    // Retrieve the existing value(s) for this meta box
    $event_date = get_post_meta($post->ID, 'event_date', true);
    $event_time_start = get_post_meta($post->ID, 'event_time_start', true);
    $event_time_end = get_post_meta($post->ID, 'event_time_end', true);


    // Display the form
?>
    <div class="events-form">
        <div class="form-group w-50">
            <label for="event_date"><?php _e('Event Date'); ?></label>
            <input type="date" class="form-control" id="event_date" name="event_date" value="<?php echo esc_attr($event_date); ?>">
        </div>

        <div class="form-group w-50">
            <label for="event_time_start"><?php _e('Start Time'); ?></label>
            <input type="time" class="form-control" id="event_time_start" name="event_time_start" value="<?php echo esc_attr($event_time_start); ?>">
        </div>

        <div class="form-group w-50">
            <label for="event_time_end"><?php _e('End Time'); ?></label>
            <input type="time" class="form-control" id="event_time_end" name="event_time_end" value="<?php echo esc_attr($event_time_end); ?>">
        </div>
    </div>
    <?php
}

add_action('save_post', 'save_custom_fields_meta_data');

function save_custom_fields_meta_data($post_id)
{
    // Sanitize and save the data
    if (isset($_POST['event_date'])) {
        update_post_meta($post_id, 'event_date', sanitize_text_field($_POST['event_date']));
    }

    if (isset($_POST['event_time_start'])) {
        update_post_meta($post_id, 'event_time_start', sanitize_text_field($_POST['event_time_start']));
    }

    if (isset($_POST['event_time_end'])) {
        update_post_meta($post_id, 'event_time_end', sanitize_text_field($_POST['event_time_end']));
    }
}



// Front End Code





// AJAX Requests
add_action('wp_ajax_load_events', 'load_events');
add_action('wp_ajax_nopriv_load_events', 'load_events');

function load_events()
{
    $paged = $_POST['paged'];

    $events_query = new WP_Query(array(
        'post_type'      => 'event',
        'posts_per_page' => 3,
        'paged'          => $paged,
    ));

    ob_start();

    if ($events_query->have_posts()) {
        while ($events_query->have_posts()) {
            $events_query->the_post();

            $post_id           = get_the_ID();
            $event_date        = get_post_meta($post_id, 'event_date', true);
            $event_time_start  = get_post_meta($post_id, 'event_time_start', true);
            $event_time_end    = get_post_meta($post_id, 'event_time_end', true); ?>

            <div class="single-event">
                <div class="event-image">
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" />
                </div>
                <div class="event-content">
                    <a href="<?php the_permalink(); ?>">
                        <h4><?php echo get_the_title(); ?></h4>
                    </a>
                    <p><?php echo $formatted_date = date('jS F, Y', strtotime($event_date)); ?></p>
                    <p><?php echo $start_time_formatted = date('h:iA', strtotime($event_time_start)); ?> - <?php echo $end_time_formatted = date('h:iA', strtotime($event_time_end)); ?></p>
                </div>
            </div>
<?php }
    }

    wp_reset_postdata();

    $content = ob_get_clean();
    echo $content;

    exit;
}


function enqueue_custom_scripts()
{
    // Enqueue your custom script
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/JS/custom-script.js', array('jquery'), '1.0', true);

    // Localize the ajaxurl variable
    wp_localize_script('custom-script', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
