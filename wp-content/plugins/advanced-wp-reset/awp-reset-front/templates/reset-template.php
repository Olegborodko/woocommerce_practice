<div class="awpr-single-accordion <?php echo in_array('awr-acc-rst-st', $hidden_blocs) ? '' : 'awpr_accordion_default_opener'; ?>">
    
    <div class="awpr-accordion-title-wrapper awpr_accordion_handler" id="awr-acc-rst-st">
        <div class="awpr-accordion-title">
            <div class="awpr-heading-icon">
                <span class="icon-system-reset"></span>
            </div>
            <?php _e('Site reset', AWR_PLUGIN_TEXTDOMAIN); ?>
        </div>
        <div class="awpr-accordion-icon awpr-acc-arrow leading-none">
            <span class="icon-arrow-down text-base"></span>
        </div>
    </div>
    
    <div class="awpr-accordion-content-wrapper awpr_accordion_content_panel">
        <div class="awpr-accordion-content">
            <div class="space-y-6">
                <div class="awpr-nested-content mb-5 pl-8">

                    <p class="mb-2 text-xs"><?php _e('This <b>Site Reset</b> option will clean and reset ALL DATABASE DATA. This means, all the following items will be removed:', AWR_PLUGIN_TEXTDOMAIN); ?></p>
                    <ul class="mb-5 text-xs pl-6">
                        <li class="flex gap-2">
                            <span class="icon-check-square text-base"></span>
                            <span class="line-through"><?php _e('Pages, Posts and Comments', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                        </li>
                        <li class="flex gap-2">
                            <span class="icon-check-square text-base"></span>
                            <span class="line-through"><?php _e('Custom tables', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                        </li>
                        <li class="flex gap-2">
                            <span class="icon-check-square text-base"></span>
                            <span class="line-through"><?php _e('Users (except the current admin user)', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                        </li>
                    </ul>
                    <p class="mb-2"><?php _e('After the Reset, the following will remain untouched:', AWR_PLUGIN_TEXTDOMAIN); ?></p>
                    <ul class="text-xs pl-6">
                        <li class="flex gap-2">
                            <span class="icon-square-box text-base"></span>
                            <span><?php _e('The current admin user', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                        </li>
                        <li class="flex gap-2">
                            <span class="icon-square-box text-base"></span>
                            <span><?php _e('Files, Uploads, Themes, Child themes, Plugins, etc.', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                        </li>
                        <li class="flex gap-2">
                            <span class="icon-square-box text-base"></span>
                            <span><?php _e('Basic WP settings like Site title, WP address, Site address, Time zone & Language', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                        </li>
                        <li class="flex gap-2">
                            <span class="icon-square-box text-base"></span>
                            <span><?php _e('Non WordPress Database Tables', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                        </li>
                    </ul>
                </div>
                <div class="awpr-info-box bg-awpr-danger-light px-8 py-4 awr-warning-div">
                    <h3 class="awpr-info-heading flex gap-4 font-medium text-[15px] uppercase text-awpr-danger items-center pb-2 border-b border-awpr-danger mb-3">
                        <span class="icon-warning"></span>    
                        <?php _e('Warning', AWR_PLUGIN_TEXTDOMAIN); ?>
                    </h3>

                    


                    <p class="mb-3 text-xs leading-relaxed"><?php _e('Once you click on the <b>Reset</b> button, <b>THERE IS NO UNDO</b>. Please make sure you have read the details above and that you want to Reset your Database to its default state.', AWR_PLUGIN_TEXTDOMAIN); ?> </p>
                </div>
                <div class="awpr-info-box bg-[#FEFCFF] px-8 py-4">
                    <p class="mb-3 text-xs leading-relaxed"><?php _e('Type in the word <b>RESET</b> in the input field below before clicking on the Reset button to proceed.', AWR_PLUGIN_TEXTDOMAIN); ?></p>
                    <form action="#" class="flex flex-wrap items-center gap-3 awpr-reset-form">
                        <input type="text" id="AWR_reset_confirmation_default" placeholder="<?php _e('Reset', AWR_PLUGIN_TEXTDOMAIN); ?>">
                        <button type="button" data-type="default" class="AWR_reset_button awpr-modal-btn awpr-button awpr-button-danger">
                            <span class="icon-restart text-lg"></span>
                            <span class="awpr-icon-separator">|</span>
                            <?php _e('Reset', AWR_PLUGIN_TEXTDOMAIN); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="awpr-single-accordion <?php echo in_array('awr-acc-rst-nc', $hidden_blocs) ? '' : 'awpr_accordion_default_opener'; ?>">
    
    <div class="awpr-accordion-title-wrapper awpr_accordion_handler" id="awr-acc-rst-nc">
        <div class="awpr-accordion-title">
            <div class="awpr-heading-icon">
                <span class="icon-system-reset"></span>
            </div>
            <?php _e('Nuclear reset', AWR_PLUGIN_TEXTDOMAIN); ?>
            <?php echo $premium_bloc ?>
        </div>
        <div class="awpr-accordion-icon awpr-acc-arrow leading-none">
            <span class="icon-arrow-down text-base"></span>
        </div>
    </div>
    
    <div class="awpr-accordion-content-wrapper awpr_accordion_content_panel">
        <div class="awpr-accordion-content space-y-6">
            <?php echo $premium_frame_div_start; ?>
                <div class="awpr-info-box pl-8">
                    <p class="mb-2 text-xs">The <b>Nuclear Reset</b> will clean and reset <b>ALL DATABASE DATA AS WELL AS FILES</b>, This means <b>EVERYTHING</b> will be reset and removed except the following:</p>
                    <ul class="text-xs pl-6">
                        <?php 
                            $current_user = wp_get_current_user();
                            $current_user_email = '';
                            if ($current_user instanceof WP_User) {
                                $current_user_email = $current_user->user_email;
                            }
                        ?>
                        <li class="flex gap-2">
                            <span class="icon-check-square text-base"></span>
                            <span><?php _e('The current admin user', AWR_PLUGIN_TEXTDOMAIN);?> <b><?php echo $current_user_email; ?></b></span>
                        </li>
                        <li class="flex gap-2">
                            <span class="icon-check-square text-base"></span>
                            <span><?php _e('The <b>Advanced WP Reset PRO</b> plugin files and data', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                        </li>
                        <li class="flex gap-2">
                            <span class="icon-check-square text-base"></span>
                            <span><?php _e('Non WordPress Database Tables', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                        </li>
                    </ul>
                </div>
                <div class="awpr-info-box bg-awpr-danger-light px-8 py-4 awr-warning-div">
                    <h3 class="awpr-info-heading flex gap-4 font-medium text-[15px] uppercase text-awpr-danger items-center pb-2 border-b border-awpr-danger mb-3">
                        <span class="icon-warning"></span>    
                        <?php _e('Warning', AWR_PLUGIN_TEXTDOMAIN); ?>
                    </h3>
                    <p class="mb-3 text-xs leading-relaxed"><?php _e('Once you click on the <b>Reset</b> button, your data (files and database) will be erased, <b>THERE IS NO UNDO</b>. Please ensure that you want to <b>Reset your Database and Files</b> to their default state.', AWR_PLUGIN_TEXTDOMAIN); ?></p>
                </div>
                <div class="awpr-info-box px-8">
                    <p class="mb-3 text-xs leading-relaxed"><?php _e('Type in the word <b>RESET</b> in the input field below before clicking on the Reset button to proceed.', AWR_PLUGIN_TEXTDOMAIN); ?></p>
                    <form action="#" class="flex flex-wrap items-center gap-3 awpr-reset-form">
                        <input type="text" id="AWR_reset_confirmation_nuclear" placeholder="Reset">
                        <button type="button" data-type="nuclear" class="AWR_reset_button awpr-modal-btn awpr-button awpr-button-danger <?php echo $premium_button_class; ?>">
                            <span class="icon-restart text-lg"></span>
                            <span class="awpr-icon-separator">|</span>
                            <?php _e('Reset', AWR_PLUGIN_TEXTDOMAIN); ?>
                        </button>
                    </form>
                </div>
            <?php echo $premium_frame_div_end; ?>
        </div>
    </div>
</div>
<div class="awpr-single-accordion <?php echo in_array('awr-acc-rst-cst', $hidden_blocs) ? '' : 'awpr_accordion_default_opener'; ?>">
    
    <div class="awpr-accordion-title-wrapper awpr_accordion_handler" id="awr-acc-rst-cst">
        <div class="awpr-accordion-title">
            <div class="awpr-heading-icon">
                <span class="icon-system-reset"></span>
            </div>
            <?php _e('Custom reset', AWR_PLUGIN_TEXTDOMAIN); ?>
                        
            <?php echo $premium_bloc ?>
        </div>
        <div class="awpr-accordion-icon awpr-acc-arrow leading-none">
            <span class="icon-arrow-down text-base"></span>
        </div>
    </div>
    
    <div class="awpr-accordion-content-wrapper awpr_accordion_content_panel">
        <div class="awpr-accordion-content space-y-6">
            <?php echo $premium_frame_div_start; ?>
                <div class="">
                    <div class="awpr-info-box pl-8">
                        <p class="mb-2 text-xs">The <b>Custom Reset</b> feature provides you with full control over your Reset process. With Custom Reset, you can:</p>
                        <ul class="text-xs pl-6">
                            <li class="flex gap-2">
                                <span class="icon-check-square text-base"></span>
                                <span><?php _e('Choose which themes to activate, deactivate, or delete after the Reset', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                            </li>
                            <li class="flex gap-2">
                                <span class="icon-check-square text-base"></span>
                                <span><?php _e('Choose which plugins to activate, deactivate, or delete after the Reset', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                            </li>
                            <li class="flex gap-2">
                                <span class="icon-check-square text-base"></span>
                                <span><?php _e('Decide which users to keep after the Reset', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                            </li>
                            <li class="flex gap-2">
                                <span class="icon-check-square text-base"></span>
                                <span><?php _e('Customize your blog infos after the reset', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                            </li>
                            <li class="flex gap-2">
                                <span class="icon-check-square text-base"></span>
                                <span><?php _e('Alternatively, maintain your themes, plugins, users, and blog infos exactly as they were prior to the reset', AWR_PLUGIN_TEXTDOMAIN); ?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="awpr-info-box pl-8">
                        <p class="mb-2 text-xs">Furthermore, you have the option to <b>save your custom reset configuration</b> under a chosen name and execute it at a later time.</p>
                    </div>

                    <div class="awpr-single-check-item awr-custom-reset-keep flex items-baseline gap-[15px] px-4 md:px-8 py-4">
                        <div class="relative z-[1] inline-block h-3.5 w-3.5 shrink-0 top-0.5">
                            <input type="checkbox" checked="checked" id="awpr-keep-themes" class="peer absolute inset-x-0 top-1/2 z-[2] !h-full !w-full -translate-y-1/2 transform cursor-pointer appearance-none opacity-0 awr-reset-keep-radio" data-custom-config="awr-custumize-themes" />
                            <div class="absolute inset-x-0 top-1/2 z-[1] h-full w-full shrink-0 -translate-y-1/2 transform rounded-[5px] border-2 border-gray-400 bg-white transition peer-checked:border-awpr-success peer-checked:bg-green-500" ></div>

                        </div>

                        <div class="awpr-single-check-content grow">
                            
                            <label for="awpr-keep-themes" class="font-medium"><?php _e('Keep themes as they currently are after Reset', AWR_PLUGIN_TEXTDOMAIN); ?></label>
                            <p class="mb-5 text-xs italic mt-2"><?php _e('When unchecked, this option allows you to customize what you want to do with each Theme', AWR_PLUGIN_TEXTDOMAIN); ?></p>

                            <p class="mb-5 text-xs awpr-content-can-be-disabled awr-custumize-themes"><?php _e('Choose which options (activate/deactivate, delete) you want to do after the reset:', AWR_PLUGIN_TEXTDOMAIN); ?></p>
                            <div class="awpr-item-table-wrapper awr-reset-activation-table awpr-content-can-be-disabled awr-custumize-themes">
                                <div class="awpr-item-table-header flex  justify-between md:px-6 pb-2 border-b border-awpr-light-gray">
                                    <div class="awpr-item-table-header-item text-xs font-medium text-awpr-gray"><?php _e('Theme', AWR_PLUGIN_TEXTDOMAIN); ?></div>
                                    <div class="flex gap-8">
                                        <div class="awpr-item-table-header-item text-xs font-medium text-awpr-gray"><?php _e('Activate', AWR_PLUGIN_TEXTDOMAIN); ?></div>
                                        <div class="awpr-item-table-header-item text-xs font-medium text-awpr-gray"><?php _e('Deactivate', AWR_PLUGIN_TEXTDOMAIN); ?></div>
                                        <div class="awpr-item-table-header-item text-xs font-medium text-awpr-gray"><?php _e('Delete', AWR_PLUGIN_TEXTDOMAIN); ?></div>
                                    </div>
                                </div>
                                <?php 
                                $themes = wp_get_themes();
                                if ( is_array( $themes ) && !empty($themes) ) {
                                    //$current_theme = wp_get_theme();
                                    $current_theme_stylesheet = get_stylesheet(); //$current_theme->get('stylesheet');
                                    foreach ($themes as $theme_stylesheet => $theme) { 
                                        //var_dump($theme);
                                        $theme_name         = $theme->get('Name');
                                        $theme_version      = $theme->get('Version');
                                        
                                        $active = $theme_stylesheet == $current_theme_stylesheet;
                                        $class = $active ? "awr-reset-element-active" : "awr-reset-element-inactive";
                                        ?>
                                    
                                        <div class="awpr-item-table flex flex-col <?php echo $class; ?>">
                                            <div class="awpr-single-table-item flex  justify-between md:px-6 py-2 border-b border-awpr-light-gray">
                                                <div class="awpr-single-table-item-name text-xs text-awpr-dark-gray"><?php echo $theme_name; ?></div>
                                                <div class="flex gap-20 items-center">
                                                    <div class="relative z-[1] inline-block h-3.5 w-6 shrink-0">
                                                        <input type="radio" name="awr_reset_themes_<?php echo $theme_stylesheet; ?>" class="awr_reset_themes awr_reset_activation_radio" data-action="activate" id="theme_<?php echo $theme_stylesheet; ?>_activate" data-theme-stylesheet="<?php echo $theme_stylesheet;?>" data-theme-name="<?php echo $theme_name;?>" <?php echo $active ? 'checked' : ''; ?> />
                                                    </div>
                                                
                                                    <div class="relative z-[1] inline-block h-3.5 w-6 shrink-0">
                                        
                                                        <input type="radio" name="awr_reset_themes_<?php echo $theme_stylesheet; ?>" class="awr_reset_themes awr_reset_activation_radio" data-action="deactivate" id="theme_<?php echo $theme_stylesheet; ?>_deactivate" data-theme-stylesheet="<?php echo $theme_stylesheet;?>" data-theme-name="<?php echo $theme_name;?>" <?php echo $theme_stylesheet != $current_theme_stylesheet ? 'checked' : ''; ?> />
                                    
                                                    </div>
                                                    <div class="relative z-[1] inline-block h-3.5 w-3.5 shrink-0">
                                                        
                                                        <input type="radio" name="awr_reset_themes_<?php echo $theme_stylesheet; ?>" class="awr_reset_themes awr_reset_activation_radio" data-action="uninstall" id="theme_<?php echo $theme_stylesheet; ?>_uninstall" data-theme-stylesheet="<?php echo $theme_stylesheet;?>" data-theme-name="<?php echo $theme_name;?>" />
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } 
                                } else { ?>
                                
                                    <div class="p-4 text-left">
                                        <p class="text-awpr-brand/50 italic"><?php _e('No installed theme found', AWR_PLUGIN_TEXTDOMAIN); ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="awpr-single-check-item awr-custom-reset-keep flex items-baseline gap-[15px] px-4 md:px-8 py-4">
                        <div class="relative z-[1] inline-block h-3.5 w-3.5 shrink-0 top-0.5">
                            <input type="checkbox" checked="checked" id="awpr-keep-plugins" class="peer absolute inset-x-0 top-1/2 z-[2] !h-full !w-full -translate-y-1/2 transform cursor-pointer appearance-none opacity-0 awr-reset-keep-radio" data-custom-config="awr-custumize-plugins" />
                            <div class="absolute inset-x-0 top-1/2 z-[1] h-full w-full shrink-0 -translate-y-1/2 transform rounded-[5px] border-2 border-gray-400 bg-white transition peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                        </div>
                        <div class="awpr-single-check-content grow">
                            <label for="awpr-keep-plugins"><?php _e('Keep Plugins as they currently are after Reset', AWR_PLUGIN_TEXTDOMAIN); ?></label>
                            <p class="mb-5 text-xs italic mt-2"><?php _e('When unchecked, this option allows you to customize what you want to do with each Plugin', AWR_PLUGIN_TEXTDOMAIN); ?></p>
                            <p class="mb-5 text-xs awr-custumize-plugins awpr-content-can-be-disabled"><?php _e('Choose which options (activate/deactivate or delete) you want to do after the rest:', AWR_PLUGIN_TEXTDOMAIN); ?></p>
                            <div class="awpr-item-table-wrapper awr-reset-activation-table awr-custumize-plugins awpr-content-can-be-disabled">
                                <div class="awpr-item-table-header flex  justify-between md:px-6 pb-2 border-b border-awpr-light-gray">
                                    <div class="awpr-item-table-header-item text-xs font-medium text-awpr-gray"><?php _e('Plugin', AWR_PLUGIN_TEXTDOMAIN); ?></div>
                                    <div class="flex gap-8">
                                        <div class="awpr-item-table-header-item text-xs font-medium text-awpr-gray"><?php _e('Activate', AWR_PLUGIN_TEXTDOMAIN); ?></div>
                                        <div class="awpr-item-table-header-item text-xs font-medium text-awpr-gray"><?php _e('Deactivate', AWR_PLUGIN_TEXTDOMAIN); ?></div>
                                        <div class="awpr-item-table-header-item text-xs font-medium text-awpr-gray"><?php _e('Delete', AWR_PLUGIN_TEXTDOMAIN); ?></div>
                                    </div>
                                </div>
                                <?php 
                                
                                $plugins = get_plugins();
                                // Loop through each plugin
                                foreach ($plugins as $plugin_file => $plugin_data) { 
                                    //$plugin_text_domain = $plugin_data['TextDomain'];
                                    $plugin_id = esc_attr($plugin_file);
                                    $plugin_name = $plugin_data['Name'];
                                    $active = is_plugin_active($plugin_file);
                                    $class = $active ? "awr-reset-element-active" : "awr-reset-element-inactive";
                                    
                                ?>
                                <div class="awpr-item-table flex flex-col <?php echo $class; ?>">
                                    <div class="awpr-single-table-item flex  justify-between md:px-6 py-2 border-b border-awpr-light-gray bg-awpr-success-light">
                                        <div class="awpr-single-table-item-name text-xs font-medium text-awpr-dark-gray"><?php echo $plugin_name; ?></div>
                                        <div class="flex gap-20 items-center">
                                            <div class="relative z-[1] inline-block h-3.5 w-6 shrink-0">
                                                <input type="radio" name="awr_reset_plugins_<?php echo $plugin_id; ?>" class="awr_reset_plugins awr_reset_activation_radio" data-action="activate" id="plugin_<?php echo $plugin_id; ?>_activate" data-plugin-file-name="<?php echo $plugin_file;?>" data-plugin-name="<?php echo $plugin_name; ?>" <?php echo is_plugin_active($plugin_file) ? 'checked' : ''; ?> />        
                                            </div>
                                            <div class="relative z-[1] inline-block h-3.5 w-6 shrink-0">
                                                <input type="radio" name="awr_reset_plugins_<?php echo $plugin_id; ?>" class="awr_reset_plugins awr_reset_activation_radio" data-action="deactivate" id="plugin_<?php echo $plugin_id; ?>_deactivate" data-plugin-file-name="<?php echo $plugin_file;?>" data-plugin-name="<?php echo $plugin_name; ?>" <?php echo is_plugin_active($plugin_file) ? '' : 'checked'; ?> />
                                            </div>
                                            <div class="relative z-[1] inline-block h-3.5 w-3.5 shrink-0">
                                                <input type="radio" name="awr_reset_plugins_<?php echo $plugin_id; ?>" class="awr_reset_plugins awr_reset_activation_radio" data-action="uninstall" id="plugin_<?php echo $plugin_id; ?>_uninstall" data-plugin-file-name="<?php echo $plugin_file;?>" data-plugin-name="<?php echo $plugin_name; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="awpr-single-check-item awr-custom-reset-keep flex items-baseline gap-[15px] px-4 md:px-8 py-4">
                        <div class="relative z-[1] inline-block h-3.5 w-3.5 shrink-0 top-0.5">
                            <input type="checkbox" checked="checked" id="awpr-keep-users" class="peer absolute inset-x-0 top-1/2 z-[2] !h-full !w-full -translate-y-1/2 transform cursor-pointer appearance-none opacity-0 awr-reset-keep-radio" data-custom-config="awr-custumize-users" />
                            <div class="absolute inset-x-0 top-1/2 z-[1] h-full w-full shrink-0 -translate-y-1/2 transform rounded-[5px] border-2 border-gray-400 bg-white transition peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                        </div>
                        <div class="awpr-single-check-content grow">
                            <label for="awpr-keep-users"><?php _e('Keep current user after Reset', AWR_PLUGIN_TEXTDOMAIN); ?></label>
                            <p class="mb-5 text-xs italic mt-2">When unchecked, this option allows you to customize what you want to do with each User</p>
                            
                            <div class="awpr-item-table-wrapper awr-reset-activation-table awpr-content-can-be-disabled awr-custumize-users">
                                
                                <?php
                                    $users = null;
                                    $count_users = count_users();
                                    $warning_message = null;
                                    //var_dump($count_users);
                                    if ( $count_users['total_users'] > 20 ) {
                                        $warning_message = __('we found more that 20 users, we only listed the administrators', AWR_PLUGIN_TEXTDOMAIN);
                                        $users = get_users(array('role' => array ('administrator')));
                                    } else {
                                        $users = get_users();
                                    }
                                ?>

                                <p class="mb-5 text-xs">Choose which users you want to keep after reset<?php if ($warning_message) echo ' <span class="text-awpr-brand/80 font-medium">(' . $warning_message . ')</span>'; ?>:</p>
                            
                                <table class="awpr-table awpr-table-bordered-bottom pl-4">
                                    <thead>
                                        <tr>
                                            <th><?php _e('Users', AWR_PLUGIN_TEXTDOMAIN); ?></th>
                                            <th><?php _e('Roles', AWR_PLUGIN_TEXTDOMAIN); ?></th>
                                            <th class="text-right"><?php _e('Only retain', AWR_PLUGIN_TEXTDOMAIN); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Loop through each theme
                                        foreach ($users as $user) {
                                            $user_login = $user->user_login;
                                            $user_email = $user->user_email;
                                            
                                            $user_roles = $user->roles;
                                        ?>
                                        <tr>
                                            <td><?php echo $user_email; ?></td>
                                            <td><?php echo implode(', ', $user_roles); ?></td>
                                            <td class="text-right">
                                                <div class="relative z-[1] inline-block h-3.5 w-3.5 shrink-0">
                                                    
                                                    <input type="checkbox" class="awr_reset_users awr_reset_activation_checkbox peer absolute inset-x-0 top-1/2 z-[2] !h-full !w-full -translate-y-1/2 transform cursor-pointer appearance-none opacity-0" name="awr_reset_users_<?php echo $user_login; ?>" data-action="keep" id="user_<?php echo $user_login; ?>_keep" data-user-login="<?php echo $user_login;?>" checked/>
                                                    <div class="absolute inset-x-0 top-1/2 z-[1] h-full w-full shrink-0 -translate-y-1/2 transform rounded-[5px] border-2 border-gray-400 bg-white transition peer-checked:border-awpr-success peer-checked:bg-awpr-success"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="awpr-single-check-item awr-custom-reset-keep flex items-baseline gap-[15px] px-4 md:px-8 py-4">
                        <div class="relative z-[1] inline-block h-3.5 w-3.5 shrink-0 top-0.5">
                            <input type="checkbox" checked="checked" id="awpr-keep-blog-info" class="peer absolute inset-x-0 top-1/2 z-[2] !h-full !w-full -translate-y-1/2 transform cursor-pointer appearance-none opacity-0 awr-reset-keep-radio" data-custom-config="awr-custumize-blog-infos" />
                            <div class="absolute inset-x-0 top-1/2 z-[1] h-full w-full shrink-0 -translate-y-1/2 transform rounded-[5px] border-2 border-gray-400 bg-white transition peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                        </div>
                        <div class="awpr-single-check-content grow">
                            <label for="awpr-keep-blog-info"><?php _e('Keep current site/blog infos', AWR_PLUGIN_TEXTDOMAIN); ?></label>
                            <p class="mb-5 text-xs italic mt-2">When unchecked, this option allows you to customize what you want to do with each Site/Blog infos</p>
                            <div class="mt-5 awpr-content-can-be-disabled awr-custumize-blog-infos">
                                
                                <?php 
                                    $blog_name          = get_bloginfo('name'); 
                                    $blog_description   = get_bloginfo('description'); 
                                    $blog_url           = get_bloginfo('url'); 
                                    $blog_admin_email   = get_bloginfo('admin_email'); 
                                    $blog_is_public     = get_option('blog_public'); 
                                ?>
                                <div class="awpr-check-input-item">
                                    <label for="awpr-blog-name"><?php _e('Blog name:', AWR_PLUGIN_TEXTDOMAIN); ?></label>
                                    <input type="text" name="awpr-blog-name" id="blog_info_name" placeholder="Blog name" value="<?php echo $blog_name; ?>">
                                </div>
                                <div class="awpr-check-input-item">
                                    <label for="awpr-blog-description"><?php _e('Blog Description: ', AWR_PLUGIN_TEXTDOMAIN); ?></label>
                                    <textarea name="awpr-blog-description" id="blog_info_description" cols="30" rows="10" placeholder="Blog description"><?php echo $blog_description; ?></textarea>
                                </div>
                                <div class="awpr-check-input-item">
                                    <label for="awpr-blog-url"><?php _e('Blog URL:', AWR_PLUGIN_TEXTDOMAIN); ?></label>
                                    <input type="url" name="awpr-blog-url" id="blog_info_url" placeholder="Blog URL" value="<?php echo $blog_url; ?>">
                                </div>
                                <div class="awpr-check-input-item">
                                    <label for="awpr-admin-email"><?php _e('Admin email:', AWR_PLUGIN_TEXTDOMAIN); ?></label>
                                    <input type="email" name="awpr-admin-email" id="blog_info_admin_email" value="<?php echo $blog_admin_email ?>" placeholder="Admin email address">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="awpr-single-check-item awr-custom-reset-keep flex items-baseline gap-[15px] px-4 md:px-8 py-4">
                        <div class="relative z-[1] inline-block h-3.5 w-3.5 shrink-0 top-0.5">
                            <input type="checkbox" id="awpr-keep-plugin-configuration" name="keep_awr_plugin_config" class="peer absolute inset-x-0 top-1/2 z-[2] !h-full !w-full -translate-y-1/2 transform cursor-pointer appearance-none opacity-0" value="yes" checked />
                            <div class="absolute inset-x-0 top-1/2 z-[1] h-full w-full shrink-0 -translate-y-1/2 transform rounded-[5px] border-2 border-gray-400 bg-white transition peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                        </div>
                        <div class="awpr-single-check-content grow">
                            <label for="awpr-keep-plugin-configuration">Keep the configuration and data (custom resets, snapshots, collections, automations, etc.) of this plugin (<b><?php echo AWR_PLUGIN_NAME; ?></b>).</label>
                        </div>
                    </div>
                </div>

                <div class="awpr-info-box px-8 py-4">
                    <div class="">
                        <p class="mb-3 break-words text-xs"><?php _e('To save the above Custom Reset configuration for later use, click the <b>Save</b> button below.', AWR_PLUGIN_TEXTDOMAIN); ?></p>
                        <button id="AWR_reset_config_save" data-type="custom" class="awpr-button awpr-button-success <?php echo $premium_button_class; ?>">
                            <span class="icon-save"></span>
                            <span class="awpr-icon-separator">|</span>
                            <?php _e('Save', AWR_PLUGIN_TEXTDOMAIN); ?>
                        </button>
                    </div>

                </div>

                <div class="awpr-info-box bg-awpr-danger-light px-8 py-4 awr-warning-div">
                    <h3 class="awpr-info-heading flex gap-4 font-medium text-[15px] uppercase text-awpr-danger items-center pb-2 border-b border-awpr-danger mb-3">
                        <span class="icon-warning"></span>    
                        <?php _e('Warning', AWR_PLUGIN_TEXTDOMAIN); ?>
                    </h3>
                    <p class="mb-3 text-xs leading-relaxed"><?php _e('Please be carefull, <b>THERE IS NO UNDO</b>. Make sure you double check the options below before running the <b>RESET</b>.', AWR_PLUGIN_TEXTDOMAIN); ?></p>
                </div>

                <div class="awpr-info-box px-8 py-4">
                    <p class="mb-3 text-xs leading-relaxed"><?php _e('Type in the word <b>RESET</b> in the input field below before clicking on the Reset button to proceed.', AWR_PLUGIN_TEXTDOMAIN); ?></p>
                    <form action="#" class="flex flex-wrap items-center gap-3 awpr-reset-form">
                        <input type="text" id="AWR_reset_confirmation_custom" placeholder="Reset">
                        <button type="button" data-type="custom" class="AWR_reset_button awpr-modal-btn awpr-button awpr-button-danger <?php echo $premium_button_class; ?>">
                            <span class="icon-restart text-lg"></span>
                            <span class="awpr-icon-separator">|</span>
                            <?php _e('Reset', AWR_PLUGIN_TEXTDOMAIN); ?>
                        </button>
                    </form>
                </div>
            <?php echo $premium_frame_div_end; ?>
        </div>
    </div>
</div>
<div class="awpr-single-accordion <?php echo in_array('awr-acc-rst-cst-lst', $hidden_blocs) ? '' : 'awpr_accordion_default_opener'; ?>">
    
    <div class="awpr-accordion-title-wrapper awpr_accordion_handler" id="awr-acc-rst-cst-lst">
        <div class="awpr-accordion-title">
            <div class="awpr-heading-icon">
                <span class="icon-user-reset"></span>
            </div>
            Saved Custom RESETs                        
            <?php echo $premium_bloc ?>
        </div>
        <div class="awpr-accordion-icon awpr-acc-arrow leading-none">
            <span class="icon-arrow-down text-base"></span>
        </div>
    </div>
    <div class="awpr-accordion-content-wrapper awpr_accordion_content_panel">
        <div class="awpr-accordion-content">
            <?php echo $premium_frame_div_start; ?>
                <div class="text-right">
                    <button class="awpr-button awpr-button-outline-danger awr-bulk-delete <?php echo $premium_button_class; ?>" data-type="reset_configuration" id='awr-bulk-delete-reset_configuration'>
                        <span class="icon-delete"></span>
                        <span class="awpr-icon-separator">|</span>
                        Delete
                    </button>
                </div>
                <div class="mt-6">
                    
                    <div id='awr-header-reset_configuration' class="awpr-data-header px-4 mb-2 table table-fixed w-full">
                        <div class="text-awpr-gray font-medium table-cell align-middle w-2/3">Reset names</div>
                        <div class="text-awpr-gray font-medium table-cell align-middle">Created</div>
                        <div class="text-awpr-gray font-medium table-cell align-middle w-10">&nbsp;</div>
                    </div>
                    <?php if ( AWR_IS_PRO_VERSION ) { ?> 
                    <!-- Loading icon -->
                    <div class="text-center p-4" id='awr-custom-reset_configuration_loading'> 
                        <span class="icon-sync text-awpr-brand text-2xl animate-spin-reverse"></span>
                    </div>
                    <?php } ?>
                    
                    <!-- No reset_configuration icon -->
                    <div class="p-4 text-left" id='awr-no-custom-reset_configuration' style="display:none;">
                        <p class="text-awpr-brand/50 italic">No Custom RESETs found</p>
                    </div>
                    <!-- Row Template -->
                    <div id="awr-user-custom-reset-config-template" style="display: <?php echo AWR_IS_PRO_VERSION ? 'none' : 'block'; ?>" class="awr-user-custom-reset-config border-b border-t-2 border-[#DCE5EA]">
                        <div class="">
                            <div class="table table-fixed w-full px-4 py-2 text-awpr-gray">
                                <div class="table-cell align-middle w-2/3">
                                    <div class="flex items-center gap-2">
                                        <div class="relative z-[1] inline-block h-3.5 w-3.5 shrink-0">
                                            <input type="checkbox" class="peer absolute inset-x-0 top-1/2 z-[2] !h-full !w-full -translate-y-1/2 transform cursor-pointer appearance-none opacity-0 awr-reset_configuration-bulk" value="">
                                            <div class="absolute inset-x-0 top-1/2 z-[1] h-full w-full shrink-0 -translate-y-1/2 transform rounded-[5px] border-2 border-gray-400 bg-white transition peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                        </div>
                                        <span class="awr-custom-reset-name">Reset with Twentytwenty-three and no plugin</span>
                                    </div>
                                </div>
                                <div class="table-cell align-middle awr-custom-reset-created">2d 13h ago</div>
                                    
                                <div class="table-cell align-middle text-right w-10">
                                    <div class="awpr-cc-action">
                                        <div class="awpr-cc-toggle-icon" data-target="awr-sample-reset-configuration"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-rows" id="awr-sample-reset-configuration">
                        <!--div-->
                            <div class="px-6 md:px-10 mb-5">
                                <p class="mb-5 break-words awr-custom-reset-detail" >
                                    - Reset type: <b>Custom</b><br />
                                    - ID #64bc0706366b8<br />
                                    - Blog infos<br />
                                        ------ Name: ..... <br />
                                        ------ Description: ...... <br />
                                        ------ URL: ..... <br />
                                        ------ Admin email: ....@gmail.com<br /> 
                                    
                                    - Keep themes<br />
                                    - Plugins:<br />
                                        ---- activate <b> advanced-wp-reset-pro</b><br />
                                        ---- delete <b>wp-crontrol</b><br />
                                    - Users:
                                        ---- keep <b>admin</b><br />
                                    
                                    - Keep plugin configuration<br />
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    
                                    <button class="awpr-button awpr-button-primary objects-action awr-reset-config-run <?php echo $premium_button_class; ?>" data-object='reset_configuration' data-action='execute' data-name='' data-id=''>
                                        <span class="icon-terminal"></span>
                                        <span class="awpr-icon-separator">|</span>
                                        Run
                                    </button>
                                    <button class="awpr-button awpr-button-outline-danger objects-action awr-reset-config-delete <?php echo $premium_button_class; ?>" data-object='reset_configuration' data-action='delete' data-name='' data-id=''>
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