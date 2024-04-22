<?php
ob_start();
function sociallink_admin_notice_success() {
    echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__('Social link saved successfully.', 'social-link-shortcoder') . '</p></div>';
}

function sociallink_admin_notice_failure() {
    echo '<div class="notice notice-error is-dismissible"><p>' . esc_html__('Failed to save social link.', 'social-link-shortcoder') . '</p></div>';
}
function sociallink_shortcoder_add_new_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'xb_social_links';
    $icons = ['fab fa-facebook', 'fab fa-facebook-f', 'fab fa-facebook-square', 'fab fa-twitter', 'fab fa-twitter-square', 'fab fa-instagram', 'fab fa-instagram-square', 'fab fa-youtube', 'fab fa-youtube-square', 'fab fa-linkedin', 'fab fa-linkedin-in', 'fab fa-whatsapp', 'fab fa-whatsapp-square', 'fab fa-weixin', 'fab fa-weibo', 'fab fa-snapchat', 'fab fa-snapchat-square', 'fab fa-pinterest', 'fab fa-pinterest-p', 'fab fa-pinterest-square', 'fab fa-tiktok', 'fab fa-telegram', 'fab fa-telegram-plane', 'fab fa-reddit', 'fab fa-reddit-square', 'fab fa-twitch', 'fab fa-vimeo', 'fab fa-vimeo-v', 'fab fa-vimeo-square', 'fab fa-tumblr', 'fab fa-tumblr-square', 'fab fa-flickr', 'fab fa-spotify', 'fab fa-soundcloud', 'fab fa-slack', 'fab fa-slack-hash', 'fab fa-discord', 'fab fa-quora', 'fab fa-medium', 'fab fa-medium-m', 'fab fa-skype', 'fab fa-line', 'fab fa-xing', 'fab fa-xing-square', 'fab fa-vk', 'fab fa-qq', 'fab fa-behance', 'fab fa-behance-square', 'fab fa-dribbble', 'fab fa-dribbble-square', 'fab fa-blogger', 'fab fa-blogger-b', 'fab fa-mastodon', 'fab fa-etsy', 'fab fa-github', 'fab fa-gitlab', 'fab fa-gitter', 'fab fa-gratipay', 'fab fa-grav', 'fab fa-gulp', 'fab fa-hackerrank', 'fab fa-hipchat', 'fab fa-imdb', 'fab fa-invision', 'fab fa-ioxhost', 'fab fa-jenkins', 'fab fa-joomla', 'fab fa-js', 'fab fa-jsfiddle', 'fab fa-lastfm', 'fab fa-leanpub', 'fab fa-less', 'fab fa-mailchimp', 'fab fa-mandalorian', 'fab fa-markdown', 'fab fa-maxcdn', 'fab fa-mdb', 'fab fa-microblog', 'fab fa-microsoft', 'fab fa-napster', 'fab fa-node', 'fab fa-node-js', 'fab fa-npm', 'fab fa-ns8', 'fab fa-nutritionix', 'fab fa-opencart', 'fab fa-openid', 'fab fa-opera', 'fab fa-optin-monster', 'fab fa-orcid', 'fab fa-page4', 'fab fa-pagelines', 'fab fa-palfed', 'fab fa-patreon', 'fab fa-paypal', 'fab fa-periscope', 'fab fa-phabricator', 'fab fa-phoenix-framework', 'fab fa-phoenix-squadron', 'fab fa-php', 'fab fa-pied-piper', 'fab fa-pied-piper-alt', 'fab fa-pied-piper-hat', 'fab fa-pied-piper-pp', 'fab fa-playstation', 'fab fa-product-hunt', 'fab fa-python', 'fab fa-raspberry-pi', 'fab fa-react', 'fab fa-reacteurope', 'fab fa-readme', 'fab fa-rebel', 'fab fa-red-river', 'fab fa-renren', 'fab fa-replyd', 'fab fa-researchgate', 'fab fa-resolving', 'fab fa-rev', 'fab fa-rocketchat', 'fab fa-rockrms', 'fab fa-rust', 'fab fa-safari', 'fab fa-salesforce', 'fab fa-sass', 'fab fa-schlix', 'fab fa-scribd', 'fab fa-searchengin', 'fab fa-sellcast', 'fab fa-sellsy', 'fab fa-servicestack', 'fab fa-shirtsinbulk', 'fab fa-shopify', 'fab fa-shopware', 'fab fa-simplybuilt', 'fab fa-sistrix', 'fab fa-sith', 'fab fa-sketch', 'fab fa-skyatlas', 'fab fa-slideshare', 'fab fa-snapchat-ghost', 'fab fa-sourcetree', 'fab fa-speakap', 'fab fa-speaker-deck', 'fab fa-squarespace', 'fab fa-stack-exchange', 'fab fa-stack-overflow', 'fab fa-stackpath', 'fab fa-staylinked', 'fab fa-steam', 'fab fa-steam-square', 'fab fa-steam-symbol', 'fab fa-sticker-mule', 'fab fa-strava', 'fab fa-stripe', 'fab fa-stripe-s', 'fab fa-studiovinari', 'fab fa-stumbleupon', 'fab fa-stumbleupon-circle', 'fab fa-superpowers', 'fab fa-supple', 'fab fa-suse', 'fab fa-swift', 'fab fa-symfony', 'fab fa-teamspeak', 'fab fa-tencent-weibo', 'fab fa-the-red-yeti', 'fab fa-themeco', 'fab fa-themeisle', 'fab fa-think-peaks', 'fab fa-trade-federation', 'fab fa-trello', 'fab fa-tripadvisor', 'fab fa-twitter', 'fab fa-typo3', 'fab fa-uber', 'fab fa-ubuntu', 'fab fa-uikit', 'fab fa-umbraco', 'fab fa-uncharted', 'fab fa-uniregistry', 'fab fa-unity', 'fab fa-unsplash', 'fab fa-untappd', 'fab fa-ups', 'fab fa-usb', 'fab fa-usps', 'fab fa-ussunnah', 'fab fa-vaadin', 'fab fa-viacoin', 'fab fa-viadeo', 'fab fa-viadeo-square', 'fab fa-viber', 'fab fa-vimeo', 'fab fa-vimeo-v', 'fab fa-vine', 'fab fa-vnv', 'fab fa-vuejs', 'fab fa-watchman-monitoring', 'fab fa-waze', 'fab fa-weebly', 'fab fa-whatsapp', 'fab fa-whmcs', 'fab fa-wikipedia-w', 'fab fa-windows', 'fab fa-wix', 'fab fa-wizards-of-the-coast', 'fab fa-wodu', 'fab fa-wolf-pack-battalion', 'fab fa-wordpress', 'fab fa-wordpress-simple', 'fab fa-wpbeginner', 'fab fa-wpexplorer', 'fab fa-wpforms', 'fab fa-wpressr', 'fab fa-xbox', 'fab fa-xing', 'fab fa-y-combinator', 'fab fa-yahoo', 'fab fa-yammer', 'fab fa-yandex', 'fab fa-yandex-international', 'fab fa-yarn', 'fab fa-yelp', 'fab fa-yoast', 'fab fa-youtube', 'fab fa-youtube-square', 'fab fa-zhihu' ]; 
    ?>
    <div class="wrap sls-wrapper">
        <h2>Add New Social Link</h2>
        <form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
            <?php wp_nonce_field('save_social_link'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Your Social Link (URL)</th>
                    <td>
                        <input placeholder='https://' required type="url" name="url" value="" class="regular-text" />
                        <p class="description" id="tagline-description">You can insert any link you want but it has to start with <code>http://</code> or <code>https://</code></p>
                    </td>
                </tr>
                <th class='image_picker_container' scope="row">Icon</th>
                    <td class='image-chooser'>
                        <fieldset>
                            <legend class="screen-reader-text">Icon</legend>
                                <input style="display:none;" type="text" id="image-url" name="image" value="" class="regular-text" />
                                <div id="image-preview" style="min-height: 50px;"></div>
                                <button type="button" id="upload-button" class="button">Custom Icon</button>
                                <button type="button" id="choose-icon-button" class="button">Font Awesome Icons</button>
                                <p class="description" id="tagline-description">It is recommended to upload square icons, no larger than 128px</p>
                        </fieldset>
                        <fieldset id='icon-picker' class="sls-container ">
                            <legend><p class="sls-title">Pick icon</p></legend>
                            <div class='icons-container'>
                                <?php foreach ($icons as $icon): ?>
                                    <button type="button" class="fa-icon-picker" data-icon="<?php echo esc_attr($icon); ?>" style="margin: 5px;">
                                        <i class="<?php echo esc_attr($icon); ?> icon" style="font-size: 32px; color: #363b3f;"></i>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                            <div class='color-picker-container'>
                                    <input type="text" id='icon-color' name="iconColor" value="#363b3f" class="icon-color-field" />
                                    <button type="button" id="confirm-icon-selection" class="button button-primary">Accept</button>
                                </div>
                            </div>
                        </fieldset>  
                    </td>
                </tr>
                <th>Icon Size</th>
                <td><input type="number" name="icon-size" id="icon-size" class="small-text" value="24">px.
                    <p class="description" id="tagline-description">Applies to single shortcode only</p>
                </td> 
            </table>
            <?php submit_button('Save Social Link'); ?>
        </form>
    </div>
</div>
<?php
}
add_action('admin_init', 'handle_social_link_form_submission');

