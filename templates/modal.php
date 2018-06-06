<?php
$settings = get_option('servebolt_gdpr_settings');

$category = array();
if(!empty($settings['sb_performance_desc'])){
    $category['performance']['prefix'] = 'performance';
    $category['performance']['title'] = 'Performance Cookies';
    $category['performance']['desc'] = $settings['sb_performance_desc'];
}
if(!empty($settings['sb_analytics_desc'])){
    $category['analytics']['prefix'] = 'analytics';
    $category['analytics']['title'] = 'Analytics Cookies';
    $category['analytics']['desc'] = $settings['sb_analytics_desc'];
}
if(!empty($settings['sb_marketing_desc'])){
    $category['marketing']['prefix'] = 'marketing';
    $category['marketing']['title'] = 'Marketing Cookies';
    $category['marketing']['desc'] = $settings['sb_marketing_desc'];
}

?>
<div class="gdpr-cookie-notice-modal">
    <div class="gdpr-cookie-notice-modal-content">
        <div class="gdpr-cookie-notice-modal-header">
            <h2 class="gdpr-cookie-notice-modal-title"><?php _e('Cookie settings', 'servebolt-gdpr'); ?></h2>
            <button type="button" class="gdpr-cookie-notice-modal-close"></button>
        </div>
        <ul class="gdpr-cookie-notice-modal-cookies">
            <li class="gdpr-cookie-notice-modal-cookie">
                <div class="gdpr-cookie-notice-modal-cookie-row">
                    <h3 class="gdpr-cookie-notice-modal-cookie-title"><?php _e('Essential website cookies', 'servebolt-gdpr'); ?></h3>
                    <label class="gdpr-cookie-notice-modal-cookie-state" for="gdpr-cookie-notice-cookie_essential"><?php _e('Always on', 'servebolt-gdpr'); ?></label>
                </div>
                <p class="gdpr-cookie-notice-modal-cookie-info"><?php _e('Necessary cookies help make a website usable by enabling basic functions like page navigation and access to secure areas of the website. The website cannot function properly without these cookies.', 'servebolt-gdpr'); ?></p>
            </li>
            <?php foreach ($category as $cat): ?>
            <li class="gdpr-cookie-notice-modal-cookie">
                <div class="gdpr-cookie-notice-modal-cookie-row">
                    <h3 class="gdpr-cookie-notice-modal-cookie-title"><?php echo $cat['title']; ?></h3>
                    <input type="checkbox" name="gdpr-cookie-notice-cookie_<?php echo $cat['prefix']; ?>" checked="checked" id="gdpr-cookie-notice-cookie_<?php echo $cat['prefix']; ?>" class="gdpr-cookie-notice-modal-cookie-input">
                    <label class="gdpr-cookie-notice-modal-cookie-input-switch" for="gdpr-cookie-notice-cookie_<?php echo $cat['prefix']; ?>"></label>
                </div>
                <p class="gdpr-cookie-notice-modal-cookie-info"><?php echo $cat['desc']; ?></p>
            </li>
            <?php endforeach; ?>
        </ul>
        <div class="gdpr-cookie-notice-modal-footer">
            <a href="#" class="gdpr-cookie-notice-modal-footer-item gdpr-cookie-notice-modal-footer-item-statement"><?php _e('Our Cookie Statement', 'servebolt-gdpr'); ?></a>
            <a href="#" class="gdpr-cookie-notice-modal-footer-item gdpr-cookie-notice-modal-footer-item-save gdpr-cookie-notice-modal-footer-item-btn"><span><?php _e('Save', 'servebolt-gdpr'); ?></span></a>
        </div>
    </div>
</div>
