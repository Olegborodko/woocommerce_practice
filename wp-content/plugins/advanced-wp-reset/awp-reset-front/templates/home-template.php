<?php 
use awr\services\CommonService as CommonService; 

$license_message = 'valid';
$premium_bloc = '<!-- Premium Badge -->
            <span class="premium-badge">
                <span class="icon-lock"></span>
                Pro
            </span>';
            $premium_frame_div_start = '<div class="awpr-premium-frame space-y-6">';
$premium_frame_div_end = '</div>';
$premium_button_class = 'in-pro-only';

$license = null;

if ( AWR_IS_PRO_VERSION ) {
	$license = \awr\services_pro\LicenseService::get_instance()->check();
	$license_message = $license['message'];
	$premium_bloc = '';
	$premium_frame_div_start = '';
	$premium_frame_div_end = '';
	$premium_button_class = '';
}

require_once 'html-functions.php';

$always_show_notifications = CommonService::get_instance()->get_show_notifications ();
$nav_anchor = isset($_SESSION['nav_anchor']) ? $_SESSION['nav_anchor'] : 'awpr-reset' ;

$awpr_li_reset_class 		= $nav_anchor == 'awpr-reset' 		? 'awpr-active' : '';
$awpr_li_snapshots_class 	= $nav_anchor == 'awpr-snapshots' 	? 'awpr-active' : '';
$awpr_li_tools_class 		= $nav_anchor == 'awpr-tools' 		? 'awpr-active' : '';
$awpr_li_collections_class 	= $nav_anchor == 'awpr-collections' ? 'awpr-active' : '';
$awpr_li_switcher_class 	= $nav_anchor == 'awpr-switcher' 	? 'awpr-active' : '';
$awpr_li_settings_class 	= $nav_anchor == 'awpr-settings' 	? 'awpr-active' : '';
$awpr_div_reset_class 		= $nav_anchor == 'awpr-reset' 		? '' : 'hidden';
$awpr_div_snapshots_class 	= $nav_anchor == 'awpr-snapshots' 	? '' : 'hidden';
$awpr_div_tools_class 		= $nav_anchor == 'awpr-tools' 		? '' : 'hidden';
$awpr_div_collections_class = $nav_anchor == 'awpr-collections' ? '' : 'hidden';
$awpr_div_switcher_class 	= $nav_anchor == 'awpr-switcher' 	? '' : 'hidden';
$awpr_div_settings_class 	= $nav_anchor == 'awpr-settings' 	? '' : 'hidden';

$hidden_blocs = CommonService::get_instance()->get_hidden_blocs();
$hidden_blocs = is_array($hidden_blocs) ? array_values($hidden_blocs) : array();

