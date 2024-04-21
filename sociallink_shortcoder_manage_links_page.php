<?php
function sociallink_shortcoder_manage_links_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'xb_social_links';
    $social_links = get_social_links(); 
?>
    <div class="wrap sls-wrapper">
        <h1>SocialLink Shortcoder</h1>
        <p>Set up and manage your social links shortcodes here.</p>
         <button id="addNewLinkBtn" class="button button-primary"  >Add New Social Link</button>
        <fieldset class="sls-container">
        <legend><h3 class="sls-title">Existing Social Links</h3></legend>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>URL</th>
                    <th>Shortcode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($social_links) && !empty($social_links)) { ?>
                    <?php foreach ($social_links as $link) : ?>
                        <tr>
                            
                            <td>
                                <?php if ($link['image'] !== null && strpos($link['image'], 'fa-') !== false) { ?>
                                    <span style="color: <?php echo esc_attr($link['iconColor']); ?>">
                                        <i style="font-size: 34px;" class="<?php echo esc_attr($link['image']); ?>"></i>
                                    </span>
                                <?php } else { ?>
                                    <img src="<?php echo esc_url($link['image']); ?>" alt="social icon" style="width: 34px; height: auto;">
                                <?php } ?>
                            </td>
                            <td><a href="<?php echo esc_url($link['url']); ?>" target="_blank"><?php echo esc_url($link['url']); ?></a></td>
                            <td>[sociallink id="<?php echo esc_attr($link['id']); ?>"]</td>
                            <td>
                                <button class="button button-secondary" onclick="editLink(<?php echo esc_attr($link['id']); ?>);">Edit</button>
                                <button class="button button-secondary" onclick="deleteLink(<?php echo esc_attr($link['id']); ?>);">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr><td colspan="3">No social links found.</td></tr>
                <?php } ?>
            </tbody>
        </table>
        </fieldset>
        <fieldset class="sls-container">
            <legend><h3 class="sls-title">Master Shortcode</h3></legend>
            <table>
            <tr>
                <td>
                    <label for="iconSize">Icons size(px):</label>
                    <input type="number" id="iconSize" name="iconSize" min="1" placeholder="24">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="iconsGap">Gap between Icons(px):</label>
                    <input type="number" id="iconsGap" name="iconsGap" min="1" placeholder="6">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="master_background_picker">Background color</label>
                    <input type="text" name="master_background_picker" id="master_background_picker" value="#ffffff" class="my-color-field" />
                </td>
            </tr>
            <tr>
                <td> <button class="button button-secondary" onclick="generateShortcode()">Generate Shortcode</button></td>
            </tr>
           <tr>
            <td>
                <p>Your Shortcode:</p>
                <code id="generatedShortcode"></code>
            </td>
           </tr>
            <table/>
        </fieldset>

        <script type="text/javascript">
            function editLink(id) {
                window.location.href = "<?php echo admin_url('admin.php?page=sociallink-shortcoder-edit&edit='); ?>" + id;
            }
            function deleteLink(id) {
                if (confirm("Are you sure you want to delete this link?")) {
                    window.location.href = "<?php echo admin_url('admin.php?page=sociallink-shortcoder&delete='); ?>" + id;
                }
            }
            document.getElementById('addNewLinkBtn').addEventListener('click', function() {
                window.location.href = '<?php echo admin_url('admin.php?page=sociallink-shortcoder-add-new'); ?>';
            });
            jQuery(document).ready(function($){
                $('#master_background_picker').wpColorPicker();
            });

            function generateShortcode() {
                var size = document.getElementById('iconSize').value;
                var gap = document.getElementById('iconsGap').value;
                var background = document.getElementById('master_background_picker').value;
                var shortcode = '[MasterSocialLinks size="' + size + '" gap="' + gap + '" background="' + background + '"]';
                document.getElementById('generatedShortcode').innerText = shortcode;

                // Сохраняем в локальное хранилище
                localStorage.setItem('savedShortcode', shortcode);
                localStorage.setItem('iconSize', size);
                localStorage.setItem('iconsGap', gap);
                localStorage.setItem('background', background);
            }

            function loadSavedShortcode() {
                var savedShortcode = localStorage.getItem('savedShortcode');
                var savedSize = localStorage.getItem('iconSize');
                var savedGap = localStorage.getItem('iconsGap');
                var savedBackground = localStorage.getItem('background');
                
                if (savedShortcode) {
                    document.getElementById('generatedShortcode').innerText = savedShortcode;
                }
                if (savedSize) {
                    document.getElementById('iconSize').value = savedSize;
                }
                if (savedGap) {
                    document.getElementById('iconsGap').value = savedGap;
                }
                if (savedBackground) {
                    document.getElementById('master_background_picker').value = savedBackground;
                }
            }
            window.onload = loadSavedShortcode;

        </script>
    </div>
    <?php

}

