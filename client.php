<?php
$host = "127.0.0.1";
$port = 8080;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if (@socket_connect($socket, $host, $port)) {
	socket_write($socket, "khkhhkk\n");

	$response = socket_read($socket, 1024);
	echo "Server: $response\n";

	socket_close($socket);
} else {
	echo "errorr\n";
}
?>