?>
<div id="awpr-plugin-content" class=" max-w-screen-2xl mx-auto relative text-awpr-gray pl-3 pr-4 py-12 xl:px-8 2xl:p-12">
	<h1 class="awpr-page-heading text-awpr-brand font-awpr-base text-xl md:text-[23px] font-medium flex items-center gap-4 mb-10">
		<img src="<?php echo AWR_PLUGIN_IMG_URL; ?>/logo.svg" alt="Logo">
		<span class="font-bold"><?php _e('Advanced WP Reset', AWR_PLUGIN_TEXTDOMAIN); ?></span>
	</h1>
	<div class="awpr-content-wrapper font-awpr-base flex flex-col lg:flex-row gap-10 2xl:gap-12">
		
		<div class="awpr-main-content flex-1">
			<!-- AWPR Tabs Menu -->
			<ul id="awpr_tab_menu" class="awpr-tab-menu">
				<?php if ( !AWR_IS_PRO_VERSION || $license_message == LICENCE_STATE_VALID ) { ?>
				<!-- Reset -->
				<li class="awpr-tab-item <?php echo $awpr_li_reset_class; ?>" data-target="awpr-reset">
					<a id="awpr-default-tab" href="#awpr-reset">
						<span class="icon-restart text-xl"></span>
						<?php _e('Reset', AWR_PLUGIN_TEXTDOMAIN); ?>
					</a>
				</li>
				<!-- Snapshots -->
				<li class="awpr-tab-item <?php echo $awpr_li_snapshots_class; ?>" data-target="awpr-snapshots">
					<a href="#awpr-snapshots">
						<span class="icon-monitor text-lg"></span>
						<?php _e('Snapshots', AWR_PLUGIN_TEXTDOMAIN); ?>
					</a>
				</li>
				<!-- Tools -->
				<li class="awpr-tab-item <?php echo $awpr_li_tools_class; ?>" data-target="awpr-tools">
					<a href="#awpr-tools">
						<span class="icon-tools text-lg"></span>
						<?php _e('Tools', AWR_PLUGIN_TEXTDOMAIN); ?>
					</a>
				</li>
				<!-- Collections -->
				<li class="awpr-tab-item <?php echo $awpr_li_collections_class; ?>" data-target="awpr-collections">
					<a href="#awpr-collections">					
						<span class="icon-category text-lg"></span>
						<?php _e('Collections', AWR_PLUGIN_TEXTDOMAIN); ?>
					</a>
				</li>
				<!-- Tools -->
				<li class="awpr-tab-item <?php echo $awpr_li_switcher_class; ?>" data-target="awpr-switcher">
					<a href="#awpr-switcher">
						<span class="icon-swap-horizontal"></span>
						<?php _e('WP Switcher', AWR_PLUGIN_TEXTDOMAIN); ?>
					</a>
				</li>

				<?php if ( AWR_IS_PRO_VERSION ) { ?>
					<!-- Settings -->
					<li class="awpr-tab-item <?php echo $awpr_li_settings_class; ?>" data-target="awpr-settings">
						<a href="#awpr-switcher">
							<span class="icon-settings"></span>
							<?php _e('Settings', AWR_PLUGIN_TEXTDOMAIN); ?>
						</a>
					</li>
					<?php } ?>
				<?php } else { ?>
				<!-- Activation -->
				<li class="awpr-tab-item awpr-active" data-target="awpr-activation">
					<a href="#awpr-activation">
						<span class="icon-key text-lg"></span>
						<?php _e('Activation', AWR_PLUGIN_TEXTDOMAIN); ?>
					</a>
				</li>
				<?php } ?>
			</ul>
			<!-- AWPR Tab Contents -->
			<div id="awpr_tab_contents">
				<?php if ( !AWR_IS_PRO_VERSION || $license_message == LICENCE_STATE_VALID ) { ?>
				<div id="awpr-reset" class="<?php echo $awpr_div_reset_class; ?> awpr-single-tab-panel">
					<?php require_once 'reset-template.php'; ?>
				</div>
				<div id="awpr-snapshots" class="<?php echo $awpr_div_snapshots_class; ?> awpr-single-tab-panel">
					<?php require_once 'snapshots-template.php'; ?>
				</div>
				<div id="awpr-tools" class="<?php echo $awpr_div_tools_class; ?> awpr-single-tab-panel">
					<?php require_once 'tools-template.php'; ?>
				</div>
				<div id="awpr-collections" class="<?php echo $awpr_div_collections_class; ?> awpr-single-tab-panel">
					<?php require_once 'collections-template.php'; ?>
				</div>
				<div id="awpr-switcher" class="<?php echo $awpr_div_switcher_class; ?> awpr-single-tab-panel">
					<?php require_once 'switcher-template.php'; ?>
				</div>
				<?php if ( AWR_IS_PRO_VERSION ) { ?>
					<div id="awpr-settings" class="<?php echo $awpr_div_settings_class; ?> awpr-single-tab-panel">
						<?php require_once 'settings-template.php'; ?>
					</div>
				<?php } ?>
				<?php } else { ?>
				<div id="awpr-activation" class="awpr-single-tab-panel">
					<?php require_once 'activation-template.php'; ?>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="awpr-sidebar max-w-[280px] shrink-0 mt-12">
			<?php require_once 'sidebar-template.php'; ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		<?php if ( $always_show_notifications ) { ?>
			jQuery('.awr-warning-div').show();
		<?php } else { ?>
			jQuery('.awr-warning-div').hide();
		<?php } ?>
	});
</script>

<script type="text/javascript" id="zsiqchat">var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "siq5e3251faf55a0977bec9f8fb57f9db757b1e23a6ba2593e5ae5a3125dfa50470", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zohopublic.com/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);</script>
