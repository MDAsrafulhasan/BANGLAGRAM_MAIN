<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - BanglaGram</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@400;700&family=Hind+Siliguri:wght@400;700&family=Baloo+Da+2:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-base text-content">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="navbar container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="logo text-2xl font-bold text-primary">
                <a href="index.php"><i class="fa-solid fa-leaf mr-2"></i>BanglaGram</a>
            </div>
            <ul class="nav-links hidden md:flex space-x-6 items-center">
                <li><a href="destinations.php" class="text-content hover:text-primary transition duration-300"><i class="fa-solid fa-map-location-dot"></i> Destinations</a></li>
                <li><a href="art-culture.php" class="text-content hover:text-primary transition duration-300"><i class="fa-solid fa-palette"></i> Art & Culture</a></li>
                <li><a href="games-sports.php" class="text-content hover:text-primary transition duration-300"><i class="fa-solid fa-futbol"></i> Games & Sports</a></li>
                <li><a href="peace-corner.php" class="text-content hover:text-primary transition duration-300"><i class="fa-solid fa-spa"></i> Peace Corner</a></li>
                <li><a href="about-bd.php" class="text-content hover:text-primary transition duration-300"><i class="fa-solid fa-heart"></i> About BD</a></li>
                <li><a href="contact.php" class="text-content hover:text-primary transition duration-300"><i class="fa-solid fa-envelope"></i> Contact</a></li>
            </ul>
            <button id="mobile-menu-button" class="md:hidden focus:outline-none text-content hover:text-primary">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
        </nav>
        <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200">
            <ul class="nav-links-mobile flex flex-col items-center py-4">
                <li class="w-full text-center"><a href="destinations.php" class="block py-2 px-4 text-content hover:bg-subtle hover:text-primary transition duration-300"><i class="fa-solid fa-map-location-dot"></i> Destinations</a></li>
                <li class="w-full text-center"><a href="art-culture.php" class="block py-2 px-4 text-content hover:bg-subtle hover:text-primary transition duration-300"><i class="fa-solid fa-palette"></i> Art & Culture</a></li>
                <li class="w-full text-center"><a href="games-sports.php" class="block py-2 px-4 text-content hover:bg-subtle hover:text-primary transition duration-300"><i class="fa-solid fa-futbol"></i> Games & Sports</a></li>
                <li class="w-full text-center"><a href="peace-corner.php" class="block py-2 px-4 text-content hover:bg-subtle hover:text-primary transition duration-300"><i class="fa-solid fa-spa"></i> Peace Corner</a></li>
                <li class="w-full text-center"><a href="about-bd.php" class="block py-2 px-4 text-content hover:bg-subtle hover:text-primary transition duration-300"><i class="fa-solid fa-heart"></i> About BD</a></li>
                <li class="w-full text-center"><a href="contact.php" class="block py-2 px-4 text-content hover:bg-subtle hover:text-primary transition duration-300"><i class="fa-solid fa-envelope"></i> Contact</a></li>
            </ul>
        </div>
    </header>

    <main class="container py-16 px-6">
        <section id="contact" class="container mx-auto">
            <h2 class="text-3xl font-semibold mb-8 text-center text-primary"><i class="fa-solid fa-envelope mr-2"></i>Contact Us</h2>
            <p class="text-center text-muted mb-8 max-w-2xl mx-auto">Have questions or suggestions? Reach out to the BanglaGram team!</p>
            <form id="contact-form" class="max-w-lg mx-auto space-y-6">
                <div>
                    <label for="name" class="block text-lg font-medium">Name</label>
                    <input type="text" id="name" name="name" class="mt-2 w-full rounded-lg border border-primary p-3 focus:ring-2 focus:ring-primary focus:outline-none" placeholder="Your Name" required>
                </div>
                <div>
                    <label for="email" class="block text-lg font-medium">Email</label>
                    <input type="email" id="email" name="email" class="mt-2 w-full rounded-lg border border-primary p-3 focus:ring-2 focus:ring-primary focus:outline-none" placeholder="Your Email" required>
                </div>
                <div>
                    <label for="message" class="block text-lg font-medium">Message</label>
                    <textarea id="message" name="message" class="mt-2 w-full rounded-lg border border-primary p-3 focus:ring-2 focus:ring-primary focus:outline-none" rows="5" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg shadow hover:bg-secondary transition w-full">Send Message</button>
            </form>
        </section>
    </main>

    <footer class="footer-profiles">
        <h2>Meet the Team</h2>
        <div class="profile-container">
            <div class="profile-card">
                <div class="profile-pic">
                    <img src="./picture/tanveer.jpg" alt="Tanveer">
                    <div class="overlay">
                        <p><strong>Name:</strong> Tanveer Ahmed Ziad</p>
                        <p><strong>ID:</strong> 231902048</p>
                        <p><strong>Email:</strong> <a href="mailto:tanveer@example.com">tanveer@example.com</a></p>
                    </div>
                </div>
            </div>
            <div class="profile-card">
                <div class="profile-pic">
                    <img src="./picture/soumik.jpg" alt="Asraful">
                    <div class="overlay">
                        <p><strong>Name:</strong> Md. Asraful Hasan</p>
                        <p><strong>ID:</strong> 231902011</p>
                        <p><strong>Email:</strong> <a href="mailto:asraful@example.com">asraful@example.com</a></p>
                    </div>
                </div>
            </div>
        </div>
        <section id="footer-contact">
            <h2>Contact</h2>
            <p>Email: <a href="mailto:contact@banglagram.com">contact@banglagram.com</a></p>
        </section>
        <p class="footer-copy">&copy; 2025 BanglaGram. Built with love in Bangladesh</p>
    </footer>

    <script src="js/postcard.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const contactForm = document.getElementById('contact-form');
            if (contactForm) {
                contactForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const formData = new FormData(contactForm);

                    fetch('contact.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message || data.error);
                        if (data.message) contactForm.reset();
                    })
                    .catch(error => alert('Error: ' + error));
                });
            }
        });
    </script>
</body>
</html>