<div class="wrap">
    <h1>Gérer les adresses IP bloquées</h1>
    <?php if (!empty($blocked_accounts)) : ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th class="connect-secure-ip">Adresse IP</th>
                    <th class="connect-date-ip">Date de blocage</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blocked_accounts as $blocked_account) : ?>
                    <tr>
                        <td><?php echo esc_html(long2ip(intval($blocked_account->ip_address))); ?></td>
                        <td><?php echo esc_html($blocked_account->block_time); ?></td>
                        <td>
                            <form method="post" class="form-secure">
                                <input type="hidden" name="unblock_ip" value="<?php echo esc_attr($blocked_account->ip_address); ?>">
                                <?php wp_nonce_field('unblock_ip_' . $blocked_account->ip_address); ?>
                                <button type="submit" class="button button-secondary button-web-sec">Débloquer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucune adresse IP bloquée pour le moment.</p>
    <?php endif; ?>
</div>