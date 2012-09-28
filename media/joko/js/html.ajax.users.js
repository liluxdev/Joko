/**
 * @author Olivier NOLBERT
 */

var AjaxUsers = function(containerId, fieldName){
	
	$joko('.userRemove').click(function(event){
		event.preventDefault();
		$joko(this).parent().remove();
	});
	
	var container = $joko('#' + containerId);
	var searchField = $joko('#' + containerId + '-search-field');
	
	container.click(function(){
		searchField.focus();
	});
	
	searchField.autocomplete({
		source : function(request, response) {
		$joko.ajax({
			type: 'post',
			url: '/libraries/joko/external/joomla/users.php',
			data: 'q='+request.term,
			dataType: 'json',
			success: function(data) {
				searchField.removeClass('usersLoading');
				response( $joko.map( data, function( item ) {
					return item;
				}));
			}
		});
		},
		minLength: 3,
		select : function(event, ui) {
			$joko('<li class="user">'+ui.item.label+'<span class="userRemove" onclick="$joko(this).parent().remove();">x</span><input type="hidden" value="'+ui.item.value+'" name="' + fieldName + '[]"></li>').insertBefore('#' + containerId + ' .userAdd');
			this.value = '';
			return false;
		},
		search: function(event, ui){
			searchField.addClass('usersLoading');
		}
	});

};
