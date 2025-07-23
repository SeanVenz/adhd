<!-- HEADER -->
<?php

/**
 * Template Name: Doctors
 */

get_header(); ?>

<!-- CONSTANTS -->
<?php
$doctors = [];
$i = 1;

$doctor_name = 'doctor_name_' . $i;
$doctor_specialty = 'doctor_specialty_' . $i;
$doctor_address = 'doctor_address_' . $i;
$doctor_phone = 'doctor_phone_' . $i;
$doctor_email = 'doctor_email_' . $i;
$doctor_image = 'doctor_image_' . $i;

$initial_doctor_name = get_field($doctor_name);

while($initial_doctor_name != '') {
    // Only add doctors with valid data (not just "test" or empty)
    $name = get_field($doctor_name);
    $address = get_field($doctor_address);
    
    // Only add doctors with valid data
    if ($name && $address) {
        $doctors[] = [
            'name' => $name,
            'specialty' => get_field($doctor_specialty) ?: 'Medical Professional',
            'address' => $address,
            'phone' => get_field($doctor_phone) ?: '',
            'email' => get_field($doctor_email) ?: '',
            'image' => get_field($doctor_image) ?: ''
        ];
    }
    
    $i++;
    $doctor_name = 'doctor_name_' . $i;
    $doctor_specialty = 'doctor_specialty_' . $i;
    $doctor_address = 'doctor_address_' . $i;
    $doctor_phone = 'doctor_phone_' . $i;
    $doctor_email = 'doctor_email_' . $i;
    $doctor_image = 'doctor_image_' . $i;
    $initial_doctor_name = get_field($doctor_name);
}

?>

<!-- MAIN SECTION -->
<main class="doctors-page">
    <div class="min-width">
        <div class="page-header">
            <h1>Our Doctors</h1>
            <p>Find our medical professionals near you</p>
        </div>
        
        <div class="map-container">
            <div class="map-header">
                <h2>Our Locations</h2>
                <p>Click on the pins to see doctor information</p>
            </div>
            
            <div class="doctors-map" id="doctorsMap">
            </div>
        </div>
        
        <div class="doctors-list">
            <h2>Our Medical Team</h2>
            <div class="doctors-grid">
                <?php foreach($doctors as $index => $doctor): ?>
                    <div class="doctor-card">
                        <?php if(!empty($doctor['image'])): ?>
                            <div class="doctor-image">
                                <img src="<?php echo esc_url($doctor['image']); ?>" alt="<?php echo esc_attr($doctor['name']); ?>">
                            </div>
                        <?php endif; ?>
                        
                        <div class="doctor-info">
                            <h3><?php echo esc_html($doctor['name']); ?></h3>
                            <p class="doctor-specialty"><?php echo esc_html($doctor['specialty']); ?></p>
                            <div class="doctor-contact">
                                <?php if(!empty($doctor['address'])): ?>
                                <p class="doctor-location">
                                    <span class="location-icon">📍</span>
                                    <?php echo esc_html($doctor['address']); ?>
                                </p>
                                <?php endif; ?>
                                <?php if(!empty($doctor['phone'])): ?>
                                <p class="doctor-phone">
                                    <span class="phone-icon">📞</span>
                                    <a href="tel:<?php echo esc_attr($doctor['phone']); ?>"><?php echo esc_html($doctor['phone']); ?></a>
                                </p>
                                <?php endif; ?>
                                <?php if(!empty($doctor['email'])): ?>
                                <p class="doctor-email">
                                    <span class="email-icon">✉️</span>
                                    <a href="mailto:<?php echo esc_attr($doctor['email']); ?>"><?php echo esc_html($doctor['email']); ?></a>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<style>
    .doctors-page {
        padding: 60px 0;
        background: linear-gradient(135deg, #f8f8e7 0%, #e8f5e8 100%);
        min-height: 100vh;
    }

    .min-width {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .page-header h1 {
        font-size: 3rem;
        color: #17462B;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .page-header p {
        font-size: 1.2rem;
        color: #666;
        margin: 0;
    }

    /* Map Container */
    .map-container {
        margin-bottom: 80px;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        width: 100%;
        border: 1px solid rgba(23, 70, 43, 0.1);
    }

    .map-header {
        padding: 30px;
        text-align: center;
        background: #f8f8e7;
        border-bottom: 1px solid rgba(23, 70, 43, 0.1);
    }

    .map-header h2 {
        font-size: 2rem;
        color: #17462B;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .map-header p {
        font-size: 1rem;
        color: #666;
        margin: 0;
    }

    .doctors-map {
        width: 100%;
        height: 500px;
    }

    .doctors-map iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* Doctors List */
    .doctors-list h2 {
        text-align: center;
        font-size: 2.5rem;
        color: #17462B;
        margin-bottom: 40px;
        font-weight: 600;
    }

    .doctors-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 40px;
    }

    .doctor-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(23, 70, 43, 0.1);
    }

    .doctor-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .doctor-image {
        width: 100%;
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .doctor-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .doctor-card:hover .doctor-image img {
        transform: scale(1.05);
    }

    .doctor-info {
        padding: 30px;
        text-align: center;
    }

    .doctor-info h3 {
        font-size: 1.5rem;
        color: #17462B;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .doctor-specialty {
        font-size: 1rem;
        color: #666;
        margin-bottom: 20px;
        font-style: italic;
    }

    .doctor-contact {
        text-align: left;
    }

    .doctor-contact p {
        font-size: 0.9rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }

    .doctor-location {
        color: #17462B;
    }

    .doctor-phone, .doctor-email {
        color: #666;
    }

    .doctor-phone a, .doctor-email a {
        color: #17462B;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .doctor-phone a:hover, .doctor-email a:hover {
        color: #0f3a23;
        text-decoration: underline;
    }

    .location-icon, .phone-icon, .email-icon {
        margin-right: 8px;
        font-size: 1rem;
        min-width: 20px;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .doctors-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }
    }

    @media (max-width: 768px) {
        .doctors-page {
            padding: 40px 0;
        }

        .page-header h1 {
            font-size: 2.5rem;
        }

        .doctors-list h2 {
            font-size: 2rem;
        }

        .doctors-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .doctor-info {
            padding: 20px;
        }

        .doctors-map {
            height: 400px;
        }

        .map-header {
            padding: 20px;
        }

        .map-header h2 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .page-header p {
            font-size: 1rem;
        }

        .doctor-card {
            border-radius: 15px;
        }

        .doctors-map {
            height: 300px;
        }

        .map-container {
            border-radius: 15px;
        }
    }
