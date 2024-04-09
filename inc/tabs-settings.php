<?php
// Retrieve tab data
$tab_option = get_option('tab_data');
if (empty($tab_option)) {
    $tab_option = [
        'title' => [''],
        'description' => ['']
    ];
}
// Check if form is submitted
if (isset($_POST["save-tabs"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle tab data
    for ($i = 0; $i < 3; $i++) {
        // Update option data with submitted values for each tab
        $tab_option['title'][$i] = isset($_POST["tab_title"][$i]) ? sanitize_text_field($_POST["tab_title"][$i]) : '';
        $tab_option['description'][$i] = isset($_POST["tab_description"][$i]) ? sanitize_textarea_field($_POST["tab_description"][$i]) : '';
    }

    // Update the option with new tab data
    update_option('tab_data', $tab_option);
}
?>

<form action="" method="post" id="tab-form">
    <!-- Tab fields -->
    <div class="tab-fields">
        <?php for ($i = 0; $i < 3; $i++) { ?>
            <div class="mb-3">
                <label for="tabTitle<?php echo $i + 1; ?>" class="form-label">Tab <?php echo $i + 1; ?> Title</label>
                <input type="text" class="form-control tab-title" name="tab_title[]" id="tabTitle<?php echo $i + 1; ?>" value="<?php echo isset($tab_option['title'][$i]) ? $tab_option['title'][$i] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="tabDescription<?php echo $i + 1; ?>" class="form-label">Tab <?php echo $i + 1; ?> Description</label>
                <textarea class="form-control tab-description" name="tab_description[]" id="tabDescription<?php echo $i + 1; ?>" rows="3"><?php echo isset($tab_option['description'][$i]) ? $tab_option['description'][$i] : ''; ?></textarea>
            </div>
        <?php } ?>
    </div>

    <!-- Save button -->
    <button type="submit" class="btn btn-primary" name="save-tabs">Save</button>
</form>