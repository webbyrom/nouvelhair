<?php
defined('ABSPATH') or die();
class NvhHoraire
{

    const GROUP = 'Horaires_salon';
    public static function register()
    {
        add_action('admin_menu', [self::class, 'addMenu']);
        add_action('admin_init', [self::class, 'registerSettings']);
        add_action('admin_enqueue_scripts', [self::class, 'registerScripts']);
       
    }
    public static function registerScripts($suffix)
    {
        if ($suffix === 'settings_page_Horaires_salon') {
            wp_register_style('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', [], false);
            wp_register_script('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr', [], false, true);
            wp_register_script('Nvh_admin', get_template_directory_uri() . '/assets/js/Nvh.js/Nvh-admin.js', ['flatpickr'], false, true);
            wp_enqueue_style('flatpickr');
            wp_enqueue_script('flatpickr');
            wp_enqueue_script('Nvh_admin');

            // Activer Flatpickr pour chaque champ de saisie des horaires
            $jours_semaine = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
            foreach ($jours_semaine as $jour) {
                wp_add_inline_script('Nvh_admin', "
                    flatpickr('#Nvh_options_horaire_$jour', {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: 'H:i',
                    });
                ");
            }
        }
    }
   
    public static function registerSettings()
    {
        register_setting(self::GROUP, 'Nvh_horaires_semaine');
        register_setting(self::GROUP, 'Nvh_conges');
        register_setting(self::GROUP, 'Nvh_telephone'); // Nouvelle option pour le numéro de téléphone
        register_setting(self::GROUP, 'Nvh_adresse'); // Nouvelle option pour l'adresse

        add_settings_section('Nvh_options_section', 'Paramètres', function () {
            echo "Vous pouvez gérer les horaires et les congés du salon.";
        }, self::GROUP);

        // Ajoutez deux champs de saisie avec Flatpickr pour chaque jour de la semaine (ouverture et fermeture)
        $jours_semaine = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
        foreach ($jours_semaine as $jour) {
            add_settings_field("Nvh_options_horaire_ouverture_$jour", "Heure d'ouverture pour le $jour", function () use ($jour) {
?>
                <input type="time" id="Nvh_options_horaire_ouverture_<?= $jour ?>" name="Nvh_horaires_semaine[<?= $jour ?>][ouverture]" value="<?= esc_attr(get_option('Nvh_horaires_semaine')[$jour]['ouverture'] ?? '') ?>">
            <?php
            }, self::GROUP, 'Nvh_options_section');

            add_settings_field("Nvh_options_horaire_fermeture_$jour", "Heure de fermeture pour le $jour", function () use ($jour) {
            ?>
                <input type="time" id="Nvh_options_horaire_fermeture_<?= $jour ?>" name="Nvh_horaires_semaine[<?= $jour ?>][fermeture]" value="<?= esc_attr(get_option('Nvh_horaires_semaine')[$jour]['fermeture'] ?? '') ?>">
            <?php
            }, self::GROUP, 'Nvh_options_section');
        }
        

        // Ajouter les champs de saisie de congés
        add_settings_field("Nvh_options_conges_debut", "Début de congés", function () {
            ?>
            <input type="datetime-local" id="Nvh_options_conges_debut" name="Nvh_conges[debut]" value="<?= esc_attr(get_option('Nvh_conges')['debut'] ?? '') ?>">
        <?php
        }, self::GROUP, 'Nvh_options_section');

        add_settings_field("Nvh_options_conges_fin", "Fin de congés", function () {
        ?>
            <input type="datetime-local" id="Nvh_options_conges_fin" name="Nvh_conges[fin]" value="<?= esc_attr(get_option('Nvh_conges')['fin'] ?? '') ?>">
        <?php
        }, self::GROUP, 'Nvh_options_section');


        // Ajouter les champs de saisie de numéro de téléphone et d'adresse
        add_settings_field("Nvh_options_telephone", "Numéro de téléphone", function () {
            $telephone = get_option('Nvh_telephone');
            ?>
            <input type="text" id="Nvh_options_telephone" name="Nvh_telephone" value="<?= esc_attr($telephone ?? '') ?>">
            <?php
            if ($telephone && !self::validatePhoneNumber($telephone)) {
                echo '<p class="error">Numéro de téléphone invalide. Veuillez saisir un numéro de téléphone valide.</p>';
            }
        }, self::GROUP, 'Nvh_options_section');

        add_settings_field("Nvh_options_adresse", "Adresse", function () {
        ?>
            <textarea id="Nvh_options_adresse" name="Nvh_adresse"><?= esc_textarea(get_option('Nvh_adresse') ?? '') ?></textarea>
        <?php
        }, self::GROUP, 'Nvh_options_section');
        add_action('admin_init', [self::class, 'saveSettings']);
    }
    public static function saveSettings()
    {
        // Vérifier si le formulaire a été soumis et que les données sont valides
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $telephone = $_POST['Nvh_telephone'];
            $adresse = $_POST['Nvh_adresse'];
           // var_dump($adresse); die;
            // Valider le numéro de téléphone
            if ($telephone && !self::validatePhoneNumber($telephone)) {
                add_settings_error('Nvh_telephone', 'invalid_phone', 'Numéro de téléphone invalide. Veuillez saisir un numéro de téléphone valide.');
                return;
            }

            // Enregistrer les données soumises
            update_option('Nvh_telephone', $telephone);
            update_option('Nvh_adresse', $adresse);
            var_dump(update_option('Nvh_telephone', $telephone)); die;
        }
    }
    // Fonction de validation du numéro de téléphone
    public static function validatePhoneNumber($phone)
    {
        $cleanedPhone = preg_replace('/[^0-9]/', '', $phone);
        return preg_match('/^0[1-9]([0-9]{2}){4}$/', $cleanedPhone);
    }



