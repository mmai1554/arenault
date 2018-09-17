<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    <h1 class="entry-title">
			<a href="<?php the_permalink() ?>">
				<?php the_title(); ?>
			</a>
    </h1>
    
	</header>
	<div class="entry-content">
		<a class="noformat" href="<?php the_permalink() ?>">
		<?php
		  the_excerpt();
		?>
		</a>
	</div>
</article>