function sociallink_shortcoder_handle_actions() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'xb_social_links';
    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        $wpdb->delete($table_name, ['id' => $id]);
        wp_redirect(admin_url('admin.php?page=sociallink-shortcoder'));
        exit;
    }
    if (isset($_GET['edit'])) {
        $id = intval($_GET['edit']);
        // Fetch the link to be edited
        $link = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id), ARRAY_A);
    }
}
add_action('admin_init', 'sociallink_shortcoder_handle_actions');

function sociallink_shortcode_handler($atts) {
    $atts = shortcode_atts([
        'id' => '',
    ], $atts, 'sociallink');

    global $wpdb;
    $table_name = $wpdb->prefix . 'xb_social_links';
    $link = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $atts['id']));

    if ($link) {
        if ($link->image !== null && strpos($link->image, 'fa') !== false) {
            $iconColor = !empty($link->iconColor) ? $link->iconColor : '#FFFFFF';
            $iconSize = !empty($link->iconSize) ? $link->iconSize : 24; // Default size if not specified
            return "<a class='sls-social-link' href='{$link->url}' target='_blank'><span style='color: {$iconColor}'><i style='font-size:{$iconSize}px' class='{$link->image}'></i></span></a>";
        } else {
            $iconSize = !empty($link->iconSize) ? $link->iconSize : 24; // Default size if not specified
            return "<a class='sls-social-link' href='{$link->url}' target='_blank'><img style='width:{$iconSize}px; height:{$iconSize}px;' src='{$link->image}' alt='social icon'></a>";
        }
    }
    return "Link not found";
}
add_shortcode('sociallink', 'sociallink_shortcode_handler');

function mastersociallinks_shortcode_handler($atts) {
    $atts = shortcode_atts([
        'size' => 24, 
        'gap' => 6, 
        'background' => '#FFFFFF' 
    ], $atts, 'MasterSocialLinks');

    global $wpdb;
    $table_name = $wpdb->prefix . 'xb_social_links';
    
    $links = $wpdb->get_results("SELECT * FROM $table_name");
    
    $output = '<div class="master-social-links" style="background-color: ' . esc_attr($atts['background']) . '; gap: ' . esc_attr($atts['gap']) . 'px;">';
    
    foreach ($links as $link) {
        $iconSize = $atts['size']; 
        if ($link->image !== null && strpos($link->image, 'fa') !== false) {
            $iconColor = !empty($link->iconColor) ? $link->iconColor : '#FFFFFF';
            $output .= "<a href='{$link->url}' target='_blank'><span style='color: {$iconColor}'><i style='font-size:{$iconSize}px' class='{$link->image}'></i></span></a>";
        } else {
            $output .= "<a href='{$link->url}' target='_blank'><img style='width:{$iconSize}px; height:{$iconSize}px;' src='{$link->image}' alt='social icon'></a>";
        }
    }
    $output .= '</div>';
    return $output;
}
add_shortcode('MasterSocialLinks', 'mastersociallinks_shortcode_handler');


