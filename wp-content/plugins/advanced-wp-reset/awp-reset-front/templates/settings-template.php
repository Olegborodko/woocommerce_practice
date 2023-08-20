<div class="awpr-single-accordion <?php echo in_array('awr-acc-rst-st', $hidden_blocs) ? '' : 'awpr_accordion_default_opener'; ?>">
    
    <div class="awpr-accordion-title-wrapper awpr_accordion_handler" id="awr-acc-rst-st">
        <div class="awpr-accordion-title">
            <div class="awpr-heading-icon">
                <span class="icon-system-reset"></span>
            </div>
            <?php _e('Settings', AWR_PLUGIN_TEXTDOMAIN); ?>
        </div>
        <div class="awpr-accordion-icon awpr-acc-arrow leading-none">
            <span class="icon-arrow-down text-base"></span>
        </div>
    </div>
    
    <div class="awpr-accordion-content-wrapper awpr_accordion_content_panel">
        <div class="awpr-accordion-content">
            <div class="space-y-6">
                <div class="awpr-nested-content mb-5 pl-8">

                    <p class="text-xs text-awpr-gray">To manage your sites, go to <a target="_blank" href="https://awpreset.com/checkout/history" class="awpr-link">your account</a></p>

                    <hr class="border-[#CBBDD4] border-b border-t-0 my-5">

                    <?php 

                    try {

                        $license_key = \awr\services_pro\LicenseService::get_instance()->get_license_key();
                        $license_to_print = substr($license_key, 0, 4) . '*****';
                    ?>
                        <p class="text-xs text-awpr-gray mb-3">To deactivate your license <b>[<?php echo $license_to_print; ?>]</b> from this site, click on the deactivate my license.</p>

                        <form action="#" class="awpr-reset-form flex flex-wrap items-center gap-4">
                            <button id="AWR_deactivation_button" data-action="activation" type="button" class="awpr-button awpr-button-primary">
                                <span class="icon-key"></span>
                                <span class="awpr-icon-separator">|</span>
                                Deactivate my license
                            </button>
                        </form>

                    <?php } catch (\Exception $e ) { ?>

                        <p class="text-xs text-awpr-gray mb-5"><?php echo $e->getMessage(); ?></p>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>