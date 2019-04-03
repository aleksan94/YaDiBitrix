if(typeof PlyrPlayer === 'undefined') var PlyrPlayer = {};
if(!('settings' in PlyrPlayer)) PlyrPlayer.settings = {};
PlyrPlayer.settings.packageSize = 256*1024;
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
			$.get('/local/components/YaDi/plyr/templates/.default/ajax/meta.php', {token: PlyrPlayer[plyr_id].params.token, public_key: PlyrPlayer[plyr_id].params.link}, function(response) {
				if(!!response.size && response.size > 0) {
					if(!('meta' in PlyrPlayer[plyr_id])) PlyrPlayer[plyr_id].meta = {};
					PlyrPlayer[plyr_id].meta = response;

					PlyrPlayer[plyr_id].player.source = {
						type: 'video',
					    title: 'Example title',
					    sources: [
					        {
					            src: PlyrPlayer[plyr_id].meta.file,
					            type: 'video/mp4',
					            size: 720,
					        },
					    ],
					};
				}
			}, 'json');
		}

		PlyrPlayer[plyr_id].player = new Plyr('[plyr-id="'+plyr_id+'"]');
	});
});

// params
// data
// source
// player