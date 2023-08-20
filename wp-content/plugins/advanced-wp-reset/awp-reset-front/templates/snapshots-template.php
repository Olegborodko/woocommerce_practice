<div class="awpr-single-accordion <?php echo in_array('awr-acc-snp-cr', $hidden_blocs) ? '' : 'awpr_accordion_default_opener'; ?>">
    
    <div class="awpr-accordion-title-wrapper awpr_accordion_handler" id="awr-acc-snp-cr">
        <div class="awpr-accordion-title">
            <div class="awpr-heading-icon">
                <span class="icon-monitor text-lg"></span>
            </div>
            Take a Snapshot
            <?php echo $premium_bloc ?>
        </div>
        <div class="awpr-accordion-icon awpr-acc-arrow">
            <span class="icon-arrow-down text-base"></span>
        </div>
    </div>
    <div class="awpr-accordion-content-wrapper awpr_accordion_content_panel">
        <div class="awpr-accordion-content">
            <?php echo $premium_frame_div_start; ?>
            
                <div class="pl-8">
                    <p class="text-xs mb-4 leading-normal">
                        A snapshot is a copy of your website's database at a specific moment in time. If something goes wrong, you can use a previously taken Snapshot to go back to a stable state. Think of snapshots as a simple backup tool that allows you to quickly and easily troubleshoot your website.
                    </p>
                    <p class="text-xs mb-4 leading-normal">
                        We recommend that you start by taking your first Snapshot right away. Give it a meaningful name and press the “Take Snapshot” button below to proceed:
                    </p>
                    
                    <form id="add-snapshot-form" action="#" class="flex flex-wrap items-center gap-3 awpr-snapshot-form">
                        <input id="snapshot-periodicity" type="hidden" value="manually"/>
                        <input type="text" placeholder="Name" id="awpr-add-snapshot-name">
                        
                        <button type="button" class="awpr-button awpr-button-primary <?php echo $premium_button_class; ?>" value="Create" id="create-snapshot">
                            <span class="icon-create-region"></span>
                            <span class="awpr-icon-separator">|</span>
                            Take Snapshot
                        </button>
                    </form>
                </div>
            <?php echo $premium_frame_div_end; ?>
        </div>
    </div>
</div>

