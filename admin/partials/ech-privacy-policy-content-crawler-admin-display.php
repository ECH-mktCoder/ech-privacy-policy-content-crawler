<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://echealthcare.com/
 * @since      1.0.0
 *
 * @package    Ech_Privacy_Policy_Content_Crawler
 * @subpackage Ech_Privacy_Policy_Content_Crawler/admin/partials
 */
?>

<?php 
$bearer_token = (get_option('ech_pp_bearer_token')) ? get_option('ech_pp_bearer_token') : '';
$check_Token = true;
if(empty($bearer_token)) {
    $check_Token = false;
}

$api_link = (get_option('ech_pp_bearer_token')) ? get_option('ech_pp_bearer_token') : '';
$check_api_link = true;
if(empty($api_link)) {
    $check_api_link = false;
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="echPlg_wrap">
    <h1>ECH Privacy Policy Content Crawler General Settings</h1>
    <div class="plg_intro">
        <p> More shortcode attributes and guidelines, visit <a href="https://github.com/ECH-mktCoder/ech-privacy-policy-content-crawler" target="_blank">Github</a>. </p>
        <div class="shtcode_container">
            <pre id="sample_shortcode">[ech_get_privacy_policy_content]</pre>
            <div id="copyMsg"></div>
            <button id="copyShortcode">Copy Shortcode</button>
        </div>        
    </div>

    <div class="form_container">
        <form method="post" id="pp_content_gen_settings_form">
            <?php
            settings_fields( 'ech_pp_gen_settings' );
            do_settings_sections( 'ech_pp_gen_settings' );
            ?>
            <h2>General</h2>
            <div class="form_row">
                <?= !$check_Token ? '<h1 style="color:red;">請輸入Bearer Token或有誤</h1>' : '';?>
                <label>API Bearer Token: </label>
                <label data-bearer="Bearer ">
                <input type="text" name="ech_pp_bearer_token" value="<?= htmlspecialchars(get_option('ech_pp_bearer_token'))?>" id="ech_pp_bearer_token" />
                </label>
            </div>

            <div class="form_row">       
                <?= !$check_api_link ? '<h1 style="color:red;">請輸入API Link或有誤</h1>' : '';?>         
                <label>API Link: </label>
                <input type="text" name="ech_pp_api_link" value="<?= htmlspecialchars(get_option('ech_pp_api_link'))?>" id="ech_pp_api_link" />
            </div>

            <div class="form_row">
                <button type="submit"> Save </button>
            </div>

        </form>
        <div class="statusMsg"></div>
    </div>

</div> <!-- echPlg_wrap -->