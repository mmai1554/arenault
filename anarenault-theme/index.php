<?php get_header(); ?>
<?php
  if (have_posts()):
    while (have_posts()): 
      the_post();
      get_template_part('template-parts/post');
    endwhile;
  else:
    echo("Keine Posts verfügbar.");
  endif;
?>

<?php get_footer(); ?>
