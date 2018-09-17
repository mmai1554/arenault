<div class="wrap">
  <h1>Galerien</h1>
  <form id="ar-gallery-options">
    <?php
      settings_fields("ar-gallery-options");
      $galleries = json_decode(get_option("ar_galleries"));
      $pages = get_pages();
    ?>
    <script>
      var wpPages = <?php echo json_encode($pages); ?>;
    </script>
    <hr>
    <div class="galleries">
      <?php if(is_array($galleries)): foreach($galleries as $i => $gallery): ?>
        <section class="gallery">
          <h2 class="gallery-name"><?php echo $gallery->name ?></h2>
          <a class="gallery-delete" href="javascript:void">Entfernen</a>
          <p>
            Anzeigen auf:
            <select name="galleryPageId">
              <?php foreach($pages as $j => $page): ?>
                <option value="<?php echo $page->ID ?>" <?php echo ($page->ID == $gallery->pageId ? 'selected' : '') ?>>
                  <?php echo $page->post_title ?>
                </option>
              <?php endforeach; ?>
            </select>
          </p>
          <div class="image-list">
            <?php if(is_array($gallery->images)): foreach($gallery->images as $j => $image): ?>
              <div class="image-list-item">
                <div
                  class="image-list-item-img"
                  data-url="<?php echo $image->url ?>"
                  data-thumbnail-url="<?php echo $image->thumbnailUrl ?>"
                  style="background-image: url('<?php echo $image->thumbnailUrl ?>')"
                ></div>
                <input class="image-list-item-caption" type="text" placeholder="Bildunterschrift" value="<?php echo $image->caption ?>">
                <button class="button image-list-item-up"><span class="dashicons dashicons-arrow-up-alt2"></span></button>
                <button class="button image-list-item-down"><span class="dashicons dashicons-arrow-down-alt2"></span></button>
                <a class="image-list-item-delete" href="javascript:void">Entfernen</a>
              </div>
            <?php endforeach; endif; ?>
          </div>
          <button class="button" name="addImages">+ Bilder hinzufügen</button>
          <hr>
        </section>
      <? endforeach; endif; ?>
    </div>
    <section>
      <button class="button" name="addGallery">+ Galerie hinzufügen</button>
    </section>
    <section>
      <p class="submit">
        <?php submit_button(null, "primary", null, null, array("id" => "submit-ar-gallery-options")); ?>
        <span class="spinner"></span>
      </p>
    </section>
  </form>
</div>