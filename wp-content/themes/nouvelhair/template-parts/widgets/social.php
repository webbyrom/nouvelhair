<?php
$networks = [
    'facebook'  => 'Facebook',
    'instagram' => 'Instagram',
    'tiktok'    =>  'TikTok'
];
?>
<div class="footer_credits"><?= esc_html($instance['credits']) ?></div>
<div class="footer_social">
    <?php foreach ($networks as $name => $label) : ?>
        <?php if (!empty($instance[$name])) : ?>
            <a href="<?= esc_url($instance[$name]) ?>" title="<?= sprintf(esc_attr('Me suivre sur %s', 'nouvelhair'), $label); ?>">
                <?= Nvh_icon($name) ?>
            </a>
        <?php endif ?>
    <?php endforeach; ?>
</div>