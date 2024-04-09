<?php
// Retrieve slide data
$slide_option = get_option('slide_data');

// Check if slide data is empty or not set
if (empty($slide_option)) {
    // Initialize slide data with default values for the first slide
    $slide_option = [
        'titles' => ['Default Title'],
        'descriptions' => ['Default Description'],
        'images' => ['Default Image URL'],
        'videos' => ['Default Video URL']
    ];
} else {
    // If slide data exists, ensure all fields have at least one value
    $slide_option['titles'] = !empty($slide_option['titles']) ? $slide_option['titles'] : [''];
    $slide_option['descriptions'] = !empty($slide_option['descriptions']) ? $slide_option['descriptions'] : [''];
    $slide_option['images'] = !empty($slide_option['images']) ? $slide_option['images'] : [''];
    $slide_option['videos'] = !empty($slide_option['videos']) ? $slide_option['videos'] : [''];
}

// Check if form is submitted
if (isset($_POST["save-slides"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle slide images
    if (!empty($_POST["slide_image"])) {
        foreach ($_POST["slide_image"] as $key => $image_url) {
            if (!empty($image_url)) {
                $slide_option['images'][$key] = $image_url;
            }
        }
    }

    // Update option data with submitted values
    $slide_option['titles'] = $_POST["slide_title"] ?? [];
    $slide_option['descriptions'] = $_POST["slide_description"] ?? [];
    $slide_option['videos'] = $_POST["slide_video"] ?? [];

    // Add or remove slides based on button clicks
    if (isset($_POST["add-slide"])) {
        // Add a new empty slide
        $slide_option['titles'][] = "";
        $slide_option['descriptions'][] = "";
        $slide_option['images'][] = "";
        $slide_option['videos'][] = "";
    } elseif (isset($_POST["remove-slide"])) {
        // Ensure there's always at least one slide
        if (count($slide_option['titles']) > 1) {
            // Remove the last slide
            array_pop($slide_option['titles']);
            array_pop($slide_option['descriptions']);
            array_pop($slide_option['images']);
            array_pop($slide_option['videos']);
        }
    }

    // Update the option with new data
    update_option('slide_data', $slide_option);
}
?>
<form action="" method="post" enctype="multipart/form-data" id="slide-form">
    <!-- Initial slide fields -->
    <div class="slide-fields">
        <?php for ($i = 0; $i < count($slide_option['titles']); $i++) { ?>
            <div class="mb-3">
                <label for="slideTitle<?php echo $i + 1; ?>" class="form-label">Slide Title</label>
                <input type="text" class="form-control slide-title" name="slide_title[]" id="slideTitle<?php echo $i + 1; ?>" aria-describedby="emailHelp" value="<?php echo $slide_option['titles'][$i]; ?>">
            </div>
            <div class="mb-3">
                <label for="slideDescription<?php echo $i + 1; ?>" class="form-label">Slide Description</label>
                <textarea class="form-control slide-description" name="slide_description[]" id="slideDescription<?php echo $i + 1; ?>" rows="3"><?php echo $slide_option['descriptions'][$i]; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="slideImage<?php echo $i + 1; ?>" class="form-label">Slide Image</label>
                <div>
                    <button type="button" class="btn btn-primary upload-image" data-target="slideImage<?php echo $i + 1; ?>">Upload Image</button>
                    <input type="hidden" id="slideImage<?php echo $i + 1; ?>" name="slide_image[]" value="<?php echo $slide_option['images'][$i]; ?>">
                    <div class="image-preview">
                        <?php if (!empty($slide_option['images'][$i])) { ?>
                            <div class="image-preview" style="background-image: url('<?php echo esc_url($slide_option['images'][$i]); ?>');"></div>
                        <?php } ?>
                    </div>
                </div>
            </div>


            <div class="mb-3">
                <label for="slideVideo<?php echo $i + 1; ?>" class="form-label">Slide Video URL</label>
                <input type="text" class="form-control slide-video" name="slide_video[]" id="slideVideo<?php echo $i + 1; ?>" aria-describedby="emailHelp" value="<?php echo $slide_option['videos'][$i]; ?>">
            </div>
            <?php if ($i > 0) { ?> <!-- Check if it's not the first slide -->
                <button type="submit" class="btn btn-danger" name="remove-slide">Remove Slide <?php echo $i + 1; ?></button>
            <?php } ?>
        <?php } ?>
    </div>

    <!-- Buttons to add slide field -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary" name="add-slide">Add Another Slide</button>
    </div>

    <!-- Save button -->
    <button type="submit" class="btn btn-primary" name="save-slides">Save</button>
</form>
<hr>