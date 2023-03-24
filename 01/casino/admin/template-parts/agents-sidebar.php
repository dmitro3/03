<?php
	$cu_user_agent = array();
	$agent_data_with_child = get_curren_user_data_with_child_array(get_current_user_id(), $cu_user_agent, 1);
	$agent_data_with_child = array(get_current_user_id() =>  $agent_data_with_child);
?>
<div class="user_map" data-no-translation>
	<div class="form_checkbox">
		<label class="form-check-label">
			<input type="checkbox" name="user_map_hidden" value="0" class="form-check-input"> include hidden
		</label>
	</div>
	<ul class="user_map_main_ul" data-userid="<?php echo get_current_user_id(); ?>" >
		<?php if (isset($agent_data_with_child) && !empty($agent_data_with_child)) { ?>
			<?php foreach ($agent_data_with_child as $user_id => $value) { ?>
				<?php $user_info  = get_userdata($user_id); ?>
				<?php if (empty($value)) { ?>
					<li>
						<a href="javascript:void(0);" data-user="<?php echo $user_id; ?>" title="<?php echo $user_info->user_login; ?>"><?php echo $user_info->user_login; ?></a>
						<?php user_map_sidebar_html($user_id, $agent_data_with_child); ?>
					</li>
				<?php } else { ?>
					<li class="user_dropdown user_dropdown_active current_user">
						<i class="far fa-angle-down"></i>
						<a href="javascript:void(0);" data-user="<?php echo $user_id; ?>" title="<?php echo $user_info->user_login; ?>"><?php echo $user_info->user_login; ?></a>
						<?php user_map_sidebar_html($user_id, $agent_data_with_child); ?>
					</li>
				<?php } ?>
			<?php } ?>
		<?php } ?>
	</ul>
</div>