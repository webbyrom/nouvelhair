<?php get_header(); ?>

<div class="Nvh-sing-post container-fluid">
    <div class="Nvh-singp-slider container-fluid">
        <?php add_revslider('slider-2'); ?>

    </div>
    <div class="container-fluid Nvh-news">
        <h1 class="Nvh-coiffure-title"><?php echo esc_html(get_bloginfo('name')) . ' - ' . esc_html(get_the_title()); ?></h1>
        </h1>
        <div class="Nvh-single-content container-fluid">

            <div class="underlining">
                <span class="Nvh-border-bottom"></span>
            </div>
            <div class="Nvh-single-post-content container-fluid">

                <?php the_post_thumbnail('full', [
                    'class' => 'Nvh-img-post-archive img-fluid rounded',
                    'title' =>  'Nouvel\'hair salon de coiffure saint Symphorien sur Coise'
                ], true) ?>

            </div>
            <div class="Nvh-single-text container">
                <div class="Nvh-Pdt-descript-single container">
                    <h3>Description du produit</h3>
                    <div class="underlining">
                        <span class="Nvh-border-bottom"></span>
                    </div>
                    <?php
                    $DescriptionProduit = get_field('description_du_produit');
                    //var_dump($DescriptionProduit); die;
                    if (!empty($DescriptionProduit)) {
                        echo '<p class="Nvh-single-description">' . $DescriptionProduit . '</p>';
                    }
                    ?>
                </div>
            </div><!-----fin du texte--->
            <div class="Nvh-single-price container">
                <?php
                $PriceProduct = get_field('prix');
                if (!empty($PriceProduct)) {
                    echo '<span class="Nvh-single-product-price">' . $PriceProduct . ' €' . ' TTC' . '</span>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="Nvh-espacement container-fluid"></div>
<?php get_footer(); ?>