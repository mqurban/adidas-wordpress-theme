<?php
get_header();
?>

<body <?php body_class(); ?>>
    <div id="carouselExampleDark" class="carousel carousel-white slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $slide_option = get_option('slide_data');
            if (!empty($slide_option) && is_array($slide_option['images'])) {
                foreach ($slide_option['images'] as $key => $image) { ?>
                    <div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>" data-bs-interval="10000">
                        <div class="slide-item" style="filter:brightness(50%);background-image: url('<?php echo esc_url($image); ?>');">
                            <img src="<?php echo esc_url($image); ?>" class="d-block w-100" alt="Slide Image">
                        </div>
                        <div id="slider-items" class="carousel-caption d-none d-md-block">
                            <h5><?php echo esc_html($slide_option['titles'][$key]); ?></h5>
                            <p><?php echo esc_html($slide_option['descriptions'][$key]); ?></p>
                            <i class="fas fa-play" id="play-button"></i>
                            <?php
                            $video_url = substr($slide_option['videos'][$key], -11);
                            ?>
                            <iframe id="link-check" width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_attr($video_url); ?>" frameborder="0" allowfullscreen></iframe>
                            <i class="fas fa-times" id="close-button">Close</i>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/1000x1000" class="d-block w-100" alt="Placeholder Image">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Default Slide Title</h5>
                        <p>Default Slide Description</p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <!-- set indicators color white  -->
        <div class="carousel-indicators">
            <?php
            // If slide data is available, create indicators
            if (!empty($slide_option) && is_array($slide_option['images'])) {
                // Loop through each slide
                foreach ($slide_option['images'] as $key => $image) { ?>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?php echo $key; ?>" class="<?php echo ($key == 0) ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $key + 1; ?>"></button>
                <?php }
            } else { ?>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <?php } ?>
        </div>
    </div>
    <!-- responsive div with full width and height 100vh -->
    <div class="container-fluid" id="main-div">
        <div class="left-container">
            <div class="post-slider"> <!-- start of post-slider -->
                <?php
                $post_slider = new WP_Query(array(
                    'post_type' => 'slider',
                    'posts_per_page' => -1,
                )); ?>

                <div class="slider-container">
                    <i class="fa fa-chevron-left" aria-hidden="true" id="prevBtn"></i>
                    <div class="loop-main" id="slider">
                        <?php
                        $i = 1;
                        while ($post_slider->have_posts()) {
                            $post_slider->the_post()
                        ?>
                            <div id="single-<?php echo $i; ?>" class="single-post">
                                <div class="post-thumbnail">
                                    <?php echo get_the_post_thumbnail();  ?>
                                </div>
                                <div class="post-title" style="margin-left: 5px;">
                                    <a href="<?php the_permalink(); ?>">
                                        <h6><?php the_title(); ?></h6>
                                    </a>
                                </div>
                                <!-- <div>
                                    <a href="#single-<?php echo $i; ?>">
                                        <hr style="width: 40%; height: 4px; margin: 20px 10px; background-color: #fff; ">
                                    </a>
                                </div> -->
                            </div>
                        <?php
                            $i++;
                        }
                        ?>
                    </div>
                    <i class="fa fa-chevron-right" aria-hidden="true" id="nextBtn"></i>
                </div> <!-- Main div for loop -->
                <hr class="hr-line"> <!-- horizontal line below post slider  -->
            </div> <!-- end of post-slider -->


            <div class="sticky-post"> <!-- sticky-post-container -->

                <?php
                $random_post = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 1,
                    'orderby' => 'rand'
                ));
                while ($random_post->have_posts()) {
                    $random_post->the_post() ?>
                    <div class="sp-text">
                        <h4>
                            <h4><?php echo strtoupper(wp_trim_words(get_the_title(), 6)); ?></h4>
                        </h4>
                        <p><?php echo wp_trim_words(get_the_content(), 14); ?></p>
                    </div>
                    <div class="sp-image">
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="latest-post" />
                    </div>
                <?php }
                ?>
            </div> <!-- sticky-post-container-end -->

            <div class="recent-posts"> <!-- recent-posts-container-start -->

                <?php
                $recent_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));

                while ($recent_posts->have_posts()) {
                    $recent_posts->the_post()  ?>

                    <div class="srp">
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" />
                        <h4><?php echo strtoupper(wp_trim_words(get_the_title(), 6, '')); ?></h4>
                        <p><?php echo wp_trim_words(get_the_content(), 14); ?></p>
                        <a href="<?php the_permalink(); ?>">Read More</a>
                    </div>

                <?php }
                wp_reset_postdata();
                ?>
            </div> <!-- recent-posts-container-end -->
            <div class="page-headings">
                <h1 id="tw-h">Latest Tweets</h1>
                <h1 id="fb-h">Facebook Page</h1>
            </div>

            <div class="social-pages"><!-- fb, twitter page container start  -->
                <div class="page1">
                    <div class="content">

                        <?php
                        //  dynamic_sidebar('sidebar-2');
                        ?>
                        <!-- USE VPN TO SEE TWEETS IF TWITTER IS NOT ALLOWED IN YOUR COUNTRY  -->

                    </div>
                </div>
                <div class="page1">
                    <div class="content">
                        <?php
                        // dynamic_sidebar('sidebar-1');
                        ?>
                    </div>
                </div>
            </div>

        </div> <!-- end of left-container -->

        <div class="right-container"> <!-- start of right-container -->

            <div class="sidebar1">
                <h1>Events</h1>
                <div id="events-container" class="events-container">
                    <!-- Events will be loaded here with AJAX-->
                    <!-- Code Part is in inc/event-post.php  -->
                </div>
                <div class="event-bottom">
                    <div class="pag-btns">
                        <i class="fa fa-chevron-left" aria-hidden="true" data-direction="prev" id="prev-btn"></i>
                        <i class="fa fa-chevron-right" aria-hidden="true" data-direction="next" id="next-btn"></i>
                    </div>
                    <div class="more-event">
                        <p>More Events</p>
                    </div>
                </div>
            </div>



            <div class="sidebar1">
                <h1>Categories</h1>
                <div class="categories">
                    <ul>
                        <?php
                        $categories = get_categories(
                            array(
                                'number' => 5
                            )
                        );

                        if ($categories) {
                            foreach ($categories as $category) { ?>
                                <div class="single-cat">
                                    <img src="<?php echo get_theme_file_uri('/assets/images/icon-list.png') ?>" alt="" /><a href="<?php echo get_category_link($category->term_id); ?>"> <?php echo $category->name;  ?></a><br>
                                </div>
                        <?php }
                        } else {
                            echo '<p>No categories found.</p>';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="sidebar1">
                <h1>Weather</h1>
                <div class="weather">
                    <?php
                    //  dynamic_sidebar('sidebar-3'); 
                    ?>

                </div>

            </div>
            <div class="sidebar1">
                <h1>Date & Time</h1>
                <?php
                // dynamic_sidebar('sidebar-4'); 
                ?>

            </div>

        </div> <!-- end of right-container -->
    </div> <!-- end of main div  -->
    <?php
    $tab_option = get_option('tab_data');
    if (empty($tab_option)) {
        $tab_option = [
            'title' => [''],
            'description' => ['']
        ];
    }
    ?>
    <div class="tabs-main">
        <div class="tabs-inner">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="pill" href="#home"><?php echo $tab_option['title'][0]; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="pill" href="#menu1"><?php echo $tab_option['title'][1]; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="pill" href="#menu2"><?php echo $tab_option['title'][2]; ?></a>
                </li>

            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade show active">
                    <p>
                        <?php echo $tab_option['description'][0]; ?>
                    </p>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <p><?php echo $tab_option['description'][1]; ?></p>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <p><?php echo $tab_option['description'][2]; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
get_footer();
?>