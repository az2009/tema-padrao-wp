<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
    <meta name="theme-color" content="#61C6B9">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head() ?>
    <?php get_template_part('template-parts/content','snippets') ?>
</head><?php flush(); ?>

<body <?php body_class(); ?>>
    <div id="page" class="site"><!-- PAGE -->

        <header class="site-header">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php get_template_part('template-parts/content','logo') ?>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?php get_template_part('template-parts/content','nav') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

        </header>

        <div id="content" class="site-content container"><!-- CONTENT -->