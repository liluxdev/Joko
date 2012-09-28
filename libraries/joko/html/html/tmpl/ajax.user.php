<?php defined('JPATH_PLATFORM') or die; ?>

<ul id="<?php echo $id; ?>" class="JokoHtmlAjaxUsers<?php echo $classSuffix; ?>" <?php echo $attribs; ?>>
	<?php if(count($userIds)): ?>
	<?php foreach($userIds as $userId): ?>
	<?php $user = JFactory::getUser($userId); ?>
	<?php if(isset($user->id) && $user->id): ?>
	<li class="user">
		<?php echo $user->name; ?>
		<span class="userRemove">x</span>
		<input type="hidden" name="<?php echo $name; ?>[]" value="<?php echo $user->id; ?>" />
	</li>
	<?php endif; ?>
	<?php endforeach; ?>
	<?php endif; ?>
	<li class="userAdd">
		<input type="text" id="<?php echo $id; ?>-search-field" />
	</li>
	<li class="clr"></li>
</ul>
<script>
	$joko(document).ready(function(){
		var ajaxUser = new AjaxUsers('<?php echo $id; ?>','<?php echo $name; ?>');
	});
</script>