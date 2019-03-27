if(typeof PlyrPlayer === 'undefined') let PlyrPlayer = {};
//if(!('elems' in PlyrPlayer)) PlyrPlayer.elems = {};

$(document).ready(function() {
	let elems = $('.plyr-player-video');
	$.each(elems, function(k, v) {
		let plyr_id = $(v).attr('plyr-id');
		let token = $(v).attr('token');
		let media_link = $(v).attr('media-link');
		if(!(plyr_id in PlyrPlayer)) {
			PlyrPlayer[plyr_id] = {};
			PlyrPlayer[plyr_id].id = plyr_id;
		}
		if(!('elem' in PlyrPlayer[plyr_id])) {
			PlyrPlayer[plyr_id].elem = $(v);
		}
		if(!('params' in PlyrPlayer[plyr_id])) {
			PlyrPlayer[plyr_id].params = {
				token: token,
				link: media_link
			};
		}
		if(!('data' in PlyrPlayer[plyr_id])) {
			$.get('/local/components/YaDi/plyr/templates/.default/ajax/get_meta.php', {})
		}
	});
});

// params
// data
// source
// player