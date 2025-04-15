<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Music Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-white shadow-md sticky top-0 z-10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">🎵 Music Library</h1>
            <nav>
                <ul class="flex space-x-6 text-gray-700 font-medium">
                    <li><a href="#" class="hover:text-blue-600 transition">Home</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Albums</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Songs</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Singers</a></li>
                    <li><a href="javascript:void(0)" onclick="confirmLogout()"
                            class="hover:text-blue-600 transition">Logout</a></li>



                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 flex-1">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Albums</h2>
                <button onclick="document.getElementById('addAlbumModal').classList.remove('hidden')"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition">
                    <i class="fas fa-plus mr-2"></i> Add Album
                </button>
            </div>
            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full table-auto border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left font-semibold text-gray-600 border-b">Album Name</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-600 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php
                        include 'conn.php';
                        $sql = "SELECT * FROM albums";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr class="hover:bg-gray-50 transition">';
                                echo '<td class="py-3 px-4 border-b"><a href="album_details.php?album_id=' . $row['userID'] . '" class="text-blue-600 hover:underline">' . htmlspecialchars($row['albumName']) . '</a></td>';
                                echo '<td class="py-3 px-4 border-b space-x-4">';
                                echo '<button onclick="openEditModal(' . $row['userID'] . ', \'' . addslashes($row['albumName']) . '\')" class="text-blue-600 hover:underline">Edit</button>';
                                echo '<a href="javascript:void(0);" class="text-red-600 hover:underline" onclick="openDeleteModal(' . $row['albumID'] . ')">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="2" class="text-center py-4 text-gray-500">No albums found.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>


    <!-- Delete Modal -->
    <div id="deleteAlbumModal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-30">
        <div class="bg-white p-6 rounded-lg w-full max-w-sm shadow-lg relative">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Delete Album</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this album?</p>
            <div class="flex justify-end space-x-2">
                <button onclick="closeDeleteModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Cancel
                </button>
                <button id="confirmDeleteBtn" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded"
                    onclick="deleteAlbum()">
                    Delete
                </button>
            </div>
        </div>
    </div>


    <!-- Logout Modal -->
    <div id="logoutModal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-30">
        <div class="bg-white p-6 rounded-lg w-full max-w-sm shadow-lg relative">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Confirm Logout</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to log out?</p>
            <div class="flex justify-end space-x-2">
                <button onclick="document.getElementById('logoutModal').classList.add('hidden')"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Cancel
                </button>
                <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Logout
                </a>
            </div>
        </div>
    </div>


    <!-- Modal Overlay Component -->
    <div id="addAlbumModal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-20">
        <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg relative">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Add Album</h2>
            <form action="add_album.php" method="post" class="space-y-4">
                <div>
                    <label for="albumName" class="block text-sm font-medium text-gray-700">Album Name</label>
                    <input type="text" name="albumName" id="albumName" placeholder="Enter album name"
                        class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('addAlbumModal').classList.add('hidden')"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancel</button>
                    <input type="submit" value="Add"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded cursor-pointer">
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editAlbumModal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-20">
        <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg relative">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Album</h2>
            <form action="edit_album.php" method="post" class="space-y-4">
                <input type="hidden" name="editAlbumId" id="editAlbumId">
                <div>
                    <label for="editAlbumName" class="block text-sm font-medium text-gray-700">Album Name</label>
                    <input type="text" name="editAlbumName" id="editAlbumName" placeholder="Enter album name"
                        class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('editAlbumModal').classList.add('hidden')"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancel</button>
                    <input type="submit" value="Save"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded cursor-pointer">
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name) {
            document.getElementById('editAlbumId').value = id;
            document.getElementById('editAlbumName').value = name;
            document.getElementById('editAlbumModal').classList.remove('hidden');
        }
    </script>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to logout now?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb', // Tailwind blue-600
                cancelButtonColor: '#6b7280', // Tailwind gray-500
                confirmButtonText: 'Yes, logout',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        }
    </script>


    <script>
        // Open the delete modal and pass the albumID
        function openDeleteModal(albumID) {
            document.getElementById('deleteAlbumModal').classList.remove('hidden');
            document.getElementById('confirmDeleteBtn').setAttribute('data-id', albumID);
        }

        // Close the delete modal
        function closeDeleteModal() {
            document.getElementById('deleteAlbumModal').classList.add('hidden');
        }

        // Perform the delete action
        function deleteAlbum() {
            var albumID = document.getElementById('confirmDeleteBtn').getAttribute('data-id');
            window.location.href = "delete_album.php?albumID=" + albumID;
        }
    </script>


</body>

</html>