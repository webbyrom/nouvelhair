<?php
$networks = [
    'facebook'  => 'Facebook',
    'instagram' => 'Instagram',
    'tiktok'    =>  'TikTok'
];
$site_link = !empty($instance['site_link']) ? esc_url($instance['site_link']) : '';
$logo_image = !empty($instance['logo_image']) ? '<img src="' . esc_url($instance['logo_image']) . '" alt="Logo">' : '';
?>

<div class="footer_social">
    <?php foreach ($networks as $name => $label) : ?>
        <?php if (!empty($instance[$name])) : ?>
            <a href="<?= esc_url($instance[$name]) ?>" title="<?= sprintf(esc_attr('Me suivre sur %s', 'nouvelhair'), $label); ?>">
                <?= Nvh_icon($name) ?>
            </a>
        <?php endif ?>
    <?php endforeach; ?>
</div>
<div class="footer_credits"><?= esc_html($instance['credits']) ?>
    <?php if (!empty($site_link) && !empty($logo_image)) : ?>
        <a href="<?= $site_link ?>" title="<?= esc_attr('Visitez le site', 'nouvelhair'); ?>">
            <?= $logo_image ?>
        </a>

    <?php endif; ?>

</div>