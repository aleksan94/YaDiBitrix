<?
$download_url = "https://cloud-api.yandex.net/v1/disk/public/resources/download";

$url = $download_url."?".http_build_query(['public_key' => $_GET['public_key']]);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization' => 'OAuth '.$_GET['token']]);
curl_setopt($curl, CURLOPT_RANGE, "0-".(String)(256*1024));
$result = curl_exec($curl);

echo $result;