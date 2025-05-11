// --- DOM Elements ---
const slideshowContainer = document.getElementById('slideshow-container');
const slideshowIndicators = document.getElementById('slideshow-indicators');
const galleryGrid = document.getElementById('gallery-grid');
const filterButtons = document.querySelectorAll('.gallery-filter-btn');
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');
const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');
const contactForm = document.getElementById('contact-form');

// --- Slideshow ---
let currentSlideIndex = 0;
let slideInterval;

function createSlideshow(images) {
    if (!slideshowContainer || !slideshowIndicators) return;

    slideshowContainer.innerHTML = '';
    slideshowIndicators.innerHTML = '';

    images.forEach((img, index) => {
        // Create slide element
        const slideDiv = document.createElement('div');
        slideDiv.classList.add('slide', 'absolute', 'inset-0', 'opacity-0');
        if (index === 0) {
            slideDiv.classList.add('active');
            slideDiv.style.opacity = '1';
        }
        const image = document.createElement('img');
        image.src = img.src;
        image.alt = img.alt;
        image.classList.add('w-full', 'h-48', 'object-cover');
        image.onerror = () => {
            image.src = 'https://placehold.co/1200x800/cccccc/969696?text=Image+Not+Found';
            image.alt = 'Image Not Found';
        };
        slideDiv.appendChild(image);
        slideshowContainer.appendChild(slideDiv);

        // Create indicator
        const indicator = document.createElement('button');
        indicator.classList.add('w-3', 'h-3', 'rounded-full', 'bg-white', 'bg-opacity-50', 'hover:bg-opacity-100', 'transition', 'shadow-md');
        if (index === 0) {
            indicator.classList.add('bg-opacity-100');
        }
        indicator.dataset.index = index;
        indicator.addEventListener('click', () => showSlide(index));
        slideshowIndicators.appendChild(indicator);
    });
}

function updateIndicators(index) {
    if (!slideshowIndicators) return;
    const indicators = slideshowIndicators.querySelectorAll('button');
    indicators.forEach((indicator, i) => {
        if (i === index) {
            indicator.classList.add('bg-opacity-100');
            indicator.classList.remove('bg-opacity-50');
        } else {
            indicator.classList.remove('bg-opacity-100');
            indicator.classList.add('bg-opacity-50');
        }
    });
}

function showSlide(index) {
    if (!slideshowContainer) return;
    const slides = slideshowContainer.querySelectorAll('.slide');
    if (slides.length === 0) return;

    if (index >= slides.length) index = 0;
    if (index < 0) index = slides.length - 1;

    slides.forEach((slide, i) => {
        if (i === index) {
            slide.style.opacity = '1';
            slide.classList.add('active');
        } else {
            slide.style.opacity = '0';
            slide.classList.remove('active');
        }
    });
    currentSlideIndex = index;
    updateIndicators(index);

    clearInterval(slideInterval);
    startSlideshowInterval();
}

function nextSlide() {
    showSlide(currentSlideIndex + 1);
}

function startSlideshowInterval() {
    clearInterval(slideInterval);
    const slides = slideshowContainer ? slideshowContainer.querySelectorAll('.slide') : [];
    if (slides.length > 0) {
        slideInterval = setInterval(nextSlide, 5000);
    }
}

// --- Gallery ---
const galleryItems = [
    { src: 'https://placehold.co/400x300/d2b48c/ffffff?text=Nakshi+Kantha', alt: 'Nakshi Kantha Embroidery', category: 'textiles', title: 'Nakshi Kantha' },
    { src: 'https://placehold.co/400x300/8b4513/ffffff?text=Terracotta+Pottery', alt: 'Terracotta Pottery', category: 'pottery', title: 'Terracotta Pottery' },
    // ... (other gallery items remain unchanged)
];

function populateGallery(filter = 'all') {
    if (!galleryGrid) return;

    galleryGrid.innerHTML = '';
    const filteredItems = filter === 'all' ? galleryItems : galleryItems.filter(item => item.category === filter);

    if (filteredItems.length === 0) {
        galleryGrid.innerHTML = '<p class="text-muted col-span-full text-center">No items found in this category.</p>';
        return;
    }

    filteredItems.forEach(item => {
        const galleryItem = document.createElement('div');
        galleryItem.classList.add('gallery-item', 'bg-white', 'rounded-lg', 'shadow-md', 'overflow-hidden', 'cursor-pointer');
        galleryItem.dataset.category = item.category;

        const img = document.createElement('img');
        img.src = item.src;
        img.alt = item.alt;
        img.classList.add('w-full', 'h-48', 'object-cover');
        img.onerror = () => {
            img.src = 'https://placehold.co/400x300/cccccc/969696?text=Craft+Image';
            img.alt = 'Craft Image Placeholder';
        };

        const titleContainer = document.createElement('div');
        titleContainer.classList.add('p-4', 'text-center');

        const title = document.createElement('h3');
        title.textContent = item.title;
        title.classList.add('text-lg', 'font-semibold', 'text-content');

        titleContainer.appendChild(title);
        galleryItem.appendChild(img);
        galleryItem.appendChild(titleContainer);
        galleryGrid.appendChild(galleryItem);

        galleryItem.addEventListener('click', () => {
            alert(`Displaying details for ${item.title}! (Modal view not implemented)`);
        });
    });
}

function setupGalleryFilters() {
    if (filterButtons.length === 0) return;

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-primary', 'text-white');
                btn.classList.add('bg-gray-200', 'text-content');
            });
            button.classList.add('active', 'bg-primary', 'text-white');
            button.classList.remove('bg-gray-200', 'text-content');

            const filter = button.dataset.filter;
            populateGallery(filter);
        });
    });
}

// --- Mobile Menu ---
function setupMobileMenu() {
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            mobileMenu.classList.toggle('open');
            const icon = mobileMenuButton.querySelector('i');
            if (mobileMenu.classList.contains('open')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('open');
                const icon = mobileMenuButton.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            });
        });

        document.addEventListener('click', (e) => {
            if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target) && mobileMenu.classList.contains('open')) {
                mobileMenu.classList.remove('open');
                const icon = mobileMenuButton.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }
}

// --- Contact Form ---
function setupContactForm() {
    if (contactForm) {
        contactForm.addEventListener('submit', (event) => {
            event.preventDefault();
            alert('Message "sent"! (This is a demo - no data was actually submitted).');
            contactForm.reset();
        });
    }
}

// --- Initialization ---
// console.log("aschi");
document.addEventListener('DOMContentLoaded', () => {
    // console.log("1st");
    fetch('fetch_slideshow_images.php')
        .then(response => response.json())
        .then(data => {
            // console.log("2nd");
            if (data.error || !Array.isArray(data) || data.length === 0) {
                console.error('No slideshow images found or error occurred:', data.error || 'No data');
                const defaultImages = [
                    { src: 'https://placehold.co/1200x800/cccccc/969696?text=Default+Slide+1', alt: 'Default Slide 1' },
                    { src: 'https://placehold.co/1200x800/cccccc/969696?text=Default+Slide+2', alt: 'Default Slide 2' }
                ];
                createSlideshow(defaultImages);
            } else {
                createSlideshow(data);
            }
            startSlideshowInterval();
        })
        .catch(error => {
            console.error('Error fetching slideshow images:', error);
            const defaultImages = [
                { src: 'https://placehold.co/1200x800/cccccc/969696?text=Error+Loading+Slides', alt: 'Error Loading Slides' }
            ];
            createSlideshow(defaultImages);
            startSlideshowInterval();
        });

    populateGallery();
    setupGalleryFilters();
    setupMobileMenu();
    setupContactForm();
});
