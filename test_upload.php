<?php
$target_dir = "/Applications/XAMPP/xamppfiles/htdocs/Delivery/public/uploads/";
$test_file = $target_dir . "test.txt";

if (file_put_contents($test_file, "Upload test successful")) {
    echo "Folder is writable!";
} else {
    echo "Cannot write to folder!";
}
