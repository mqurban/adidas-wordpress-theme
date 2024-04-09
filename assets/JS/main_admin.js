document.addEventListener("DOMContentLoaded", function () {
    // Counter to keep track of the number of slides
    let slideCounter = 1;

    // Function to add slide fields
    function addSlide() {
        slideCounter++;
        const slideFields = document.querySelector(".slide-fields");
        const newSlideFields = slideFields.cloneNode(true);
        newSlideFields.querySelectorAll(".form-control").forEach(input => {
            input.value = ""; // Clear input values for new slide
            input.setAttribute("id", input.getAttribute("id") + slideCounter);
            input.setAttribute("name", input.getAttribute("name").replace("1", slideCounter));
        });
        slideFields.parentNode.appendChild(newSlideFields);
    }

    // Function to remove last slide fields
    function removeSlide() {
        const slideFields = document.querySelectorAll(".slide-fields");
        if (slideFields.length > 1) {
            slideFields[slideFields.length - 1].remove();
        }
    }

    // Add event listener for the "Add Another Slide" button
    document.querySelector(".add-slide").addEventListener("click", addSlide);

    // Add event listener for the "Remove Last Slide" button
    document.querySelector(".remove-slide").addEventListener("click", removeSlide);
});




// Image upload functionality in admin panel
jQuery(document).ready(function ($) {
    // Handler for upload-image button click
    $(".upload-image").click(function (event) {
        event.preventDefault();
        var button = $(this);
        var imageInput = $('#' + button.data('target'));

        // Create a media frame
        var frame = wp.media({
            title: 'Select or Upload Image',
            button: {
                text: 'Use this image'
            },
            multiple: false // Set to true if you want to allow multiple image selection
        });

        // When an image is selected, run a callback
        frame.on('select', function () {
            // Get the selected attachment
            var attachment = frame.state().get('selection').first().toJSON();

            // Set the selected image URL to the corresponding input field
            imageInput.val(attachment.url);

            // Update the image preview
            button.siblings('.image-preview').html('<img src="' + attachment.url + '" alt="Image Preview" style="max-width: 250px;">');
        });

        // Open the media frame
        frame.open();
    });
});







