<?php
$ItemsFetcherService = 'awr\services\ToolsResetService';
if ( AWR_IS_PRO_VERSION )
    $ItemsFetcherService = 'awr\services_pro\ToolsResetService'; 
?>
<!-- Switch WP core version : Start -->
<div class="awpr-single-accordion <?php echo in_array('awr-acc-switch', $hidden_blocs) ? '' : 'awpr_accordion_default_opener'; ?>">
    
    <div class="awpr-accordion-title-wrapper awpr_accordion_handler" id="'awr-acc-switch'">
        <div class="awpr-accordion-title">
            <div class="awpr-heading-icon">
                <span class="icon-swap-horizontal"></span>
            </div>
            WordPress Core Switcher
            
            <?php echo $premium_bloc ?>
        </div>
        <div class="awpr-accordion-icon awpr-acc-arrow">
            <span class="icon-arrow-down text-base"></span>
        </div>
    </div>
    <div class="awpr-accordion-content-wrapper awpr_accordion_content_panel">
        <div class="awpr-accordion-content">
            <?php echo $premium_frame_div_start; ?>
                <div class="">
                    <p class="mb-3 mt-2 text-xs leading-relaxed">WP Switcher is a unique and powerful tool that allows you to quickly and easily switch between WordPress Core versions.</p>
                </div>
                <div class="grid gap-2 grid-cols-12 items-start justify-start py-4">
                    <div class="awpr-tools-item col-span-4">
                        <h3 class="font-semibold text-awpr-gray">Choose the target version</h3>
                        <p class="italic">Current version: <?php global $wp_version; echo $wp_version; ?></p>
                        <div class="flex gap-2 mt-5">
                            <?php print_deals_with_files_db ( true, true ); ?>
                        </div>
                    </div>
                                    <!-- Middle side -->
                    <div class="awpr-tools-desc col-span-8">
                        
                        <p class="mb-4">
                            <select name="version" id="wp_version_switch">
                                <?php
                                $versions = $ItemsFetcherService::get_instance()->get_wp_version_list();
                                foreach ($versions as $version) { ?>
                                    <option value="<?php echo $version; ?>"><?php echo $version; ?></option>
                                <?php } ?>
                            </select>
                        </p>
                        <!-- This div should only render when error occurs -->
                        <div class="bg-awpr-danger-light p-4 mb-4" style="display: none;">
                            <p id="wp_version_switch_errors">
                            </p>
                        </div>
                        <!-- / This div should only render when error occurs -->
                        <button id='button_for_wp-version' name='wp-version' value='Switch WP core version' class="awpr-button awpr-button-primary <?php echo $premium_button_class; ?>">
                            <span class="icon-swap-horizontal"></span>
                            <span class="awpr-icon-separator">|</span>
                            Switch WP Version
                        </button>
                    </div>
                </div>
            <?php echo $premium_frame_div_end; ?>
        </div>
    </div>
</div>
<!-- Switch WP core version : End -->
