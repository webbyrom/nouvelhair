<div class="coif-arch container-fluid">

    <article class="Nvh-archive container">
        <div class="Nvh-img-archive container-fluid">
            <a href="<?php the_permalink(); ?>" class="Nvh-single-article"><h2><?php the_title(); ?></h2></a>
            <?php
            if (has_post_thumbnail()) :
                the_post_thumbnail('Nvh-img-archive', ['class' => 'Nvh-img-post-archive img-fluid rounded float-start', true]); ?>
            <?php endif ?>
            <div class="Nvh-single-text container">
                <?php
                $DescriptionProduit = get_field('description_du_produit');
                //var_dump($DescriptionProduit); die;
                if (!empty($DescriptionProduit)) {
                    echo '<p class="Nvh-single-description">' . $DescriptionProduit . '</p>';
                }
                ?>
            </div><!-----fin du texte--->
            <div class="Nvh-single-price container">
                <?php
                $PriceProduct = get_field('prix');
                $PricePartMax = get_field('prix_maximum');
                if (!empty($PriceProduct) && empty($PricePartMax)) {
                    echo '<span class="Nvh-single-product-price">' . $PriceProduct . ' €ttc' . '</span>';
                }else {
                    if(!empty($PriceProduct) && !empty($PricePartMax)) {
                        //var_dump($PricePartMax);
                        echo '<span class="Nvh-single-product-price">'. 'de ' . $PriceProduct . '€'. ' à '. $PricePartMax. '€'. ''. 'TTC'. '</span>';
                }else echo ' Les prix vont être mis à jour';
            }
                ?>
            </div>
    </article>


   <?php wp_reset_postdata();?>
</div>