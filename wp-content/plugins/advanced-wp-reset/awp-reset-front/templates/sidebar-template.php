<div class="awpr-widgets-wrapper">
    <?php if ( !AWR_IS_PRO_VERSION ) { ?>
    <!-- Banner -->
    <div class="mb-5">
        <a href="<?php echo AWR_PLUGIN_PRO_STORE_URL; ?>" class="block">
            <img src="<?php echo AWR_PLUGIN_IMG_URL; ?>/banner-1.png" alt="banner" class="w-full h-full block">
        </a>
    </div>
    <?php } ?>
    
    <div class="awpr-widget mb-5">
        <h3 class="awpr-widget-title">
            <span class="icon-support"></span>
            Support
        </h3>
        <div class="mt-4">
            <p class="awpr-widget-text mb-6">Please don't hesitate to get in touch if you need any help.</p>
            <div class="flex flex-col gap-2">
                <a href="<?php echo AWR_PLUGIN_SUPPORT; ?>" target="_blank" class="awpr-button awpr-button-outline-primary w-full">
                    <span class="icon-contact-support"></span>
                    <span class="awpr-icon-separator">|</span>
                    Contact Support
                </a>
                <a href="#" target="_blank" class="awpr-button awpr-button-outline-primary w-full" id="awr-get-system-infos">
                    <span class="icon-bug"></span>
                    <span class="awpr-icon-separator">|</span>
                    System infos
                </a>
                <!--a href="#" target="_blank" class="awpr-button-brand border border-awpr-brand inline-flex items-center px-3 py-1 gap-3 text-[13px] text-awpr-brand hover:bg-awpr-brand hover:border-awpr-brand hover:text-white transition-all duration-200 ease-in-out">
                    <span class="icon-emergency"></span>
                    <span class="awpr-icon-separator">|</span>
                    emergency
                </a-->
            </div>
        </div>
    </div>
    <!--div class="awpr-widget">
        <h3 class="awpr-widget-title">
            <span class="icon-rating"></span>
            Rating
        </h3>
        <div class="mt-4">
            <form action="<?php echo AWR_PLUGIN_RATING; ?>">
                <p class="awpr-widget-text mb-6">How do you rate our services?</p>
                
                <div class="flex items-center gap-2 mb-5">
                    <button type="submit" class="text-awpr-brand">
                        <span class="icon-star-full text-lg"></span>
                    </button>
                    <button type="submit" class="text-awpr-brand">
                        <span class="icon-star-full text-lg"></span>
                    </button>
                    <button type="submit" class="text-awpr-brand">
                        <span class="icon-star-full text-lg"></span>
                    </button>
                    <button type="submit" class="text-awpr-brand">
                        <span class="icon-star-full text-lg"></span>
                    </button>
                    <button type="submit" class="text-awpr-brand">
                        <span class="icon-star-full text-lg"></span>
                    </button>
                </div>
                <div class="awpr-feedback-text flex gap-16 text-awpr-brand font-normal">
                    <button type="submit" class="text-[11px]">Bad</button>
                    <button type="submit" class="text-[11px]">Very Good</button>
                </div>
            </form>
        </div>
    </div-->
</div>