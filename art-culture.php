<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art & Culture - BanglaGram</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-base text-content">
        <nav class="navbar">
        <a href="Index.php">BanglaGram</a> |
        <a href="destinations.php">Destinations</a> |
        <a href="art-culture.php" class="active">Art & Culture</a> |
        <a href="games-sports.php">Games & Sports</a> |
        <a href="peace-corner.php">Peace Corner</a> |
        <!-- <a href="about-bd.php">About BD</a> | -->
        <!-- <a href="contact.php">Contact</a> -->
    </nav>
    <main class="container">
        <section id="art" class="py-16 px-6">
            <div class="container mx-auto">
                <h2 class="text-3xl font-semibold mb-4 text-center text-primary"><i class="fa-solid fa-palette mr-2"></i>Art & Culture Showcase</h2>
                <p class="text-center text-muted mb-8">Discover the rich tapestry of Bangladeshi arts and crafts.</p>
                <div id="gallery-filters" class="flex flex-wrap justify-center gap-2 mb-8">
                    <button class="gallery-filter-btn px-4 py-2 rounded-full text-sm shadow transition duration-300" data-filter="all">All</button>
                    <button class="gallery-filter-btn px-4 py-2 rounded-full text-sm shadow transition duration-300" data-filter="textiles">Textiles</button>
                    <button class="gallery-filter-btn px-4 py-2 rounded-full text-sm shadow transition duration-300" data-filter="pottery">Pottery</button>
                    <button class="gallery-filter-btn px-4 py-2 rounded-full text-sm shadow transition duration-300" data-filter="rickshaw">Rickshaw Art</button>
                    <button class="gallery-filter-btn px-4 py-2 rounded-full text-sm shadow transition duration-300" data-filter="music">Music</button>
                </div>
                <div class="destination-container">
                    <?php
                    include 'connect.php';
                    if (!$conn) {
                        echo '<p class="text-muted col-span-full text-center">Database connection failed: ' . mysqli_connect_error() . '</p>';
                        exit();
                    }

                    $filter = isset($_GET['type']) ? mysqli_real_escape_string($conn, $_GET['type']) : 'all';
                    $query = $filter === 'all' ? 
                        "SELECT name, detail, image, type FROM art_culture" : 
                        "SELECT name, detail, image, type FROM art_culture WHERE type='$filter'";
                    
                    $res = mysqli_query($conn, $query);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                            <div class="destination-card">
                                <div class="destination-pic">
                                    <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                                    <div class="overlay">
                                        <p><?php echo htmlspecialchars($row['type']); ?></p>
                                        <p><?php echo htmlspecialchars($row['detail']); ?></p>
                                    </div>
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-lg font-semibold"><?php echo htmlspecialchars($row['name']); ?></h3>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="text-muted col-span-full text-center">No items found in this category.</p>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal toggle -->
    <button style="padding: 17px; width: 90px; border-radius: 10px; position: fixed; top: 90px; right: 10px; background-color: #8d83b4;" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white bg-blue-700" type="button">
        +Add
    </button>

    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-white-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Add Art & Culture Item
                    </h3>
                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <?php
                    if (isset($_POST['submit'])) {
                        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                            $name = mysqli_real_escape_string($conn, $_POST['name']);
                            $detail = mysqli_real_escape_string($conn, $_POST['detail']);
                            $type = mysqli_real_escape_string($conn, $_POST['type']);
                            $image_path = $_FILES['image']['name'];
                            $tempname = $_FILES['image']['tmp_name'];
                            $folder = 'images/' . $image_path;

                            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                            $file_type = mime_content_type($tempname);
                            if (!in_array($file_type, $allowed_types)) {
                                echo '<p class="text-red-500">Invalid file type. Only JPEG, PNG, and GIF are allowed.</p>';
                            } else {
                                if (!is_dir('images')) {
                                    mkdir('images', 0755, true);
                                }

                                $sql = "INSERT INTO `art_culture` (`name`, `detail`, `image`, `type`) VALUES ('$name', '$detail', '$image_path', '$type')";
                                $query = mysqli_query($conn, $sql);

                                if ($query && move_uploaded_file($tempname, $folder)) {
                                    // echo '<p class="text-green-500">Item added successfully!</p>';
                                    header("Location: /banglagram2/art-culture.php?type=all");
                                } else {
                                    echo '<p class="text-red-500">Failed to add item or upload image.</p>';
                                }
                            }
                        } else {
                            echo '<p class="text-red-500">No file uploaded or file upload error.</p>';
                        }
                    }
                    ?>
                    <form class="space-y-4" action="/banglagam/art-culture.php" method="post" enctype="multipart/form-data">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type item name" required />
                        </div>
                        <div>
                            <label for="detail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Details</label>
                            <input type="text" name="detail" id="detail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Details" required />
                        </div>
                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Type</label>
                            <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="textiles">Textiles</option>
                                <option value="pottery">Pottery</option>
                                <option value="rickshaw">Rickshaw Art</option>
                                <option value="music">Music</option>
                            </select>
                        </div>
                        <div>
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Upload Image</label>
                            <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" accept="image/*" required />
                        </div>
                        <button type="submit" name="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
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

    
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterButtons = document.querySelectorAll('.gallery-filter-btn');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Update active button styling
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-primary', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-content');
                });
                button.classList.add('active', 'bg-primary', 'text-white');
                button.classList.remove('bg-gray-200', 'text-content');

                const filter = button.dataset.filter;
                window.location.href = `art-culture.php?type=${filter}`;
            });
        });

        // Highlight active filter button based on URL
        const urlParams = new URLSearchParams(window.location.search);
        const activeFilter = urlParams.get('type') || 'all';
        filterButtons.forEach(btn => {
            if (btn.dataset.filter === activeFilter) {
                btn.classList.add('active', 'bg-primary', 'text-white');
                btn.classList.remove('bg-gray-200', 'text-content');
            }
        });
    });
    </script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
