<?php

$general_options = get_option('general-settings');

$top_text = '';
$top_link = '';
if (is_array($general_options) && isset($top_text) && isset($top_link)) {
    $top_text = $general_options['top-text'];
    $top_link = $general_options['top-link'];
}


if (isset($_POST['general-save']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $top_text = isset($_POST['top-text']) ? sanitize_text_field(($_POST['top-text'])) : '';
    $top_link = isset($_POST['top-link']) ? sanitize_text_field(($_POST['top-link'])) : '';

    update_option('general-settings', array(
        'top-text' => $top_text,
        'top-link' => $top_link,
    ));
}
?>

<form action="" method="post">
    <div class="mb-3">
        <label for="top-text" class="form-label">Top Text</label>
        <input class="form-control" name="top-text" id="top-text" value="<?php echo esc_attr($top_text); ?>">
    </div>
    <div class="mb-3">
        <label for="top-link" class="form-label">Top link</label>
        <input class="form-control" name="top-link" id="top-link" value="<?php echo esc_attr($top_link); ?>">
    </div>
    <button class="btn btn-primary" name="general-save">Save</button>
</form>