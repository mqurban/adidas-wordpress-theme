  // Get all play buttons, link checks, and close buttons
  let playBtns = document.querySelectorAll(".fa-play");
  let linkChecks = document.querySelectorAll("#link-check");
  let closeBtns = document.querySelectorAll(".fa-times");

  playBtns.forEach(function(playBtn, index) {
      let videoUrl = linkChecks[index].getAttribute('src'); // Get the video URL

      if (videoUrl === "https://www.youtube.com/embed/") {
          playBtn.style.display = "none"; // Hide play button if video URL is empty
      } else {
          playBtn.addEventListener("click", function() {
              linkChecks[index].style.visibility = "visible";
              closeBtns[index].style.visibility = "visible";
          });
      }
  });

  // Add event listeners for both close text and close icon
  document.querySelectorAll('.fa-times').forEach(function(closeBtn) {
      closeBtn.addEventListener("click", function() {
          let parentSlide = closeBtn.closest('.carousel-item');
          parentSlide.querySelector('#link-check').style.visibility = "hidden";
          closeBtn.style.visibility = "hidden";
      });
  });