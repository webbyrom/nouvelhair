
    <div class="row g-0">
        <div class="col-md-4 Nvh-partner-card">
            <?php
            $LogoPartner = get_field('logo_partenaire');
            if (!empty($LogoPartner)) : ?>
                <img src="<?php echo esc_url($LogoPartner); ?>" class="img-fluid rounded-start" alt="...">
            <?php else : ?>
                <img width="100%" height="250" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mN8c/CJCwAICQLXkCArnAAAAABJRU5ErkJggg==" class=" card-img-top rounded-start" alt="...">
            <?php endif; ?>
        </div>
        <div class="col-md-8 Nvh-partner-card-title">
            <div class="card-body">
                <h5 class="card-title"><?php the_title(); ?></h5>
                <?php
                $PartnerDescription = get_field('informations_sur_le_partenaire');
                if (!empty($PartnerDescription)) : ?>
                    <p class="card-text"><?php echo $PartnerDescription; ?></p>
                <?php else : ?>
                    <p>Rien n'afficher pour l'instant </p>;
                <?php endif; ?>

                <?php
                $Partner_link = get_field('lien_vers_le_site_du_fournisseur');
                if (!empty($Partner_link) && is_array($Partner_link)) {
                    $title = $Partner_link['title'];
                    $url = $Partner_link['url'];
                    $target = $Partner_link['target'];
                    //var_dump($Partner_link);
                    
                    echo '<a href="' . esc_url($url) . '" target="' . esc_attr($target) . '">' . esc_html($title) . '</a>';
                } else {
                    echo '<p>' . 'Pas de site pour l\'instant.' . '</p>';
                }; ?>
                
            </div>
        </div>
    </div>
