<?php
include 'conn.php'; // make sure this connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $albumId = intval($_POST["editAlbumId"]);
    $albumName = trim($_POST["editAlbumName"]);

    if (!empty($albumName) && $albumId > 0) {
        // Prepare the update query
        $stmt = $conn->prepare("UPDATE albums SET albumName = ? WHERE userID = ?");
        $stmt->bind_param("si", $albumName, $albumId);

        if ($stmt->execute()) {
            // Redirect to dashboard after successful update
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error updating album: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid album ID or name.";
    }
} else {
    // Redirect if accessed directly
    header("Location: dashboard.php");
    exit();
}
?>
