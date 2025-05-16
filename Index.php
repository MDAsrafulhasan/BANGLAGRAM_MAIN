<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BanglaGram</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@400;700&family=Hind+Siliguri:wght@400;700&family=Baloo+Da+2:wght@400;700&display=swap"
        rel="stylesheet">

</head>

<body class="bg-base text-content">
    

    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="navbar container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="logo text-2xl font-bold text-primary">
                <a href="index.php"><i class="fa-solid fa-leaf mr-2"></i>BanglaGram</a>
            </div>
            <ul class="nav-links hidden md:flex space-x-6 items-center">
                <li><a href="destinations.php" class="text-content hover:text-primary transition duration-300"><i
                            class="fa-solid fa-map-location-dot"></i> Destinations</a></li>
                <li><a href="art-culture.php" class="text-content hover:text-primary transition duration-300"><i
                            class="fa-solid fa-palette"></i> Art & Culture</a></li>
                <li><a href="games-sports.php" class="text-content hover:text-primary transition duration-300"><i
                            class="fa-solid fa-futbol"></i> Games & Sports</a></li>
                <li><a href="peace-corner.php" class="text-content hover:text-primary transition duration-300"><i
                            class="fa-solid fa-spa"></i> Peace Corner</a></li>
                <!-- <li><a href="about-bd.php" class="text-content hover:text-primary transition duration-300"><i
                            class="fa-solid fa-heart"></i> About BD</a></li> -->
                <!-- <li><a href="contact.php" class="text-content hover:text-primary transition duration-300"><i
                            class="fa-solid fa-envelope"></i> Contact</a></li>
            </ul> -->
            <button id="mobile-menu-button" class="md:hidden focus:outline-none text-content hover:text-primary">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
        </nav>

        <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200">
            <ul class="nav-links-mobile flex flex-col items-center py-4">
                <li class="w-full text-center"><a href="destinations.php"
                        class="block py-2 px-4 text-content hover:bg-subtle hover:text-primary transition duration-300"><i
                            class="fa-solid fa-map-location-dot"></i> Destinations</a></li>
                <li class="w-full text-center"><a href="art-culture.php"
                        class="block py-2 px-4 text-content hover:bg-subtle hover:text-primary transition duration-300"><i
                            class="fa-solid fa-palette"></i> Art & Culture</a></li>
                <li class="w-full text-center"><a href="games-sports.php"
                        class="block py-2 px-4 text-content hover:bg-subtle hover:text-primary transition duration-300"><i
                            class="fa-solid fa-futbol"></i> Games & Sports</a></li>
                <li class="w-full text-center"><a href="peace-corner.php"
                        class="block py-2 px-4 text-content hover:bg-subtle hover:text-primary transition duration-300"><i
                            class="fa-solid fa-spa"></i> Peace Corner</a></li>
                <!-- <li class="w-full text-center"><a href="about-bd.php" class="block py-2 px-4 text-content hover:bg-subtle hover:text-primary transition duration-300"><i class="fa-solid fa-heart"></i> About BD</a></li> -->
                <!-- <li class="w-full text-center"><a href="contact.php"class="block py-2 px-4 text-content hover:bg-subtle hover:text-primary transition duration-300"><iclass="fa-solid fa-envelope"></iclass=> Contact</a></li> -->
            </ul>
        </div>
    </header>

    <section id="home" class="relative h-[70vh] overflow-hidden">
        <div id="slideshow-container" class="absolute inset-0">
        </div>
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white text-center leading-tight px-4 drop-shadow-md">
                BanglaGram<br><span class="text-2xl md:text-3xl font-light">Your Window to Bangladesh</span>
            </h1>
        </div>
        <div id="slideshow-indicators"
            class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
        </div>
    </section>

<!-- map -->
    <section id="destinations" class="py-16 px-6 bg-subtle">
    <div class="container mx-auto">
        <h2 class="text-3xl font-semibold mb-8 text-center text-primary"><i class="fa-solid fa-map-location-dot mr-2"></i>Popular Destinations</h2>
        <p class="text-center text-muted mb-6">Explore the beauty of Bangladesh! Click on the markers to discover top destinations like Cox's Bazar, Sundarbans, Sylhet, and Saint Martin's Island.</p>
        <div id="interactive-map" class="w-full h-[500px] rounded-lg shadow-md"></div>
    </div>
</section>


    <footer class="footer-profiles">
        <h2>Meet the Team</h2>

        <div class="profile-container">
        </div>

        <script>
            
fetch('fetch.php')
    .then(response => response.json())
    .then(data => {
        // console.log("sdjfgsd");
        let output = '';
        if (data.length > 0) {
            // console.log("1st");
            data.forEach(item => {
                output += `<div class="profile-card">
                                            <div class="profile-pic">
                                                <img src="${item.image}" alt="${item.name}">
                                                <div class="overlay">
                                                    <p><strong>Name:</strong> ${item.name}</p>
                                                    <p><strong>ID:</strong> ${item.s_id}</p>
                                                    <p><strong>Email:</strong> ${item.email}</p>
                                                </div>
                                            </div>
                                        </div>`;
            });
            // console.log(data);
        } else {
            output = 'No profiles found.';
        }
        document.querySelector('.profile-container').innerHTML = output;
    });
        </script>


        <section id="contact">
            <h2>Contact</h2>
            <p>Email: info@banglagram.com</p>
        </section>
        <p class="footer-copy">&copy; 2025 BanglaGram. Built with love in Bangladesh </p>
        
    </footer>


    



    <script src="js/postcard.js"></script>
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</body>

</html>