    public static function addMenu()
    {
        add_options_page("Horaires du Salon", "Horaires", "manage_options", self::GROUP, [self::class, 'render']);
    }

    public static function render()
    {   // Afficher les erreurs de validation
        settings_errors(self::GROUP);
        ?>
        <h1>Horaires du Salon</h1>
        <form action="options.php" method="post">
            <?php
            settings_fields(self::GROUP);
            do_settings_sections(self::GROUP);
            submit_button('');

            // Récupérer les horaires enregistrés sous forme d'array associatif
            $horaires_semaine = get_option('Nvh_horaires_semaine');

            // Afficher les horaires d'ouverture et de fermeture pour chaque jour de la semaine dans le front-end
            if (!empty($horaires_semaine)) {
                echo '<h2>Horaires d\'ouverture du salon</h2>';
                echo '<div class="horaires-wrapper">';
                $jours_semaine = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
                foreach ($jours_semaine as $jour) {
                    $horaire_ouverture = $horaires_semaine[$jour]['ouverture'] ?? '';
                    $horaire_fermeture = $horaires_semaine[$jour]['fermeture'] ?? '';
                    if (!empty($horaire_ouverture) && !empty($horaire_fermeture)) {
                        echo '<div class="horaire-item">';
                        echo '<div class="jour">' . ucfirst($jour) . '</div>';
                        echo '<div class="horaires">' . esc_html($horaire_ouverture) . ' - ' . esc_html($horaire_fermeture) . '</div>';
                        echo '</div>';
                    }
                }
                echo '</div>';
                // Récupérer le numéro de téléphone et l'adresse enregistrés
                $telephone = get_option('Nvh_telephone');
                $adresse = get_option('Nvh_adresse');

                // Afficher le numéro de téléphone et l'adresse
                if (!empty($telephone)) {
                    echo '<h2>Numéro de téléphone</h2>';
                    echo '<p>' . esc_html($telephone) . '</p>';
                }

                if (!empty($adresse)) {
                    echo '<h2>Adresse</h2>';
                    echo '<p>' . nl2br(esc_html($adresse)) . '</p>';
                }
            }
            ?>
        </form>
<?php
    }
}
