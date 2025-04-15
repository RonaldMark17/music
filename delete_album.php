<?php
include 'conn.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['userID'])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Check if albumID is passed in the URL and is valid
if (isset($_GET['albumID']) && is_numeric($_GET['albumID'])) {
    $albumID = intval($_GET['albumID']);
    $userID = $_SESSION['userID']; // Get userID from session

    // Verify that the album belongs to the current user
    $stmt = $conn->prepare("SELECT * FROM albums WHERE albumID = ? AND userID = ?");
    $stmt->bind_param("ii", $albumID, $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the album exists and belongs to the user, delete it
    if ($result->num_rows > 0) {
        // Proceed with deleting the album
        $deleteStmt = $conn->prepare("DELETE FROM albums WHERE albumID = ?");
        $deleteStmt->bind_param("i", $albumID);

        if ($deleteStmt->execute()) {
            // Redirect to the dashboard after successful deletion
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error deleting album: " . $deleteStmt->error;
        }

        $deleteStmt->close();
    } else {
        // If album not found or user doesn't have permission to delete it
        echo "Album not found or you don't have permission to delete this album.";
    }

    $stmt->close();
} else {
    // If no valid albumID is passed, redirect back to the dashboard
    header("Location: dashboard.php");
    exit();
}
?>
