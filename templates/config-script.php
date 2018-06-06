<?php
$siteurl = get_option('siteurl');
$settings = get_option('servebolt_gdpr_settings');
$analytics_cookies = implode('\',\'', $settings['sb_performance_cookies']);
$marketing_cookies = implode('\',\'',$settings['sb_marketing_cookies']);
$performance_cookies = implode('\',\'',$settings['sb_performance_cookies']);
$domain = parse_url($siteurl);


echo "<script>gdprCookieNotice({ timeout: 500, expiration: 30,implicit: true,";
if(!empty($performance_cookies)) echo "performance: ['".$performance_cookies."'],";
if(!empty($analytics_cookies)) echo "analytics: ['".$analytics_cookies."'],";
if(!empty($marketing_cookies)) echo "marketing: ['".$marketing_cookies."'],";
echo " domain: '".$domain['host']."'";
echo "});</script>";