<?php
$notice = get_option('servebolt_gdpr_settings');
$desc = $notice['sb_essential_notice_desc'];
if(empty($desc)) $desc = __('We use cookies to offer you a better browsing experience, personalise content and ads, to provide social media features and to analyse our traffic. Read about how we use cookies and how you can control them by clicking Cookie Settings. You consent to our cookies if you continue to use this website.', 'servebolt-gdpr');
?>
<div class="gdpr-cookie-notice new">
    <p class="gdpr-cookie-notice-description"><?php echo $desc; ?></p>
    <nav class="gdpr-cookie-notice-nav">
        <a href="#" class="gdpr-cookie-notice-nav-item gdpr-cookie-notice-nav-item-settings"><?php _e('Cookie settings', 'servebolt-gdpr'); ?></a>
        <a href="#" class="gdpr-cookie-notice-nav-item gdpr-cookie-notice-nav-item-accept gdpr-cookie-notice-nav-item-btn"><?php _e('Accept cookies', 'servebolt-gdpr'); ?></a>
    </nav></div>