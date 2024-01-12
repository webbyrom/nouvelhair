<?php
class Nvh_Social_Widget extends WP_Widget
{
    public $fields = [];
    public function __construct()
    {
        parent::__construct('Nvh_social_widget', __('Social widget', 'nouvelhair'));
        $this->fields = [
            'credits' => __('Credits', 'nouvelhair'),
            'title' => __('Title', 'nouvelhair'),
            'tiktok' => 'TikTok',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'site_link' => __('Site Link', 'nouvelhair'),
            'logo_image'  => __('Logo image', 'nouvelhair')

        ];
    }
    /***
     * création du widget
     */
    public function widget($args, $instance): void
    {
        echo $args['before_widget'];
        if (isset($instance['title'])) {
            $title = apply_filters('widget_title', $instance['title']);
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $template = locate_template('template-parts/widgets/social.php');
        if (!empty($template)) {
            include($template);
        }
        echo $args['after_widget'];
    }
    /***
     * formulaire de saisie 
     */
    public function form($instance): void
    {
        foreach ($this->fields as $field => $label) {
            $value = $instance[$field] ?? '';
?>
            <p>
                <label for="<?= $this->get_field_id($field) ?>"><?= esc_html($label) ?></label>
                <input type="text" class="widefat" name="<?= $this->get_field_name($field) ?>" id="<?= $this->get_field_id($field) ?>" value="<?= esc_attr($value) ?>">
            </p>
<?php
        }
    }
    /***
     * traitement des données et enregistrements
     */
    public function update($newInstance, $oldInstance)
    {
        $output = [];

        foreach ($this->fields as $field => $label) {
            if (!empty($newInstance[$field])) {
                $output[$field] = $newInstance[$field];
            }
        }
        return $output;
    }
}
