
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    <h1 class="entry-title">
      <?php the_title(); ?>
    </h1>
	</header>
	<div class="entry-content">
		<?php
		  the_content();
		?>
	</div>
	<?php 
		$galleries = json_decode(get_option('ar_galleries'));
		$gallery = null;
		foreach ($galleries as $i => $g) {
			if ($g->pageId == get_the_ID()) {
				$gallery = $g;
				break;
			}
		}
		if ($gallery):
	?>
		<div class="gallery">
			<div class="gallery-content">
				<?php foreach($gallery->images as $image): ?>
					<figure
						class="gallery-item"
						data-url="<?php echo $image->url ?>"
						data-caption="<?php echo $image->caption ?>"
					>
						<div
							class="gallery-item-image"
							style="background-image: url('<?php echo $image->thumbnailUrl ?>');"
						>
						</div>
						<?php if(!empty($image->caption)): ?>
							<figcaption class="gallery-item-caption">
								<?php echo $image->caption ?>
							</figcaption>
						<?php endif; ?>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	<?php
		endif;
	?>
</article>
