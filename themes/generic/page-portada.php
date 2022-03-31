<?php get_header(); ?>
<main id="content" role="main">
<h1>Servicios</h1>
<?php 
$args = [
    'post_type'=> 'servicio',
    'post_per_page'=> -1
];
$servicios = new WP_Query($args);
if ( $servicios->have_posts() ) {
    echo '<ul class="lista-servicios">';
    while ( $servicios->have_posts() ) {
        $servicios->the_post();
        ?>
        <li>
            <strong>*</strong></strong> <a href="<?php the_permalink()?>"><?php the_title()?></a>
            <strong>Precio</strong> <?php echo get_post_meta(get_the_ID(), "precio")[0] . "€" ?> <strong> Horario </strong> <?php echo get_post_meta(get_the_ID(), "horario")[0] ?>
        </li>

        <?php
    }
    echo '</ul>';
} else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="header">
<h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
</header>
<div class="entry-content" itemprop="mainContentOfPage">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) ); } ?>
<?php the_content(); ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
</div>
</article>
<?php if ( comments_open() && !post_password_required() ) { comments_template( '', true ); } ?>
<?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>