function handle_social_link_form_submission() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'xb_social_links';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        if (check_admin_referer('save_social_link', '_wpnonce')) {
            $url = esc_url_raw($_POST['url']);
            $iconColor = isset($_POST['iconColor']) ? sanitize_hex_color($_POST['iconColor']) : '#363b3f';
            $iconSize = isset($_POST['icon-size']) ? intval($_POST['icon-size']) : 24;
            $image = isset($_POST['image']) ? $_POST['image'] : '';

            if (preg_match('/^(fa[b|r|s] fa-[a-z\d-]+)$/i', $image)) {
                // Это класс иконки, не трогаем
            } else if (filter_var($image, FILTER_VALIDATE_URL)) {
                // Это URL изображения, применяем esc_url_raw
                $image = esc_url_raw($image);
            } else {
                // Некорректный ввод, можно обработать ошибку или игнорировать значение
            }

            $data = [
                'url' => $url,
                'image' => $image,
                'iconColor' => $iconColor,
                'iconSize' => $iconSize
            ];

            if (!$wpdb->insert($table_name, $data, array('%s', '%s', '%s', '%d'))) {
            
                add_action('admin_notices', 'sociallink_admin_notice_failure');
            } else {
                add_action('admin_notices', 'sociallink_admin_notice_success');
            }
        } else {
            echo '<div class="error"><p>Security check failed.</p></div>';
        }
    }
}
//     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
//         // Проверка nonce для безопасности
//         if (check_admin_referer('save_social_link')) {

