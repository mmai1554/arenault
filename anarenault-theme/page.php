<?php get_header(); ?>
<?php
  if (have_posts()):
    while (have_posts()): 
      the_post();
      get_template_part('template-parts/page');
    endwhile;
  else:
    echo("Kein Inhalt verfügbar.");
  endif;
?>

<?php get_footer(); ?>
