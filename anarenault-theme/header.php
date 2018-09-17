<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=4">
    <link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div class="site">
      <header class="sidebar">
        <div class="site-title">
          <a href="/">
            <?php echo get_bloginfo('name'); ?>
          </a>
        </div>
        <?php if (has_nav_menu('sidebar')): ?>
          <nav class="site-navigation">
            <?php wp_nav_menu(array('theme_location' => 'sidebar')); ?>
          </nav>
        <?php endif; ?>
      </header>
      <main class="main">