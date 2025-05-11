<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art & Culture - BanglaGram</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-base text-content">
    <nav class="navbar">
        <a href="Index.php">BanglaGram</a> |
        <a href="destinations.php">Destinations</a> |
        <a href="art-culture.php">Art & Culture</a> |
        <a href="games-sports.php">Games & Sports</a> |
        <a href="peace-corner.php">Peace Corner</a> |
        <a href="about-bd.php">About BD</a>
        <a href="contact.php">Contact</a>
    </nav>
    <main class="container">
        <section id="art" class="py-16 px-6">
            <div class="container mx-auto">
                <h2 class="text-3xl font-semibold mb-4 text-center text-primary"><i class="fa-solid fa-palette mr-2"></i>Art & Culture Showcase</h2>
                <p class="text-center text-muted mb-8">Discover the rich tapestry of Bangladeshi arts and crafts.</p>
                <div id="gallery-filters" class="flex flex-wrap justify-center gap-2 mb-8">
                    <button class="gallery-filter-btn active px-4 py-2 bg-primary text-white rounded-full text-sm shadow" data-filter="all">All</button>
                    <button class="gallery-filter-btn px-4 py-2 bg-gray-200 text-content hover:bg-primary hover:text-white rounded-full text-sm shadow transition duration-300" data-filter="textiles">Textiles</button>
                    <button class="gallery-filter-btn px-4 py-2 bg-gray-200 text-content hover:bg-primary hover:text-white rounded-full text-sm shadow transition duration-300" data-filter="pottery">Pottery</button>
                    <button class="gallery-filter-btn px-4 py-2 bg-gray-200 text-content hover:bg-primary hover:text-white rounded-full text-sm shadow transition duration-300" data-filter="rickshaw">Rickshaw Art</button>
                    <button class="gallery-filter-btn px-4 py-2 bg-gray-200 text-content hover:bg-primary hover:text-white rounded-full text-sm shadow transition duration-300" data-filter="music">Music & Dance</button>
                </div>
                <div id="gallery-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    
                </div>
            </div>
        </section>
    </main>
    <footer>
        <section id="contact">
            <h2>Contact</h2>
            <p>Email: info@banglagram.com</p>
        </section>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>