</style>

<!-- Leaflet CSS and JS for OpenStreetMap -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('doctorsMap').setView([52.0693, 19.4803], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var doctors = <?php echo json_encode($doctors); ?>;
    console.log('Doctors data:', doctors);

    var markers = [];
    var processedDoctors = 0;

    function addMarkerToMap(doctor, lat, lng, isFromGeocoding = false) {
        var marker = L.marker([lat, lng]).addTo(map);
        
        var popupContent = `
            <div style="padding: 10px; min-width: 200px;">
                <h3 style="margin: 0 0 8px 0; color: #17462B; font-size: 1.1rem;">${doctor.name}</h3>
                <p style="margin: 0 0 8px 0; font-style: italic; color: #666;">${doctor.specialty}</p>
                <p style="margin: 0 0 5px 0; color: #17462B;"><strong>📍 ${doctor.address}</strong></p>
                <p style="margin: 0 0 5px 0;"><a href="tel:${doctor.phone}" style="color: #17462B; text-decoration: none;">📞 ${doctor.phone}</a></p>
                <p style="margin: 0;"><a href="mailto:${doctor.email}" style="color: #17462B; text-decoration: none;">✉️ ${doctor.email}</a></p>
            </div>
        `;
        
        marker.bindPopup(popupContent);
        markers.push(marker);
        
    }

    function geocodeAndAddMarker(doctor) {
        var geocodeUrls = [
            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(doctor.address)}&limit=1&countrycodes=pl`,
            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(doctor.address.split(',').slice(-2).join(',').trim())}&limit=1&countrycodes=pl`,
            `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(doctor.address.split(',')[0] + ', ' + doctor.address.split(',').slice(-2).join(',').trim())}&limit=1&countrycodes=pl`
        ];
        
        function tryGeocode(urlIndex = 0) {
            if (urlIndex >= geocodeUrls.length) {
                processedDoctors++;
                checkIfAllProcessed();
                return;
            }
            
            fetch(geocodeUrls[urlIndex])
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        var lat = parseFloat(data[0].lat);
                        var lng = parseFloat(data[0].lon);
                        addMarkerToMap(doctor, lat, lng, true);
                        processedDoctors++;
                        checkIfAllProcessed();
                    } else {
                        setTimeout(() => tryGeocode(urlIndex + 1), 200);
                    }
                })
                .catch(error => {
                    setTimeout(() => tryGeocode(urlIndex + 1), 200);
                });
        }
        
        tryGeocode();
    }

    function checkIfAllProcessed() {
        if (processedDoctors === doctors.length && markers.length > 0) {
            var group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds().pad(0.1));
        }
    }

    doctors.forEach(function(doctor, index) {
        if (doctor.address && doctor.address.trim() !== '') {
            setTimeout(() => {
                geocodeAndAddMarker(doctor);
            }, index * 1000); 
        } else {
            processedDoctors++;
            checkIfAllProcessed();
        }
    });
});
</script>
<!-- FOOTER -->
<?php get_footer(); ?>