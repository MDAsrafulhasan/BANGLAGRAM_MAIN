document.addEventListener('DOMContentLoaded', function () {
    console.log('BanglaGam loaded!');
    console.log("aschi matro");

});



// --- Interactive Map ---
function initializeMap() {
    const mapContainer = document.getElementById('interactive-map');
    if (!mapContainer) return;

    // Initialize the map, centered on Bangladesh
    const map = L.map('interactive-map').setView([23.6850, 90.3563], 7); // Center coordinates and zoom level

    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 18,
    }).addTo(map);

    // Define destinations with coordinates, descriptions, and images
    const destinations = [
        {
            name: "Cox's Bazar",
            coords: [21.4272, 92.0058],
            description: "The world's longest natural sea beach, famous for its golden sands and stunning sunsets.",
            image: "https://images.unsplash.com/photo-1665651147145-664ebda525e7?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y294JTIwYmF6YXIlMjBzZWElMjBiZWFjaHxlbnwwfHwwfHx8MA%3D%3D"
        },
        {
            name: "Sundarbans",
            coords: [22.2970, 89.5750],
            description: "A UNESCO World Heritage Site, home to the Royal Bengal Tiger and vast mangrove forests.",
            image: "https://cdn.pixabay.com/photo/2018/09/12/19/21/deer-3673017_1280.jpg"
        },
        {
            name: "Sylhet",
            coords: [24.8949, 91.8687],
            description: "Known for its lush tea gardens, rolling hills, and serene natural beauty.",
            image: "https://upload.wikimedia.org/wikipedia/commons/4/4d/Jaflong_Sylhet.jpg"
        },
        {
            name: "Saint Martin's Island",
            coords: [20.6295, 92.3257],
            description: "A tropical coral island with crystal-clear waters and vibrant marine life.",
            image: "https://www.shutterstock.com/image-photo/beauty-saint-martin-island-coxs-600nw-2308207335.jpg"
        }
    ];

    // Add markers for each destination
    destinations.forEach(destination => {
        const marker = L.marker(destination.coords).addTo(map);
        const popupContent = `
            <div class="popup-content" style="max-width: 250px; text-align: center;">
                <img src="${destination.image}" alt="${destination.name}" style="width: 100%; height: auto; border-radius: 8px; margin-bottom: 10px;">
                <h3 style="font-size: 1.2rem; font-weight: 600; color: #2c3e50;">${destination.name}</h3>
                <p style="font-size: 0.9rem; color: #555;">${destination.description}</p>
            </div>
        `;
        marker.bindPopup(popupContent, { maxWidth: 300 });
    });

    // Ensure map resizes correctly
    setTimeout(() => {
        map.invalidateSize();
    }, 100);
}

// Call map initialization on DOM load
document.addEventListener('DOMContentLoaded', () => {
    initializeMap();
});