<div class="awpr-single-accordion <?php echo in_array('awr-acc-snp-lst', $hidden_blocs) ? '' : 'awpr_accordion_default_opener'; ?>">
    <div class="awpr-accordion-title-wrapper awpr_accordion_handler" id="awr-acc-snp-lst">
        <div class="awpr-accordion-title">
            <div class="awpr-heading-icon">
                <span class="icon-list text-lg"></span>
            </div>
            Available Snapshots
            <?php echo $premium_bloc ?>
        </div>
        <div class="awpr-accordion-icon awpr-acc-arrow">
            <span class="icon-arrow-down text-base"></span>
        </div>
    </div>
    <div class="awpr-accordion-content-wrapper awpr_accordion_content_panel">
        <div class="awpr-accordion-content">
            
        <?php echo $premium_frame_div_start; ?>
            <div id="snapshot_comparison"></div>
            
            <div class="text-right">
                <button class="awpr-button awpr-button-outline-danger awr-bulk-delete <?php echo $premium_button_class; ?>" data-type="snapshot" id='awr-bulk-delete-snapshot'>
                    <span class="icon-delete"></span>
                    <span class="awpr-icon-separator">|</span>
                    Delete
                </button>
            </div>

            <div class="mt-6">
                
                <!--div id='awr-header-snapshot' class="awpr-data-header px-4 mb-2 flexfont-medium justify-between items-center">
                    <h3 class="text-awpr-gray">Snapshots</h3>
                </div-->
                <div id='awr-header-snapshot' class="awpr-data-header px-4 mb-2 table table-fixed w-full">
                    <div class="text-awpr-gray font-medium table-cell align-middle w-1/2">Snapshot</div>
                    <div class="text-awpr-gray font-medium table-cell align-middle w-1/3">Created</div>
                    <div class="text-awpr-gray font-medium table-cell align-middle">Size</div>
                    <div class="text-awpr-gray font-medium table-cell align-middle w-10">&nbsp;</div>
                </div>
                <?php if ( AWR_IS_PRO_VERSION ) { ?> 
                <!-- Loading icon -->
                <div class="text-center p-4" id='awr-custom-snapshot_loading'> 
                    <span class="icon-sync text-awpr-brand text-2xl animate-spin-reverse"></span>
                </div>
                <!-- No snapshot icon -->
                <div class="p-4 text-left" id='awr-no-custom-snapshot' style="display:none;">
                    <p class="text-awpr-brand/50 italic">No Snapshots found</p>
                </div>
                <?php } ?>
                <!-- Row Template -->
                <div id="awr-snapshot-template" style="display: <?php echo AWR_IS_PRO_VERSION ? 'none' : 'block'; ?>" class="awr-snapshot border-b border-t-2 border-[#DCE5EA]">
                    <div class="">
                        <div class="table table-fixed w-full px-4 py-2 text-awpr-gray">
                            <div class="table-cell align-middle w-1/2">
                                <div class="flex items-center gap-2 w-2/3">
                                    <div class="relative z-[1] inline-block h-3.5 w-3.5 shrink-0">
                                        <input type="checkbox" class="peer absolute inset-x-0 top-1/2 z-[2] !h-full !w-full -translate-y-1/2 transform cursor-pointer appearance-none opacity-0 awr-snapshot-bulk" value="">
                                        <div class="absolute inset-x-0 top-1/2 z-[1] h-full w-full shrink-0 -translate-y-1/2 transform rounded-[5px] border-2 border-gray-400 bg-white transition peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                    </div>
                                    <span class="awr-snapshot-name">Before WP update</span>
                                </div>
                                
                            </div>
                            <div class="table-cell align-middle w-1/3 awr-snapshot-created">6d 3h ago</div>
                            <div class="table-cell align-middle awr-snapshot-size">1.02m</div>
                                    
                            <div class="table-cell align-middle text-right w-10">
                                <div class="awpr-cc-action">
                                    <div class="awpr-cc-toggle-icon" data-target="awr-sample-snapshot"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="list-rows" id="awr-sample-snapshot">
                    <!--div-->
                        <div class="px-6 md:px-10 mb-5">
                            <p class="awr-snapshot-date"></p>
                            <p class="awr-snapshot-detail"></p>
                            <div class="flex flex-wrap gap-2 mt-4">
                                <button class="awpr-button awpr-button-dark objects-action awr-snapshot-compare <?php echo $premium_button_class; ?>" data-object='snapshot' data-action='compare' data-name='' data-id=''>
                                    <span class="icon-compare"></span>
                                    <span class="awpr-icon-separator">|</span>
                                    Compare to current
                                </button>
                                <button class="awpr-button awpr-button-success objects-action awr-snapshot-restore <?php echo $premium_button_class; ?>" data-object='snapshot' data-action='execute' data-name='' data-id='' wp-version="">
                                    <span class="icon-restore"></span>
                                    <span class="awpr-icon-separator">|</span>
                                    Restore
                                </button>
                                <button class="awpr-button awpr-button-primary objects-action awr-snapshot-download <?php echo $premium_button_class; ?>" data-object='snapshot' data-action='download' data-name='' data-id=''>
                                    <span class="icon-download"></span>
                                    <span class="awpr-icon-separator">|</span>
                                    Download
                                </button>
                                <button class="awpr-button awpr-button-danger objects-action awr-snapshot-delete <?php echo $premium_button_class; ?>" data-object='snapshot' data-action='delete' data-name='' data-id='' data-type="snapshot">
                                    <span class="icon-delete"></span>
                                    <span class="awpr-icon-separator">|</span>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="awpr-info-box bg-awpr-danger-light px-8 py-4 mt-6 awr-warning-div" id="awr-notice-more-than-10-snapshot" style="display: none;">
                <h3 class="awpr-info-heading flex gap-4 font-medium text-[15px] uppercase text-awpr-danger items-center pb-2 border-b border-awpr-danger mb-3">
                    <span class="icon-warning"></span>
                    Notice
                </h3>
                <p class="mb-3 text-xs leading-relaxed">
                    Please be aware that snapshots can use up a considerable amount of storage space. We recommend that you review and remove unnecessary Snapshots to optimize your disk space usage.
                </p>
            </div>
        <?php echo $premium_frame_div_end; ?>
        </div>
    </div>
