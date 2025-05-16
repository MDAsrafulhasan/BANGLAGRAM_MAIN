<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations - BanglaGram</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-base text-content">
    <nav class="navbar">
        <a href="Index.php">BanglaGram</a> |
        <a href="destinations.php" class="active">Destinations</a> |
        <a href="art-culture.php">Art & Culture</a> |
        <a href="games-sports.php">Games & Sports</a> |
        <a href="peace-corner.php">Peace Corner</a> |
        <!-- <a href="about-bd.php">About BD</a> | -->
        <!-- <a href="contact.php">Contact</a> -->
    </nav>
    <main class="container">
        <section id="destinations" class="py-16 px-6">
            <div class="container mx-auto">
                <h2 class="text-3xl font-semibold mb-4 text-center text-primary"><i class="fa-solid fa-map mr-2"></i>Destinations</h2>
                <p class="text-center text-muted mb-8">Discover the beauty of Bangladesh.</p>
                <div class="destination-container">
                    <?php
                    include 'connect.php';
                    if (!$conn) {
                        echo '<p class="text-muted col-span-full text-center">Database connection failed: ' . mysqli_connect_error() . '</p>';
                        exit();
                    }

                    // Handle delete action
                    $delete_message = '';
                    if (isset($_POST['delete_submit']) && isset($_POST['delete_id'])) {
                        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
                        $sql = "DELETE FROM destinations WHERE id='$delete_id'";
                        if (mysqli_query($conn, $sql)) {
                            $delete_message = 'Destination deleted successfully!';
                        } else {
                            $delete_message = 'Failed to delete destination.';
                        }
                    }

                    $res = mysqli_query($conn, "SELECT id, name, detail, image FROM destinations");
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                            <div class="destination-card">
                                <div class="destination-pic">
                                    <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" onerror="this.src='https://placehold.co/300x300/cccccc/969696?text=Image+Not+Found'; this.alt='Image Not Found';">
                                    <div class="overlay">
                                        <p><?php echo htmlspecialchars($row['detail']); ?></p>
                                    </div>
                                </div>
                                <div class="p-4 text-center relative">
                                    <h3 class="text-lg font-semibold"><?php echo htmlspecialchars($row['name']); ?></h3>
                                    <div class="absolute bottom-2 left-2 flex gap-2">
                                        <button data-modal-target="edit-modal-<?php echo $row['id']; ?>" data-modal-toggle="edit-modal-<?php echo $row['id']; ?>" class="edit-btn text-white bg-blue-600 hover:bg-blue-700 rounded-full p-2">
                                            <!-- edit icon -->
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>

                                        <!-- delete part -->
                                        <form action="/banglagam/destinations.php" method="post" onsubmit="return confirm('Are you sure you want to delete this destination?');">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete_submit" class="delete-btn text-white bg-red-600 hover:bg-red-700 rounded-full p-2">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4M9 7v12m6-12v12" />
                                                </svg>
                                            </button>
                                        </form>


                                    </div>
                                </div>
                            </div>
                            <!-- Edit Modal for this item -->
                            <div id="edit-modal-<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-white-700">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Edit Destination</h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal-<?php echo $row['id']; ?>">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-4 md:p-5">
                                            <?php
                                            $edit_success = '';
                                            $edit_error = '';
                                            if (isset($_POST['edit_submit']) && $_POST['edit_id'] == $row['id']) {
                                                $name = mysqli_real_escape_string($conn, $_POST['name']);
                                                $detail = mysqli_real_escape_string($conn, $_POST['detail']);
                                                $image_path = $row['image'];

                                                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                                                    $image_path = $_FILES['image']['name'];
                                                    $tempname = $_FILES['image']['tmp_name'];
                                                    $folder = 'images/' . $image_path;
                                                    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                                                    $file_type = mime_content_type($tempname);
                                                    if (!in_array($file_type, $allowed_types)) {
                                                        $edit_error = 'Invalid file type. Only JPEG, PNG, and GIF are allowed.';
                                                    } else {
                                                        if (!is_dir('images')) {
                                                            mkdir('images', 0755, true);
                                                        }
                                                        if (!move_uploaded_file($tempname, $folder)) {
                                                            $edit_error = 'Failed to upload image.';
                                                        }
                                                    }
                                                }

                                                if (!$edit_error) {
                                                    $sql = "UPDATE destinations SET name='$name', detail='$detail', image='$image_path' WHERE id={$row['id']}";
                                                    if (mysqli_query($conn, $sql)) {
                                                        $edit_success = 'Destination updated successfully!';
                                                    } else {
                                                        $edit_error = 'Failed to update destination.';
                                                    }
                                                }
                                            }
                                            ?>
                                            <?php if ($edit_success): ?>
                                                <p class="text-green-500 mb-4"><?php echo $edit_success; ?></p>
                                            <?php endif; ?>
                                            <?php if ($edit_error): ?>
                                                <p class="text-red-500 mb-4"><?php echo $edit_error; ?></p>
                                            <?php endif; ?>
                                            <form class="space-y-4" action="/banglagam/destinations.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                                <div>
                                                    <label for="name-<?php echo $row['id']; ?>" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Name</label>
                                                    <input type="text" name="name" id="name-<?php echo $row['id']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($row['name']); ?>" required />
                                                </div>
                                                <div>
                                                    <label for="detail-<?php echo $row['id']; ?>" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Details</label>
                                                    <input type="text" name="detail" id="detail-<?php echo $row['id']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($row['detail']); ?>" required />
                                                </div>
                                                <div>

                                                    <label for="image-<?php echo $row['id']; ?>" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Upload New Image (optional)</label>
                                                    
                                                    <input type="file" name="image" id="image-<?php echo $row['id']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" accept="image/*" />
                                                    <p class="text-sm text-gray-500 mt-1">Current image: <?php echo htmlspecialchars($row['image']); ?></p>
                                                </div>
                                                <button type="submit" name="edit_submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="text-muted col-span-full text-center">No destinations found.</p>';
                    }
                    ?>
                    <?php if ($delete_message): ?>
                        <p class="<?php echo strpos($delete_message, 'successfully') !== false ? 'text-green-500' : 'text-red-500'; ?> text-center mt-4"><?php echo $delete_message; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>






    <!-- Add Modal -->
    <button style="padding: 17px; width: 90px; border-radius: 10px; position: fixed; top: 90px; right: 10px; background-color: #8d83b4;" data-modal-target="add-modal" data-modal-toggle="add-modal" class="block text-white bg-blue-700" type="button">
        +Add
    </button>
    <div id="add-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-white-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Add Destination</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-content-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="add-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <?php
                    $add_success = '';
                    $add_error = '';
                    if (isset($_POST['add_submit'])) {
                        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                            $name = mysqli_real_escape_string($conn, $_POST['name']);
                            $detail = mysqli_real_escape_string($conn, $_POST['detail']);
                            $image_path = $_FILES['image']['name'];
                            $tempname = $_FILES['image']['tmp_name'];
                            $folder = 'images/' . $image_path;

                            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                            $file_type = mime_content_type($tempname);
                            if (!in_array($file_type, $allowed_types)) {
                                $add_error = 'Invalid file type. Only JPEG, PNG, and GIF are allowed.';
                            } else {
                                if (!is_dir('images')) {
                                    mkdir('images', 0755, true);
                                }

                                $sql = "INSERT INTO destinations (name, detail, image) VALUES ('$name', '$detail', '$image_path')";
                                $query = mysqli_query($conn, $sql);

                                if ($query && move_uploaded_file($tempname, $folder)) {
                                    $add_success = 'Destination added successfully!';
                                } else {
                                    $add_error = 'Failed to add destination or upload image.';
                                }
                            }
                        } else {
                            $add_error = 'No file uploaded or file upload error.';
                        }
                    }
                    ?>
                    <?php if ($add_success): ?>
                        <p class="text-green-500 mb-4"><?php echo $add_success; ?></p>
                    <?php endif; ?>
                    <?php if ($add_error): ?>
                        <p class="text-red-500 mb-4"><?php echo $add_error; ?></p>
                    <?php endif; ?>
                    <form class="space-y-4" action="/banglagam/destinations.php" method="post" enctype="multipart/form-data">
                        <div>
                            <label for="add-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Name</label>
                            <input type="text" name="name" id="add-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type destination name" required />
                        </div>
                        <div>
                            <label for="add-detail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Details</label>
                            <input type="text" name="detail" id="add-detail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Details" required />
                        </div>
                        <div>
                            <label for="add-image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Upload Image</label>
                            <input type="file" name="image" id="add-image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" accept="image/*" required />
                        </div>
                        <button type="submit" name="add_submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <section id="contact">
            <h2>Contact</h2>
            <p>Email: <a href="mailto:info@banglagram.com" class="text-primary">info@banglagram.com</a></p>
        </section>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>