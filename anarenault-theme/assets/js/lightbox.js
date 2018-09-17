(function () {
  'use strict';
  $ = jQuery;

  var images = [];
  var currentIndex = 0;
  var open = false;

  function openLightbox() {
    open = true;
    $('.lightbox').remove();
    $('body').append(`
      <div class="lightbox">
        <img class="lightbox-control-left" src="${wpThemeUrl}/assets/images/arrow-left.svg">
        <div class="lightbox-content">
        </div>
        <img class="lightbox-control-right" src="${wpThemeUrl}/assets/images/arrow-right.svg">
      </div>
    `);
    showImage(currentIndex);
  }

  function closeLightbox() {
    open = false;
    $('.lightbox').remove();
  }

  function showImage(index) {
    var image = images[index];
    $('.lightbox .lightbox-content').html(`
      <figure
        class="lightbox-image"
        style="background-image: url('${image.url}')"
      >
        <figcaption class="lightbox-caption">
          ${image.caption}
        </figcaption>
      </figure>
    `);
  }

  function showPreviousImage() {
    if (currentIndex === 0) {
      currentIndex = $('.gallery-item').length - 1;
    } else {
      currentIndex--
    }
    showImage(currentIndex);
  }

  function showNextImage() {
    if (currentIndex + 1 === $('.gallery-item').length) {
      currentIndex = 0;
    } else {
      currentIndex++;
    }
    showImage(currentIndex);
  }

  function closeLightbox() {
    $('.lightbox').remove();
  }

  $(function () {

    $('.gallery-item').each(function (i) {
      images.push({
        index: i,
        url: $(this).data('url'),
        caption: $(this).data('caption')
      });
    });

    $('body').on('click', '.gallery-item', function () {
      currentIndex = $(this).index();
      openLightbox();
    });

    $('body').on('click', '.lightbox', function (event) {
      if ($(event.target).hasClass('lightbox')) {
        closeLightbox();
      }
    });

    $('body').on('click', '.lightbox-control-left', function (event) {
      showPreviousImage();
    });

    $('body').on('click', '.lightbox-control-right', function (event) {
      showNextImage();
    });
    
    $(document).keydown(function(e) {
      if (!open) {
        return;
      }
      switch (e.which) {
        case 27:
          e.preventDefault();
          closeLightbox();
        case 37:
          e.preventDefault();
          showPreviousImage();
          break;
        case 39:
          e.preventDefault();
          showNextImage();
          break;
        default: return;
      }
  });

  });
})();