</div>

<div class="awpr-single-accordion awpr-settings-tab <?php echo in_array('awr-acc-snp-auto', $hidden_blocs) ? '' : 'awpr_accordion_default_opener'; ?>">
    <div class="awpr-accordion-title-wrapper awpr_accordion_handler" id="awr-acc-snp-auto">
        <div class="awpr-accordion-title">
            <div class="awpr-heading-icon">
                <span class="icon-settings"></span>
            </div>
            Schedule Snapshots
            <?php echo $premium_bloc ?>
        </div>
        <div class="awpr-accordion-icon awpr-acc-arrow">
            <span class="icon-arrow-down text-base"></span>
        </div>
    </div>
    <div class="awpr-accordion-content-wrapper awpr_accordion_content_panel">
        <div class="awpr-accordion-content">
            
            <?php echo $premium_frame_div_start; ?>
                <div>
                    <p class="text-xs leading-normal">Scheduling automated Snapshots is a <b>highly recommended best practice</b> as issues happen when you expect them the least! Below are extensive options that allow you to fine tune the frequency at which Snapshots are taken:</p>
                </div>

                <?php
                $periodicity = null; 
                if ( AWR_IS_PRO_VERSION ) {
                    $periodicity = \awr\services_pro\SnapshotService::get_instance()->get_automated ();
                }
                // Declare variable in case $periodicity is not an array.
                $automated_snapshots_active = $automated_snapshots_activate_all = $hourly_snapshot = $daily_snapshot = $weekly_snapshot = $monthly_snapshot = $hourly_from_now = $hourly_begin_next_hour = $daily_from_now = $daily_at_midnight = $daily_at = $daily_exclude_Monday = $daily_exclude_Tuesday = $daily_exclude_Wednesday = $daily_exclude_Thursday = $daily_exclude_Friday = $daily_exclude_Saturday = $daily_exclude_Sunday = $weekly_from_now = $weekly_on = $monthly_from_today = $monthly_on_first = $hourly_from = $hourly_to = $hourly_at = $daily_at_time = "";
                $weekly_at = date('h:i A');
                $monthly_on = date('d');
                $weekly_on_day = date('l');
                if ( is_array($periodicity) && !empty($periodicity) ) {
                    $automated_snapshots_active = array_key_exists('active', $periodicity) && $periodicity['active'] == true ? "checked" : "";
                    
                    $automated_snapshots_activate_all = array_key_exists('activate_all', $periodicity) && $periodicity['activate_all'] == true ? "checked" : "";
                    $hourly_snapshot = array_key_exists('hourly', $periodicity) && $periodicity['hourly'] == true ? "checked" : "";
                    $daily_snapshot = array_key_exists('daily', $periodicity) && $periodicity['daily'] == true ? "checked" : "";
                    $weekly_snapshot = array_key_exists('weekly', $periodicity) && $periodicity['weekly'] == true ? "checked" : "";
                    $monthly_snapshot = array_key_exists('monthly', $periodicity) && $periodicity['monthly'] == true ? "checked" : "";
                    $hourly_config = array_key_exists('hourly_config', $periodicity) && is_array($periodicity['hourly_config']) ? $periodicity['hourly_config'] : array();
                    $daily_config = array_key_exists('daily_config', $periodicity) && is_array($periodicity['daily_config']) ? $periodicity['daily_config'] : array();
                    $weekly_config = array_key_exists('weekly_config', $periodicity) && is_array($periodicity['weekly_config']) ? $periodicity['weekly_config'] : array();
                    $monthly_config = array_key_exists('monthly_config', $periodicity) && is_array($periodicity['monthly_config']) ? $periodicity['monthly_config'] : array();
                    $hourly_from_now = array_key_exists('hourly_from_now', $hourly_config) && $hourly_config['hourly_from_now'] == true ? "checked" : "";
                    $hourly_begin_next_hour = array_key_exists('hourly_begin_next_hour', $hourly_config) && $hourly_config['hourly_begin_next_hour'] == true ? "checked" : "";
                    $hourly_from = array_key_exists('hourly_from', $hourly_config) ? $hourly_config['hourly_from'] : '';
                    $hourly_to = array_key_exists('hourly_to', $hourly_config) ?  $hourly_config['hourly_to'] : '';
                    $hourly_at = array_key_exists('hourly_at', $hourly_config) ?  $hourly_config['hourly_at'] : '';
                    $daily_from_now = array_key_exists('daily_from_now', $daily_config) && $daily_config['daily_from_now'] == true ? "checked" : "";
                    $daily_at_midnight = array_key_exists('daily_at_midnight', $daily_config) && $daily_config['daily_at_midnight'] == true ? "checked" : "";
                    $daily_at = array_key_exists('daily_at', $daily_config) && $daily_config['daily_at'] == true ? "checked" : "";
                    $daily_at_time = array_key_exists('daily_at_time', $daily_config) ?  $daily_config['daily_at_time'] : '';
                    $daily_exclude_Monday = array_key_exists('daily_exclude_Monday', $daily_config) && $daily_config['daily_exclude_Monday'] == true ? "checked" : "";
                    $daily_exclude_Tuesday = array_key_exists('daily_exclude_Tuesday', $daily_config) && $daily_config['daily_exclude_Tuesday'] == true ? "checked" : "";
                    $daily_exclude_Wednesday = array_key_exists('daily_exclude_Wednesday', $daily_config) && $daily_config['daily_exclude_Wednesday'] == true ? "checked" : "";
                    $daily_exclude_Thursday = array_key_exists('daily_exclude_Thursday', $daily_config) && $daily_config['daily_exclude_Thursday'] == true ? "checked" : "";
                    $daily_exclude_Friday = array_key_exists('daily_exclude_Friday', $daily_config) && $daily_config['daily_exclude_Friday'] == true ? "checked" : "";
                    $daily_exclude_Saturday = array_key_exists('daily_exclude_Saturday', $daily_config) && $daily_config['daily_exclude_Saturday'] == true ? "checked" : "";
                    $daily_exclude_Sunday = array_key_exists('daily_exclude_Sunday', $daily_config) && $daily_config['daily_exclude_Sunday'] == true ? "checked" : "";
                    $weekly_from_now = array_key_exists('weekly_from_now', $weekly_config) && $weekly_config['weekly_from_now'] == true ? "checked" : "";
                    $weekly_on = array_key_exists('weekly_on', $weekly_config) && $weekly_config['weekly_on'] == true ? "checked" : "";
                    $weekly_on_day = array_key_exists('weekly_on_day', $weekly_config) ?  $weekly_config['weekly_on_day'] : date('l');
                    $weekly_at = $weekly_from_now == "checked" && array_key_exists('weekly_at', $weekly_config) ?  $weekly_config['weekly_at'] : date('h:i A');
                    $monthly_from_today = array_key_exists('monthly_from_today', $monthly_config) && $monthly_config['monthly_from_today'] == true ? "checked" : "";
                    $monthly_on_first = array_key_exists('monthly_on_first', $monthly_config) && $monthly_config['monthly_on_first'] == true ? "checked" : "";
                    $monthly_on = $monthly_from_today == "checked" && array_key_exists('monthly_on', $monthly_config) ?  $monthly_config['monthly_on'] : date('d');
                }
                ?>
                <div class="flex gap-4 items-baseline mt-5 mb-2 awr-settings-automated-settings" id="awr-settings-automated-settings">
                    <label for="awr-activate-automated-snapshots" class="relative inline-flex flex-wrap cursor-pointer items-center gap-4 top-0.5">
                        <input <?php echo $automated_snapshots_active; ?> type="checkbox" name="awpr-automatic-snapshot" id="awr-activate-automated-snapshots" class="peer awpr_check_status sr-only" />
                        <div class="peer relative h-3.5 w-6 transform rounded-full border-2 border-gray-400 bg-white transition-all after:absolute after:top-1/2 after:left-[2px] after:h-1.5 after:w-1.5 after:-translate-y-1/2 after:rounded-full after:border-white after:bg-gray-400 after:transition-all after:content-[''] peer-checked:border-green-500 peer-checked:after:translate-x-2.5 peer-checked:after:bg-green-500"></div>
                    </label>
                    <div class="grow">
                        <div class="awpr-nested-ac-heading awpr_accordion_handler">
                            <div class="flex justify-between items-center text-awpr-gray font-semibold text-[13px] relative awpr-radio-label">
                                <label id="awr-automated-snapshot-on-off" class="awpr-label-text flex items-center gap-4 relative z-10 pr-4">
                                    ON
                                </label>
                                <div class="awpr-sub-accordion-icon">
                                    <span class="icon-arrow-down text-xs"></span>
                                </div>
                            </div>
                        </div>
                        <div class="awpr-nested-content-wrapper awpr_accordion_content_panel awpr-content-can-be-disabled">
                            <div class="awpr-nested-content mb-5 flex flex-col pt-7">
                                
                                <div class="awpr-single-check-item px-8 py-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex gap-4 items-center">
                                            <label class="relative inline-flex gap-4 cursor-pointer items-center">
                                                <input type="checkbox" value="" id="hourly_snapshot" class="peer sr-only awr-periodic-snapshot-checkbox" <?php echo $hourly_snapshot; ?> />
                                                <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                                <span class="text-xs font-medium text-[#7A6A84]">Take Snapshots every Hour</span>
                                            </label>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="flex flex-col gap-3 pl-8">
                                        <label class="relative inline-flex flex-wrap cursor-pointer items-center gap-4">
                                            <input type="radio" name="awpr-f-hourly" id="hourly_from_now" value="" class="peer sr-only" <?php echo $hourly_from_now; ?> />
                                            <div class="peer relative h-2.5 w-2.5 rounded-full border-2 border-[#7A6A84] bg-white transition-all peer-checked:bg-[#7A6A84]"></div>
                                            <span class="text-xs">Starting now</span>
                                        </label>
                                        <label class="relative inline-flex flex-wrap cursor-pointer items-center gap-4">
                                            <input type="radio" name="awpr-f-hourly" id="hourly_begin_next_hour" value="" class="peer sr-only" <?php echo $hourly_begin_next_hour; ?> />
                                            <div class="peer relative h-2.5 w-2.5 rounded-full border-2 border-[#7A6A84] bg-white transition-all peer-checked:bg-[#7A6A84]"></div>
                                            <span class="text-xs">Starting next hour</span>
                                        </label>
                                        <label class="relative inline-flex flex-wrap cursor-pointer items-center gap-4">
                                            <span class="text-xs">From </span>
                                            <input type="time" min="00:00" max="12:59" step="60" class="!text-xs" id="hourly_from" value="<?php echo $hourly_from; ?>">
                                            <p>to </p>
                                            <input type="time" min="00:00" max="12:59" step="60" class="!text-xs" id="hourly_to" value="<?php echo $hourly_to; ?>">
                                        </label>
                                    </div>
                                </div>
                                <div class="awpr-single-check-item px-8 py-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <label class="items-center relative inline-flex gap-4 cursor-pointer ">
                                            <input type="checkbox" value="" id="daily_snapshot" class="peer sr-only awr-periodic-snapshot-checkbox" <?php echo $daily_snapshot; ?> />
                                            <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                            <span class="text-xs font-medium text-[#7A6A84]">Take Snapshots every Day</span>
                                        </label>
                                    </div>
                                    <div class="flex flex-col gap-3 pl-8">
                                        <label class="relative inline-flex flex-wrap cursor-pointer items-center gap-4">
                                            <input type="radio" name="awpr-f-daily" id="daily_from_now" value="" class="peer sr-only" <?php echo $daily_from_now; ?> />
                                            <div class="peer relative h-2.5 w-2.5 rounded-full border-2 border-[#7A6A84] bg-white transition-all peer-checked:bg-[#7A6A84]"></div>
                                            <span class="text-xs">Starting now</span>
                                        </label>
                                        <label class="relative inline-flex flex-wrap cursor-pointer items-center gap-4">
                                            <input type="radio" name="awpr-f-daily" id="daily_at_midnight" value="" class="peer sr-only" <?php echo $daily_at_midnight; ?> />
                                            <div class="peer relative h-2.5 w-2.5 rounded-full border-2 border-[#7A6A84] bg-white transition-all peer-checked:bg-[#7A6A84]"></div>
                                            <span class="text-xs">Starting at midnight</span>
                                        </label>
                                        <label class="relative inline-flex flex-wrap cursor-pointer items-center gap-4">
                                            <input type="radio" name="awpr-f-daily" id="daily_at" value="" class="peer sr-only" <?php echo $daily_at; ?> />
                                            <div class="peer relative h-2.5 w-2.5 rounded-full border-2 border-[#7A6A84] bg-white transition-all peer-checked:bg-[#7A6A84]"></div>
                                            <span class="text-xs">Starting at</span>
                                            <input type="time" id="daily_at_time" min="00:00" max="12:59" step="60" class="!text-xs" value="<?php echo $daily_at_time; ?>">
                                        </label>
                                        <p class="text-xs">Excluding the following days:</p>
                                        <div class="flex flex-wrap gap-4 pl-4">
                                            <label class="relative inline-flex cursor-pointer items-center gap-2">
                                                <input type="checkbox" name="awpr-f-day" <?php echo $daily_exclude_Monday; ?> id="daily_exclude_Monday" value="" class="peer sr-only" />
                                                <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                                <span class="text-xs">Mon.</span>
                                            </label>
                                            <label class="relative inline-flex cursor-pointer items-center gap-2">
                                                <input type="checkbox" name="awpr-f-day" <?php echo $daily_exclude_Tuesday; ?> id="daily_exclude_Tuesday" value="" class="peer sr-only" />
                                                <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                                <span class="text-xs">Tues.</span>
                                            </label>
                                            <label class="relative inline-flex cursor-pointer items-center gap-2">
                                                <input type="checkbox" name="awpr-f-day" <?php echo $daily_exclude_Wednesday; ?> id="daily_exclude_Wednesday" value="" class="peer sr-only" />
                                                <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                                <span class="text-xs">Wed.</span>
                                            </label>
                                            <label class="relative inline-flex cursor-pointer items-center gap-2">
                                                <input type="checkbox" name="awpr-f-day" <?php echo $daily_exclude_Thursday; ?> id="daily_exclude_Thursday" value="" class="peer sr-only" />
                                                <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                                <span class="text-xs">Thur.</span>
                                            </label>
                                            <label class="relative inline-flex cursor-pointer items-center gap-2">
                                                <input type="checkbox" name="awpr-f-day" <?php echo $daily_exclude_Friday; ?> id="daily_exclude_Friday" value="" class="peer sr-only" />
                                                <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                                <span class="text-xs">Fri.</span>
                                            </label>
                                            <label class="relative inline-flex cursor-pointer items-center gap-2">
                                                <input type="checkbox" name="awpr-f-day" <?php echo $daily_exclude_Saturday; ?> id="daily_exclude_Saturday" value="" class="peer sr-only" />
                                                <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                                <span class="text-xs">Sat.</span>
                                            </label>
                                            <label class="relative inline-flex cursor-pointer items-center gap-2">
                                                <input type="checkbox" name="awpr-f-day" <?php echo $daily_exclude_Sunday; ?> id="daily_exclude_Sunday" value="" class="peer sr-only" />
                                                <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                                <span class="text-xs">Sun.</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="awpr-single-check-item px-8 py-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <label class="items-center relative inline-flex gap-4 cursor-pointer ">
                                            <input type="checkbox" value="" id="weekly_snapshot" class="peer sr-only awr-periodic-snapshot-checkbox" <?php echo $weekly_snapshot; ?> />
                                            <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                            <span class="text-xs font-medium text-[#7A6A84]">Take Snapshots every Week</span>
                                        </label>
                                    </div>
                                    <div class="flex flex-col gap-3 pl-8">
                                        <label class="relative inline-flex cursor-pointer items-center gap-4">
                                            <input type="radio" name="awpr-f-weekly" id="weekly_from_now" value="" class="peer sr-only" <?php echo $weekly_from_now; ?> />
                                            <div class="peer relative h-2.5 w-2.5 rounded-full border-2 border-[#7A6A84] bg-white transition-all peer-checked:bg-[#7A6A84]"></div>
                                            <span class="text-xs">Starting now (Every <?php echo $weekly_on_day; ?> at <?php echo $weekly_at; ?>)</span>
                                        </label>
                                        <label class="relative inline-flex flex-wrap cursor-pointer items-center gap-4">
                                            <input type="radio" name="awpr-f-weekly" id="weekly_on" value="" class="peer sr-only" <?php echo $weekly_on; ?> />
                                            <div class="peer relative h-2.5 w-2.5 rounded-full border-2 border-[#7A6A84] bg-white transition-all peer-checked:bg-[#7A6A84]"></div>
                                            <span class="text-xs">Every </span>
                                            <div class="flex items-center justify-start gap-2">
                                                <select id="weekly_on_day" class="awpr-select-input">
                                                    <option value="" <?php echo $weekly_on_day == "" ? "selected" : "";?> > - - - </option>
                                                    <option value="Mon" <?php echo $weekly_on_day == "Mon" ? "selected" : "";?> >Monday</option>
                                                    <option value="Tues" <?php echo $weekly_on_day == "Tues" ? "selected" : "";?> >Tuesday</option>
                                                    <option value="Wed" <?php echo $weekly_on_day == "Wed" ? "selected" : "";?> >Wednesday</option>
                                                    <option value="Thur" <?php echo $weekly_on_day == "Thur" ? "selected" : "";?> >Thursday</option>
                                                    <option value="Fri" <?php echo $weekly_on_day == "Fri" ? "selected" : "";?> >Friday</option>
                                                    <option value="Sat" <?php echo $weekly_on_day == "Sat" ? "selected" : "";?> >Saturday</option>
                                                    <option value="Sun" <?php echo $weekly_on_day == "Sun" ? "selected" : "";?> >Sunday</option>
                                                </select>
                                                <span class="text-xs">at midnight</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="awpr-single-check-item px-8 py-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <label class="items-center relative inline-flex gap-4 cursor-pointer ">
                                            <input type="checkbox" value="" id="monthly_snapshot" class="peer sr-only awr-periodic-snapshot-checkbox" <?php echo $monthly_snapshot;?> />
                                            <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                            <span class="text-xs font-medium text-[#7A6A84]">Take Snapshots every Month</span>
                                        </label>
                                    </div>
                                    <div class="flex flex-col gap-3 pl-8">
                                        <label class="relative inline-flex cursor-pointer items-center gap-4">
                                            <input type="radio" name="awpr-f-monthly" id="monthly_from_today" value="" class="peer sr-only" <?php echo $monthly_from_today; ?> />
                                            <div class="peer relative h-2.5 w-2.5 rounded-full border-2 border-[#7A6A84] bg-white transition-all peer-checked:bg-[#7A6A84]"></div>
                                            <span class="text-xs">Starting now (Every <?php echo $monthly_on; ?> of month at midnight)</span>
                                        </label>
                                        <label class="relative inline-flex flex-wrap cursor-pointer items-center gap-4">
                                            <input type="radio" name="awpr-f-monthly" id="monthly_on_first" value="" class="peer sr-only" <?php echo $monthly_on_first; ?> />
                                            <div class="peer relative h-2.5 w-2.5 rounded-full border-2 border-[#7A6A84] bg-white transition-all peer-checked:bg-[#7A6A84]"></div>
                                            <span class="text-xs">On the 1st day of each month</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn-appliquer-awpr objects-action awpr-button awpr-button-primary <?php echo $premium_button_class; ?>" value="planify" id="save-automatic-snapshot">
                                <span class="icon-list"></span>
                                <span class="awpr-icon-separator">|</span>
                                Schedule
                            </button>
                            
                        </div>
                    </div>
                </div>
            <?php echo $premium_frame_div_end; ?>
        </div>
    </div>
</div>