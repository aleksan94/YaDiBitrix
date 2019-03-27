<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->addExternalCss("/local/css/plyr.css");
$this->addExternalJS("/local/js/jquery-3.3.1.min.js");
$this->addExternalJS("/local/js/plyr.min.js");

?>

<video id="player" playsinline controls>
    <!-- <source src="<?=$this->GetFolder().'/assets/Адовые жанры- КЛИКЕРЫ.mp4'?>" type="video/mp4" /> -->
</video>

<script>
    const player = new Plyr('#player');
    /*player.source = {
    	type: 'video',
    	title: 'Example title',
    	sources: [
	        {
	            //src: '/local/components/YaDi/plyr/templates/.default/assets/videoplayback.webm',
	            //src: '/local/components/YaDi/plyr/templates/.default/assets/videoplayback (1).webm',
	            src: '/local/components/YaDi/plyr/templates/.default/assets/el34QCtTTp',
	            type: 'video/mp4',
	            size: 720,
	        },
	    ],
	    poster: '/local/components/YaDi/plyr/templates/.default/assets/poster.jpg',
    };*/

    $(document).ready(function() {
    	//Download();
    	//interval = setInterval(Download, 1000);
	});

	let interval;
	let speed = 256*1024;
	let bytes = 0;
	let fileSize = 0;
	let fileName = '';
	function Download() {
		$.ajax({
	    	url: '/local/components/YaDi/plyr/templates/.default/ajax/download.php',
	    	type: 'GET',
	    	dataType: 'json',
	    	data: {
	    		speed: speed,
	    		bytes: bytes,
	    		fileSize: fileSize,
	    		fileName: fileName
	    	},
	    	success: function(res) {
	    		//console.log(res);
	    		//console.log(bytes);

	    		fileName = res.fileName;

	    		if(fileSize <= 0) {
		    		player.source = {
				    	type: 'video',
				    	title: 'Example title',
				    	sources: [
					        {
					            src: '/local/components/YaDi/plyr/templates/.default/assets/'+fileName,
					            type: 'video/webm',
					            size: 720,
					        },
					    ],
					    poster: '/local/components/YaDi/plyr/templates/.default/assets/poster.jpg',
				    };	    
				}	
				else {
					//player.source.sources.src = '/local/components/YaDi/plyr/templates/.default/assets/'+fileName;
					player.source.title = 'asd';
				}

	    		fileSize = res.fileSize;
	    		bytes += res.bytes;

	    		console.log(bytes+" / "+fileSize);

	    		if(bytes >= fileSize) clearInterval(interval);
	    	}
	    });
	}
</script>

<?
/*
1) Загрузка на сервак при загрузке страницы (кэширование файлов (без рандомного имени тогда) ) 	может даже в фоне? (exec), при слабом интернете сервера
2) Загрузка в плеер уже непосредственно пользователю на лету (при кнопке плей) настолько, насколько успел загрузиться файл
3) Если дошли до конца прогруженно файла (а прогрузилось скорее всего уже больше), то обновляем плеер
4) Выгрузка tmp-файлов наверное по СЕССИИ (правда непонятно, как это реализовать, типо опрашивать сервером tmp папку и папку сессий, если соответствующей сессии нет - удаляем tmp)
	* Прочекать, что могут хранить в себе сессии (не думаю что можно запихнуть туда видео)
 */