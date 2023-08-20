<div class="awpr-single-accordion awpr-settings-tab <?php echo in_array('awr-acc-coll-cr', $hidden_blocs) ? '' : 'awpr_accordion_default_opener'; ?>">
    
    <div class="awpr-accordion-title-wrapper awpr_accordion_handler" id="awr-acc-coll-cr">
        <div class="awpr-accordion-title">
            <div class="awpr-heading-icon">
                <span class="icon-category-plus text-xl"></span>
            </div>
            Collection Builder 
            <?php echo $premium_bloc ?>
        </div>
        <div class="awpr-accordion-icon awpr-acc-arrow">
            <span class="icon-arrow-down text-base"></span>
        </div>
    </div>
    <div class="awpr-accordion-content-wrapper awpr_accordion_content_panel">
        <div class="awpr-accordion-content">
                
            <?php echo $premium_frame_div_start; ?>

                <p class="text-xs mb-3 leading-normal">
                    A Collection is a subset of the +30 tools available in Advanced WP Reset that you can run in a 
                    
                </p>
                <p class="text-xs mb-3 leading-normal">
                    To build a Collection, simply:<br />
                    <ul class="mb-8 list-disc pl-10 text-xs">
                        <li>Select the tools you want to include in the collection.</li>
                        <li>Schedule when the collection should run.</li>
                        <li>Provide a name for your collection</li>
                    </ul>
                </p>
                <form id='add-collection-form' action="#">
                    <!-- Tools -->
                    <div class="mb-10">
                        <div class="flex justify-between items-center text-awpr-gray font-semibold text-[13px] mb-7 relative awpr-radio-label">
                            <h4 class="awpr-label-text flex items-center gap-4 relative z-10 pr-4">Select your tools</h4>
                        </div>
                        <div class="awpr-nested-content mb-5 pl-4">
                            <?php 
                            $ToolsService = 'awr\services\ToolsResetService';
                            if ( AWR_IS_PRO_VERSION )
                                $ToolsService = 'awr\services_pro\ToolsResetService';
                            // Prepare the list of items to reset with their explanations
                            $items_array = $ToolsService::get_instance()->get_tasks();
                            $i = 1;
                            foreach ($items_array as $item_type => $item_info) { 
                                foreach ($item_info['table_tasks'] as $row_task) {
                                    
                                    if ( array_key_exists('available_for_collections', $row_task) && $row_task['available_for_collections'] == false ) 
                                        continue;
                                    
                                    // We show an HR from the second row
                                    if ( $i++ != 1)
                                        echo '<hr class="mb-5" />';
                                    ?>
                                    <div class="awpr-coll-item mb-5">
                                        <div class="flex gap-4 items-center mb-3">
                                            <label class="relative inline-flex gap-4 cursor-pointer items-center">
                                                <input type="checkbox" value="" class="peer sr-only collection-task" name="<?php echo $row_task['task']; ?>" id="<?php echo $row_task['task']; ?>" />
                                                <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                                <span class="text-xs font-semibold text-[#7A6A84]"><?php echo $row_task['title'] ?></span>
                                            </label>
                                            <div class="flex gap-2">
                                                <?php print_deals_with_files_db ( $row_task['deals_with_files'], $row_task['deals_with_db'], 'small'); ?>
                                            </div>
                                        </div>
                                        <div class="pl-8">
                                            <p class="text-awpr-gray">
                                                <?php 
                                                    if( array_key_exists('explanaition_for_collections', $row_task) )
                                                        echo $row_task['explanaition_for_collections']; 
                                                    else 
                                                        echo $row_task['explanaition']; 
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    
                            <?php }
                            } ?>
                        </div>
                    </div>
                    
                    <!-- Frequency -->
                    <div class="awpr-single-radio">

                        <div class="flex justify-between items-center text-awpr-gray font-semibold text-[13px] mb-7 relative awpr-radio-label">
                            <h4 class="awpr-label-text flex items-center gap-4 relative z-10 pr-4">Schedule your collection</h4>
                        </div>
                        <div class="awpr-single-check-item px-1 md:px-4 py-2">
                            <div class="flex items-center justify-between">
                                <div class="flex gap-4 items-center">
                                    <label class="relative inline-flex gap-4 cursor-pointer items-center">
                                        <input type="radio" name="awr-collection-periodicity" id="on_demand_collection" value="on-demand" class="peer sr-only" checked />
                                        <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                        <span class="text-xs font-medium text-[#7A6A84]">Run on demand</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="awpr-single-check-item px-1 md:px-4 py-2">
                            <div class="flex items-center justify-between">
                                <div class="flex gap-4 items-center">
                                    <label class="relative inline-flex gap-4 cursor-pointer items-center">
                                        <input type="radio" name="awr-collection-periodicity" id="dailly_collection" value="daily" class="peer sr-only" />
                                        <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                        <span class="text-xs font-medium text-[#7A6A84]">Run daily</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="awpr-single-check-item px-1 md:px-4 py-2">
                            <div class="flex items-center justify-between">
                                <div class="flex gap-4 items-center">
                                    <label class="relative inline-flex gap-4 cursor-pointer items-center">
                                        <input type="radio" name="awr-collection-periodicity" id="weekly_collection" value="weekly" class="peer sr-only" />
                                        <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                        <span class="text-xs font-medium text-[#7A6A84]">Run weekly</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="awpr-single-check-item px-1 md:px-4 py-2">
                            <div class="flex items-center justify-between">
                                <div class="flex gap-4 items-center">
                                    <label class="relative inline-flex gap-4 cursor-pointer items-center" for="monthly_collection">
                                        <input type="radio" name="awr-collection-periodicity" id="monthly_collection" value="monthly" class="peer sr-only" />
                                        <div class="peer h-3.5 w-3.5 rounded-[3px] border-2 border-gray-400 bg-white transition-all peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                        <span class="text-xs font-medium text-[#7A6A84]" for="monthly_collection">Run monthly</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Collection description -->
                    <div class="mt-5 mb-10">
                        <div class="flex justify-between items-center text-awpr-gray font-semibold text-[13px] mb-7 relative awpr-radio-label">
                            <h4 class="awpr-label-text flex items-center gap-4 relative z-10 pr-4">Give it a name </h4>
                        </div>
                        <div class="awpr-nested-content mb-5 pl-4">
                            <div class="flex gap-4 awpr-collection-form">
                                <label for="awpr-co-name" class="flex items-center">Collection name: </label>
                                <input type="text" name="collection-name" id="awpr-add-collection-name" placeholder="Before upgrade, After reset, ...">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="mb-5">
                        <!--div class="flex justify-between items-center text-awpr-gray font-semibold text-[13px] mb-7 relative awpr-radio-label">
                            <h4 class="awpr-label-text flex items-center gap-4 relative z-10 pr-4 cursor-pointer">Actions</h4>
                        </div-->
                        <div class="awpr-nested-content mb-5 pl-4">
                            <div class="flex flex-wrap gap-2">
                                <button class="awpr-button awpr-button-success <?php echo $premium_button_class; ?>" id="create-collection">
                                    <span class="icon-save text-xs"></span>
                                    <span class="awpr-icon-separator">|</span>
                                    Save
                                </button>
                                <button class="awpr-button awpr-button-primary <?php echo $premium_button_class; ?>" id="create-and-run-collection">
                                    <span class="icon-terminal text-xs"></span>
                                    <span class="awpr-icon-separator">|</span>
                                    Save and Run
                                </button>
                                <button type="reset" class="awpr-button awpr-button-danger <?php echo $premium_button_class; ?>" id="cancel-collection">
                                    <span class="icon-close text-xs"></span>
                                    <span class="awpr-icon-separator">|</span>
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php echo $premium_frame_div_end; ?>
        </div>
    </div>
</div>

<div id="list-collection" class="awpr-single-accordion <?php echo in_array('awr-acc-coll-lst', $hidden_blocs) ? '' : 'awpr_accordion_default_opener'; ?>">
    <div class="awpr-accordion-title-wrapper awpr_accordion_handler" id="awr-acc-coll-lst">
        <div class="awpr-accordion-title">
            <div class="awpr-heading-icon">
                <span class="icon-category text-lg"></span>
            </div>
            Saved Collections
            <?php echo $premium_bloc ?>
        </div>
        <div class="awpr-accordion-icon awpr-acc-arrow">
            <span class="icon-arrow-down text-base"></span>
        </div>
    </div>
    <div class="awpr-accordion-content-wrapper awpr_accordion_content_panel">
        <div class="awpr-accordion-content">
            <?php echo $premium_frame_div_start; ?>
                <div class="text-right">
                    <button class="awpr-button awpr-button-outline-danger awr-bulk-delete <?php echo $premium_button_class; ?>" data-type="collection" id='awr-bulk-delete-collection'>
                        <span class="icon-delete"></span>
                        <span class="awpr-icon-separator">|</span>
                        Delete
                    </button>
                </div>
                <div class="mt-6">
                    
                    <div id='awr-header-collection' class="awpr-data-header px-4 mb-2 table table-fixed w-full">
                        <div class="text-awpr-gray font-medium table-cell align-middle w-1/2">Name</div>
                        <div class="text-awpr-gray font-medium table-cell w-1/4 align-middle">Created</div>
                        <div class="text-awpr-gray font-medium table-cell w-1/5 align-middle">Schedule</div>
                        <div class="text-awpr-gray font-medium table-cell align-middle w-10">&nbsp;</div>
                    </div>
                    <?php if ( AWR_IS_PRO_VERSION ) { ?>
                    <!-- Loading icon -->
                    <div class="text-center p-4" id='awr-custom-collection_loading'> 
                        <span class="icon-sync text-awpr-brand text-2xl animate-spin-reverse"></span>
                    </div>
                    <!-- No collection icon -->
                    <div class="p-4 text-left" id='awr-no-custom-collection' style="display:none;">
                        <p class="text-awpr-brand/50 italic">No collections found</p>
                    </div>
                    <?php } ?>
                    <!-- Row Template -->
                    <div id="awr-collection-template" style="display: <?php echo AWR_IS_PRO_VERSION ? 'none' : 'block'; ?>" class=" border-b border-t-2 border-[#DCE5EA] awr-collection">
                        <div class="">
                            <div class="table table-fixed w-full px-4 py-2 text-awpr-gray">
                                
                                <div class="table-cell align-middle w-1/2">
                                    <div class="flex items-center gap-2 w-2/3">
                                        <div class="relative z-[1] inline-block h-3.5 w-3.5 shrink-0">
                                            <input type="checkbox" class="peer absolute inset-x-0 top-1/2 z-[2] !h-full !w-full -translate-y-1/2 transform cursor-pointer appearance-none opacity-0 awr-collection-bulk" value="">
                                            <div class="absolute inset-x-0 top-1/2 z-[1] h-full w-full shrink-0 -translate-y-1/2 transform rounded-[5px] border-2 border-gray-400 bg-white transition peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                        </div>
                                        <span class="awr-collection-name">Unwanted data clean up</span>
                                    </div>
                                    
                                </div>
                                <div class="table-cell align-middle w-1/4 awr-collection-created">5d ago</div>
                                <div class="table-cell align-middle w-1/5 awr-collection-size">
                                    
                                    
                                    <!-- On demand -->
                                    <?php if ( AWR_IS_PRO_VERSION ) { ?>
                                    
                                    <div class="awr-to-run-automatically flex items-center gap-2">
                                        <span class="icon-timer text-base"></span>
                                        <span class="awr-to-run-automatically-text"></span>
                                    </div>
                                    <div class="awr-to-run-on-demand flex items-center gap-2">
                                        <span class="icon-ads-click text-base"></span>
                                        <span class="awr-to-run-on-demand">On demand</span>
                                    </div>
                                    <?php } else { ?>
                                    
                                    <div class="awr-to-run-automatically flex items-center gap-2">
                                        <span class="icon-timer text-base"></span>
                                        <span class="awr-to-run-automatically-text">Daily</span>
                                    </div>
                                    
                                    <?php }  ?>
                                </div>
                                    
                                <div class="awpr-cc-action flex items-center justify-between gap-12">
                                    <div class="awpr-cc-toggle-icon" data-target="awr-sample-collection"></div>
                                </div>
                            </div>
                        </div>
                        <div class="list-rows" id="awr-sample-collection">
                        <!--div-->
                            <div class="px-6 md:px-10 mb-5">
                                <p class="text-xs font-semibold text-awpr-gray mb-2">Tools</p>
                                <ul class="flex flex-col gap-1 mb-8 collection-tasks">
                                    <li class="text-xs text-awpr-gray mb-0"> - Delete trashed posts</li>
                                    <li class="text-xs text-awpr-gray mb-0"> - Delete revisions</li>
                                    <li class="text-xs text-awpr-gray mb-0"> - Delete spam comments</li>
                                </ul>
                                
                                <div class="flex flex-wrap gap-2">
                                    <button class="awpr-button awpr-button-primary objects-action awr-collection-run <?php echo $premium_button_class; ?>" data-object='collection' data-action='execute' data-name='' data-id=''>
                                        <span class="icon-terminal"></span>
                                        <span class="awpr-icon-separator">|</span>
                                        Run
                                    </button>
                                    <button class="awpr-button awpr-button-outline-danger objects-action awr-collection-delete <?php echo $premium_button_class; ?>" data-object='collection' data-action='delete' data-name='' data-id='' data-type="collection">
                                        <span class="icon-delete"></span>
                                        <span class="awpr-icon-separator">|</span>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php echo $premium_frame_div_end; ?>
        </div>
    </div>
</div>