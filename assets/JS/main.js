jQuery(document).ready(function ($) {
  // Initialize the toast with autohide disabled
  $('.toast').toast({
    autohide: false // Disable autohide
  });

  // Trigger the toast message
  $('.toast').toast('show');
});


// Post slider left right move

const slider = document.getElementById('slider');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

let scrollAmount = 0;
const scrollStep = 140;

prevBtn.addEventListener('click', () => {
  scrollAmount -= scrollStep;
  slider.scrollTo({
    left: scrollAmount,
    behavior: 'smooth'
  });
});

nextBtn.addEventListener('click', () => {
  scrollAmount += scrollStep;
  slider.scrollTo({
    left: scrollAmount,
    behavior: 'smooth'
  });
});


// Facebook Page SDk

// Facebook Page SDK
(function (d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



