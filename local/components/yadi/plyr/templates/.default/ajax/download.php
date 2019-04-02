<?
/*$meta_url = "https://cloud-api.yandex.net/v1/disk/public/resources";

$url = $meta_url."?".http_build_query(['public_key' => $_GET['public_key']]);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization' => 'OAuth '.$_GET['token']]);
$result = curl_exec($curl);

echo json_encode($result);*/


$download_url = "https://cloud-api.yandex.net/v1/disk/public/resources/download";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization' => 'OAuth '.$_GET['token']]);
$result = curl_exec($curl);

echo json_encode($result);