//             // Очистка данных
//             $url = esc_url_raw($_POST['url']);
//             $iconColor = isset($_POST['iconColor']) ? sanitize_hex_color($_POST['iconColor']) : '#363b3f'; 
//             $iconSize = isset($_POST['icon-size']) ? intval($_POST['icon-size']) : 24;
//             // Проверяем, установлен ли ключ 'image'
//             $image = isset($_POST['image']) ? $_POST['image'] : '';

//             if (preg_match('/^(fa[b|r|s] fa-[a-z\d-]+)$/i', $image)) {
//                 // Это класс иконки, не трогаем
//             } else if (filter_var($image, FILTER_VALIDATE_URL)) {
//                 // Это URL изображения, применяем esc_url_raw
//                 $image = esc_url_raw($image);
//             } else {
//                 // Некорректный ввод, можно обработать ошибку или игнорировать значение
//             }
//             // Подготовка данных для вставки в базу данных
//             $data = [
//                 'url' => $url,
//                 'image' => $image,
//                 'iconColor' => $iconColor,
//                 'iconSize' => $iconSize
//             ];

//             if ($wpdb->insert(
//                 $table_name,
//                 array(
//                     'url' => $url,
//                     'image' => $image,
//                     'iconColor' => $iconColor,
//                     'iconSize' => $iconSize
//                 ),
//                 array('%s', '%s', '%s', '%d') // Format specifiers for each column value
//             ) === false) {
//                 add_action('admin_notices', 'sociallink_admin_notice_failure');
//             } else {
//                 add_action('admin_notices', 'sociallink_admin_notice_success');
//             }
            
//             if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'save_social_link')) {
//                 echo '<div class="error"><p>Security check failed.</p></div>';
//             }
//         }
//     }
// }

ob_end_flush();