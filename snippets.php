Loop de custom post type
    <?php $qryBanner = new WP_Query(array('post_type' => 'banner','posts_per_page' => 5, 'order' => 'DESC'))?>
    <?php if($qryBanner->have_posts()): ?>

        <?php while($qryBanner->have_posts() ): $qryBanner->the_post() ?>
            <?php the_title() ?>
            <?php the_content() ?>
        <?php endwhile; ?>

    <?php endif; ?>

Loop default
    <?php if($qryBanner->have_posts()): ?>
        <?php while(have_posts()): the_post() ?>
            <?php the_title() ?>
            <?php the_content() ?>
        <?php endwhile; ?>
    <?php endif; ?>

Snippets mais usados
    <?php the_post_thumbnail('thumb-home', array( 'alt' =>  get_the_title(), 'title' => get_the_title() )) ?>
    <?php bloginfo('template_url') ?>
    <?php bloginfo('url') ?>
    <?php the_title() ?>
    <?php the_content() ?>
    <?php the_field() ?>
    <?php get_option() ?>
    <?php get_the_author() ?>
    <?php get_template_part() ?>

Melhor Codex do mundo
https://codex.wordpress.org/Function_Reference/