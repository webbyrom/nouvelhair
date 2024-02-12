<article class="card Nvh-card-home" id="Nvh_card_home" style="width: 22rem;">
    <?php if (has_post_thumbnail()) : ?>

        <a href="<?php the_permalink() ?>" title="<?= esc_attr(get_the_title()) ?>" class="Nvh-post-img">
            <div class="Nvh-image-container-card">
                <?php the_post_thumbnail('Nvh-articles-card', [
                    'class' => 'Nvh-img-post-front',
                    'title' => 'Nouvel\'hair',
                    'loading'   => '',
                ], true) ?>
            </div>
        <?php else : ?>
            <div class="Nvh-image-container-card">
                <img width="100%" height="250" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mN8c/CJCwAICQLXkCArnAAAAABJRU5ErkJggg==" class=" card-img-top rounded-start" alt="...">
            </div>
        <?php endif ?>
        </a>
        <div class="card-body">
            <h5 class="card-title"><a href="<?php the_permalink() ?>" class="Nvh-news-title"><?php the_title() ?></a></h5>
            <?php
            $categories = get_the_category();
            if (!empty($categories)) :
                $category_names = array();
                foreach ($categories as $category) {
                    $category_names[] = '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
                }
                $categories_string = implode(', ', $category_names);
            ?>
                <div class="news-catego"><?= $categories_string ?></div>
            <?php endif; ?>
        </div>

        <div class="card-text">
            <div class="Nvh-post-text">
            <?php
            $produitdescription = get_field('description_du_produit');// récupération du champ text
            $prodPrice = get_field('prix');//récupération du champ pour le tarif
            $prodPricMax = get_field('prix_maximum');
            if (!empty($produitdescription)) {
                $Nvh_excerpt = Nvh_custom_excerpt_length($produitdescription, 20);// Limite l'extrait à 30 mots
                //var_dump($Nvh_excerpt); die;
                echo '<p class="Nvh-product-description container">'. $Nvh_excerpt . '</p>';
                if (!empty($prodPrice) && empty($prodPricMax)) {
                    echo '<span class="Nvh-card-price">' . $prodPrice . ' €' .''. ' TTC'. '</span>';
                }else {
                    if (!empty($prodPrice)&& !empty($prodPricMax)) {
                        echo '<span class="Nvh-card-price">'. 'de ' . $prodPrice . '€'. ' à '. $prodPricMax. '€'. ''. 'TTC'. '</span>';
                    }
                }
            } else {
                the_excerpt();
            } ?>
            </div>
            <a href="<?php the_permalink() ?>"
                title="<?= esc_attr(get_the_title()) ?>"
                class="btn-Nvh-color"><?= esc_html(sprintf('Voir plus')) ?>
            </a>
        </div>
</article>