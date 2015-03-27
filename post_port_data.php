<?php
use Guzzle\Http\Client;

$client = new GuzzleHttp\Client();

$conn = new PDO('mysql:host=localhost;dbname=work', 'root', '');

for ($idx=4; $idx <= 1000; $idx++) { 

$response = $client->get("http://www.sonub.com/?module=post&action=port_data_submit&idx='$idx'");

$data = $response->json();
$data = serialize ( $data );
$sql = "INSERT INTO port_data (id, idx, data)
		VALUES (:id, :idx, :data)";
$st = $conn->prepare($sql);
$st->execute(array(':id' => $idx, ':idx' => $idx, ':data' => $data));

echo "OK!\n";

}
?>