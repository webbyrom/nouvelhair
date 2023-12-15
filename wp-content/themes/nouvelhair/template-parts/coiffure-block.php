<!-- coiffure-block.php -->
<?php
defined('ABSPATH') or exit;

$textchamps = get_field('descriptif_coiffure');
$Pricecoupe = get_field('tarif_de_la_coupe_');
$imgcoupe   = get_field('photo_coupes_de_cheveux');
?>
<div class="col-md-3 col-sm-4 col-8 flip-box">
    <div class="front Nvh-flip-front" style="background-image: url('<?php echo esc_url($imgcoupe); ?>');">
    
        <div class="content text-center">
            <span class="Nvh-cote-coif"><p href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></p></span>
           
            <?php if (!empty($Pricecoupe)): ?>
            <span class="Nvh-price flip single"><?php echo esc_html($Pricecoupe) . "€ ttc"; ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="back">
        <div class="content">
            <p href="<?php echo esc_url(get_permalink()); ?>">
                <span class="Nvh-text-flip-single"><?php echo $textchamps; ?></span>
            </p>
        </div>
    </div>
</div>