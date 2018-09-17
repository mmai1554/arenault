(function () {
  'use strict';
  $ = jQuery;

  $(function () {

    $('button[name="addGallery"]').click(function (event) {
      event.preventDefault();
      var galleryName = window.prompt('Name der neuen Galerie:');
      if (!galleryName) {
        return;
      }
      var pageOptions = wpPages.reduce(function (total, page, i) {
        return total += `<option value="${page.ID}" ${(i === 0 ? 'selected' : '')}>${page.post_title}</option>`;
      }, '');
      $('.galleries').append(`
        <section class="gallery">
          <h2 class="gallery-name">${galleryName}</h2>
          <a class="gallery-delete" href="javascript:void">Entfernen</a>
          <p>
            Anzeigen auf:
            <select name="galleryPageId">
              ${pageOptions}
            </select>
          </p>
          <div class="image-list">
          </div>
          <button class="button" name="addImages">+ Bilder hinzufügen</button>
          <hr>
        </section>
      `);
    })

    $('body').on('click', '.gallery-delete', function (event) {
      event.preventDefault();
      if (confirm('Galerie dauerhaft löschen?')) {
        $(this).parents('.gallery').remove();
      }
    });

    $('body').on('click', 'button[name="addImages"]', function (event) {
      event.preventDefault();
      var imageList = $(this).siblings('.image-list');
      var frame;
      if (frame) {
        frame.open();
        return;
      }
      frame = wp.media({
        title: 'Bilder für Galerie auswählen',
        button: {
          text: 'Auswählen'
        },
        multiple: true
      });
      frame.on('select', function () {
        var attachment = frame.state().get('selection').toJSON();
        attachment.forEach(function (image, i) {
          var imageUrl = image.url;
          var imageThumbnailUrl = image.sizes.large.url;
          if (location.protocol === 'https:') {
            imageUrl = imageUrl.replace(/^http:/, 'https:');
          }
          var listItem = `
            <div class="image-list-item">
              <div
                class="image-list-item-img"
                data-url="${imageUrl}"
                data-thumbnail-url="${imageThumbnailUrl}"
                style="background-image: url('${imageThumbnailUrl}')"
              ></div>
              <input class="image-list-item-caption" type="text" placeholder="Bildunterschrift">
              <button class="button image-list-item-up"><span class="dashicons dashicons-arrow-up-alt2"></span></button>
              <button class="button image-list-item-down"><span class="dashicons dashicons-arrow-down-alt2"></span></button>
              <a class="image-list-item-delete" href="javascript:void">Entfernen</a>
            </div>
          `;
          imageList.append(listItem);
        });
      });
      frame.open();
    });

    $('body').on('click', '.image-list-item-delete', function (event) {
      event.preventDefault();
      if (confirm('Bild dauerhaft löschen?')) {
        $(this).parents('.image-list-item').remove();
      }
    });

    $('body').on('click', '.image-list-item-up', function (event) {
      event.preventDefault();
      var item = $(event.target).parents('.image-list-item');
      item.insertBefore(item.prev());
    });

    $('body').on('click', '.image-list-item-down', function (event) {
      event.preventDefault();
      var item = $(event.target).parents('.image-list-item');
      item.insertAfter(item.next());
    });

    $('#submit-ar-gallery-options').click(function (event) {
      event.preventDefault();
      $('#ar-gallery-options input, #ar-gallery-options button, #ar-gallery-options textarea').attr('disabled', 'disabled');
      $('#ar-gallery-options .spinner').addClass('is-active');

      var galleries = [];
      $('.image-list').each(function () {
        var images = [];
        $(this).find('.image-list-item').each(function () {
          images.push({
            url: $(this).find('.image-list-item-img').attr('data-url'),
            thumbnailUrl: $(this).find('.image-list-item-img').attr('data-thumbnail-url'),
            caption: $(this).find('.image-list-item-caption').val()
          });
        });
        galleries.push({
          name: $(this).siblings('.gallery-name').text(),
          pageId: +$('select').val(),
          images: images
        });
      });

      var option_page = $('#ar-gallery-options [name="option_page"]').val();
      var action = $('#ar-gallery-options [name="action"]').val();
      var nonce = $('#ar-gallery-options [name="_wpnonce"]').val();
      var httpReferer = $('#ar-gallery-options [name="_wp_http_referer"]').val();

      var requestData = {
        option_page: option_page,
        action: action,
        _wpnonce: nonce,
        _wp_http_referer: httpReferer,
        ar_galleries: JSON.stringify(galleries)
      };
      $.post('options.php', requestData, function (data) {
        location.reload();
      });

    });

  });
})();
