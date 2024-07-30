<?php
/*
cPanel Backup Script
This script will auto create backup file, transfer to FTP server
By Michael Phan @ sondaika.com
*/

// Change to your information

$cpanel_user = "arpagcom"; // change to your cpanel user
$cpanel_password = "WjoseB$$"; // change to your cpanel password
$domain = "arpag.com.br"; // your domain
$email_to_report = "dujoseaugusto@gmail.com"; // Your email to receive notification when the script finish backup. Leave it blank if you dont want to receive notification.
$ftp = true; // transfer to FTP server or not
$ftpserver = "ftp.arpag.com.br"; // your ftp server address
$ftpusername = "arpagcom"; // your ftp username
$ftppassword = "WjoseB$$"; // your ftp password
$ftpdirectory = "/public_html/backup/"; // your backup directory
$daytostore = 7; // how many days do you want to store the backup file, the files which older than this number of day will be deleted

//This part is option, the bellow information is work for almost user
$ftpport = "21"; // default port for FTP connection of most hosting providers now
$theme = "x3"; // change to your cpanel theme name, default is most popular theme now named paper_lantern
$secure = false; // use https or not

// =================================================================================
// ========= do not change anything bellow unless you are a master of PHP ==========
// =================================================================================

// Backup

$auth = base64_encode("$cpanel_user" . ":" . "$cpanel_password");

if ($secure) {
$url = "ssl://" . $domain;
$port = 2083;
} else {
$url = $domain;
$port = 2082;
}

$socket = fsockopen($url, $port);
if (!$socket) {
exit("Failed to open socket connection.");
}

if ($ftp) {
$params = "dest=ftp&server=$ftpserver&user=$ftpusername&pass=$ftppassword&port=$ftpport&rdir=$ftpdirectory&submit=Generate Backup";
} else {
$params = "submit=Generate Backup";
}

fputs($socket, "POST /frontend/" . $theme . "/backup/dofullbackup.html?" . $params . " HTTP/1.0\r\n");
fputs($socket, "Host: $domain\r\n");
fputs($socket, "Authorization: Basic $auth\r\n");
fputs($socket, "Connection: Close\r\n");
fputs($socket, "\r\n");

while (!feof($socket)) {
$response = fgets($socket, 4096);
echo $response;
}

fclose($socket);

// delete old file from ftp if FTP set to true

if ($ftp) {
// set up basic connection
$conn_id = ftp_connect($ftpserver);

// login with username and password
$login_result = ftp_login($conn_id, $ftpusername, $ftppassword);

if ($login_result) {

$filelistname = ftp_nlist($conn_id, $ftpdirectory);

foreach ($filelistname as $key => $value) {
$file = $ftpdirectory . $value;
$mdftime = ftp_mdtm($conn_id, $file);
exit;

}

// close the connection
ftp_close($conn_id);
}
else {
echo "FTP connection Failed";
}

}

// send report email

if ($email_to_report !== "") {
$attime = date('d-m-Y H:i:s');
$to = $email_to_report;
$subject = 'Auto backup for ' . $domain . ' at ' . $attime . ' successful.';
$message = 'Auto backup for ' . $domain . ' at ' . $attime . ' successful.';
$headers = 'From: autobackupreport@' . $domain . "\r\n" .
'Reply-To: autobackupreport@' . $domain . "\r\n" .
'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
}

?>