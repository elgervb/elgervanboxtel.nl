$(function() {
  
});


// HERO module
$(document).ready(function() {
  
  function scaleVideoContainer() {

    var height = $(window).height() + 5;
    var unitHeight = parseInt(height, 10) + 'px';
    $('.homepage-hero-module').css('height', unitHeight);

  }
  
  function scaleBannerVideoSize(element) {
    var windowWidth = $(window).width();
    var windowHeight = $(window).height() + 5;
    var videoWidth, videoHeight;

    $(element).each(function() {
      var videoAspectRatio = $(this).data('height') / $(this).data('width');

      $(this).width(windowWidth);

      if (windowWidth < 1000) {
        videoHeight = windowHeight;
        videoWidth = videoHeight / videoAspectRatio;
        $(this).css({'margin-top': 0, 'margin-left': -(videoWidth - windowWidth) / 2 + 'px'});

        $(this).width(videoWidth).height(videoHeight);
      }

      $('.homepage-hero-module .video-container video').addClass('fadeIn animated');

    });
  }

  function initBannerVideoSize(element) {
    $(element).each(function() {
      $(this).data('height', $(this).height());
      $(this).data('width', $(this).width());
    });

    scaleBannerVideoSize(element);
  }

  scaleVideoContainer();

  initBannerVideoSize('.video-container .poster img');
  initBannerVideoSize('.video-container .filter');
  initBannerVideoSize('.video-container video');

  $(window).on('resize', function() {
    scaleVideoContainer();
    scaleBannerVideoSize('.video-container .poster img');
    scaleBannerVideoSize('.video-container .filter');
    scaleBannerVideoSize('.video-container video');
  });

});
