<?php
//Settings page
function sociallink_shortcoder_settings_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'xb_social_links';
    $social_links = get_social_links();
    ?>
     <div class="wrap sls-wrapper">
        <h1>How To Use Guide</h1>
        <p></p>
        <!-- <fieldset class="sls-container">
            <legend><h3 class="sls-title">Master Shortcode Srttings</h3></legend>
            <table>

            </table>
        </fieldset> -->
        <fieldset class="sls-container">
            <legend><p class="sls-title">Add a New Social Link</p></legend>
            <p>Click on the <a href='?page=sociallink-shortcoder-add-new'>'Add New Social Link'</a> button to start creating a new link.</p>
            <ol>
                <li><strong>Insert the URL:</strong> Enter the URL of your social media page.</li>
                <li><strong>Choose an Icon:</strong> Select from a wide range of Font Awesome icons or upload your own custom icon.</li>
                <li><strong>Set the Icon Size:</strong> Choose a size for your icon to ensure it fits well with your site's design.</li>
            </ol>
        </fieldset>
        <fieldset class="sls-container">
            <legend><p class="sls-title">Use the Shortcode</p></legend>
            <h3>Individual Links</h3>
            <p>Each social link you create will have its own shortcode displayed in the <code>Shortcode</code> column at the <a href='?page=sociallink-shortcoder'>Manage links</a> page.</p>
            <p>Copy this shortcode and paste it wherever you want that specific social link to appear on your site.</p>
            <h3>All Links at Once</h3>
            <p>If you prefer to insert all your social links at once, copy the <code>Master Shortcode</code> provided on the <a href='?page=sociallink-shortcoder'>manage links</a> page. This shortcode will display all your configured social links together.</p>
        </fieldset>
        <fieldset class="sls-container">
            <legend><p class="sls-title">Use PHP</p></legend>
            <h3>Individual Links</h3>
            <p>To insert a customized social shortcode in your WordPress template or PHP files, use the <code>do_shortcode()</code> function. This is the standard WordPress way of doing shortcodes in PHP. </p>
            <p>Example:</p>
            <code>&lt;?php echo do_shortcode('[sociallink id="1"]') ?&gt;</code>
            <h3>All Links at Once</h3>
            <p>The master shortcode allows you to display all social links with the specified parameters.</p>
            <p>To use this shortcode in PHP:</p>
            <code>&lt;?php echo do_shortcode('[MasterSocialLinks size="32" gap="12" background="#474747"]'); ?&gt;</code>
            <p>Here the size, gap and background parameters are customizable:</p>
            <ul>
                <li><code>size</code> - icon size in pixels.</li>
                <li><code>gap</code> - distance between icons in pixels.</li>
                <li><code>background</code> - background color in HEX format.</li>
            </ul>
        </fieldset>
    </div>
<?php } ?>
