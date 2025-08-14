<?php
/**
 * Template Name: Doctors
 */
get_header(); 

global $wpdb;
$results = $wpdb->get_var("
    SELECT meta_value
    FROM {$wpdb->prefix}postmeta
    WHERE meta_key = 'wp_mapit_pins'
    LIMIT 1
");

$pins = maybe_unserialize($results);
// Ensure it's an array
$pins = is_array($pins) ? $pins : [];
?>

<style>
/* ===== Doctors Page (Enhanced Design) ===== */
.doctors-page {
  display: flex;
  flex-direction: column;
  gap: 24px;
  padding: 24px;
  max-width: 1200px;
  margin: 0 auto;
  box-sizing: border-box;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  margin-top: 100px;
}

/* Page Title */
.page-title {
  text-align: center;
  margin-bottom: 16px;
}

.page-title h1 {
  font-size: 2.5rem;
  font-weight: 700;
  color: #1f2937;
  margin: 0 0 8px 0;
  background: linear-gradient(135deg, #0073aa, #005177);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.page-title p {
  font-size: 1.1rem;
  color: #6b7280;
  margin: 0;
}

/* Map container with enhanced styling */
.map-container {
  min-height: 480px;
  border: none;
  border-radius: 20px;
  overflow: hidden;
  background: #fff;
  box-shadow: 
    0 10px 25px -3px rgba(0, 0, 0, 0.1),
    0 4px 6px -2px rgba(0, 0, 0, 0.05);
  position: relative;
}

.map-container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #0073aa, #00a0d2, #0073aa);
  z-index: 10;
}

/* Enhanced search bar */
.search-container {
  display: flex;
  justify-content: center;
  position: relative;
}

#doctorSearch {
  width: 100%;
  max-width: 600px;
  padding: 16px 20px 16px 50px;
  border: 2px solid #e5e7eb;
  border-radius: 16px;
  font-size: 16px;
  outline: none;
  background: #fff;
  transition: all 0.3s ease;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
}

#doctorSearch:focus {
  border-color: #0073aa;
  box-shadow: 
    0 0 0 3px rgba(0, 115, 170, 0.1),
    0 4px 12px -2px rgba(0, 115, 170, 0.15);
  transform: translateY(-1px);
}

.search-container::before {
  content: '🔍';
  position: absolute;
  left: calc(50% - 300px + 18px);
  top: 50%;
  transform: translateY(-50%);
  font-size: 18px;
  pointer-events: none;
  z-index: 2;
}

/* Enhanced doctor list grid */
.doctor-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 20px;
}

.doctor-item {
  background: #ffffff;
  border: 1px solid #f1f5f9;
  border-radius: 16px;
  padding: 20px;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.doctor-item::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #0073aa, #00a0d2);
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

.doctor-item:hover {
  transform: translateY(-4px);
  box-shadow: 
    0 20px 25px -5px rgba(0, 0, 0, 0.1),
    0 10px 10px -5px rgba(0, 0, 0, 0.04);
  border-color: #e2e8f0;
}

.doctor-item:hover::before {
  transform: scaleX(1);
}

.doctor-item.active {
  border-color: #0073aa;
  background: linear-gradient(135deg, #f8faff 0%, #f0f8ff 100%);
  box-shadow: 
    0 20px 25px -5px rgba(0, 115, 170, 0.15),
    0 10px 10px -5px rgba(0, 115, 170, 0.1);
  transform: translateY(-4px);
}

.doctor-item.active::before {
  transform: scaleX(1);
}

.doctor-item h3 {
  margin: 0 0 8px 0;
  font-size: 1.25rem;
  font-weight: 600;
  color: #1f2937;
  display: flex;
  align-items: center;
  gap: 8px;
}

.doctor-item h3::before {
  content: '👨‍⚕️';
  font-size: 1.1rem;
}

.doctor-item p {
  margin: 0;
  color: #64748b;
  line-height: 1.6;
  font-size: 0.95rem;
}

.doctor-item .doctor-badge {
  display: inline-block;
  background: linear-gradient(135deg, #0073aa, #005177);
  color: white;
  font-size: 0.75rem;
  font-weight: 500;
  padding: 4px 8px;
  border-radius: 6px;
  margin-top: 8px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* No results styling */
.no-results {
  grid-column: 1 / -1;
  text-align: center;
  color: #9ca3af;
  padding: 40px 20px;
  font-size: 1.1rem;
  background: #f9fafb;
  border-radius: 12px;
  border: 2px dashed #e5e7eb;
}

.no-results::before {
  content: '🔍';
  display: block;
  font-size: 3rem;
  margin-bottom: 12px;
  opacity: 0.5;
}

/* Responsive design */
@media (max-width: 768px) {
  .doctors-page {
    padding: 16px;
    gap: 20px;
  }
  
  .page-title h1 {
    font-size: 2rem;
  }
  
  .doctor-list {
    grid-template-columns: 1fr;
  }
  
  .search-container::before {
    left: 18px;
  }
  
  #doctorSearch {
    font-size: 16px; /* Prevents zoom on iOS */
  }
}

@media (max-width: 480px) {
  .map-container {
    min-height: 300px;
    border-radius: 12px;
  }
  
  .doctor-item {
    padding: 16px;
  }
}

/* Loading animation */
@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

.loading {
  animation: pulse 2s infinite;
}

/* MapIt specific styling */
.wp_mapit_multipin_map {
  margin-bottom: 0 !important;
  border-radius: 16px !important;
  margin-top: 0px !important;
}

/* Enhanced popup styles */
.leaflet-popup-content-wrapper .doctor-popup {
  padding: 4px 0;
}

.leaflet-popup-content-wrapper .doctor-popup h3 {
  margin: 0 0 8px 0 !important;
  font-size: 17px !important;
  font-weight: 600 !important;
  color: #1f2937 !important;
  line-height: 1.3 !important;
  display: flex !important;
  align-items: center !important;
  gap: 6px !important;
}

.leaflet-popup-content-wrapper .doctor-popup h3::before {
  content: '👨‍⚕️' !important;
  font-size: 16px !important;
}

.leaflet-popup-content-wrapper .doctor-popup div {
  font-size: 14px !important;
  line-height: 1.5 !important;
  color: #64748b !important;
  margin: 0 !important;
}

.doctor-marker-popup .leaflet-popup-content-wrapper {
  border-radius: 12px !important;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
  border: 1px solid #e2e8f0 !important;
}

.doctor-marker-popup .leaflet-popup-tip {
  background: white !important;
  border: 1px solid #e2e8f0 !important;
}

.doctor-marker-popup .leaflet-popup-close-button {
  color: #6b7280 !important;
  font-size: 18px !important;
  font-weight: bold !important;
}

.doctor-marker-popup .leaflet-popup-close-button:hover {
  color: #1f2937 !important;
}
</style>

<main class="doctors-page" data-map-id="260">

  <!-- MAP -->
  <div class="map-container">
    <?php echo do_shortcode('[wp_mapit_map id="503"]'); ?>
  </div>

  <!-- SEARCH -->
  <div class="search-container">
    <input type="text" id="doctorSearch" placeholder="Search for a doctor...">
  </div>

  <!-- LIST -->
  <section class="doctor-list" id="doctorList">
    <?php if (!empty($pins)) : ?>
      <?php foreach ($pins as $index => $pin) : 
        $title = isset($pin['marker_title']) ? $pin['marker_title'] : '';
        $desc  = isset($pin['marker_content']) ? $pin['marker_content'] : '';
        $lat   = isset($pin['lat']) ? (float)$pin['lat'] : null;
        $lng   = isset($pin['lng']) ? (float)$pin['lng'] : null;
      ?>
        <div
          class="doctor-item"
          data-index="<?php echo esc_attr($index); ?>"
          data-title="<?php echo esc_attr($title); ?>"
          data-lat="<?php echo esc_attr($lat); ?>"
          data-lng="<?php echo esc_attr($lng); ?>"
          data-desc="<?php echo esc_attr($desc); ?>"
        >
          <h3><?php echo esc_html($title); ?></h3>
          <p><?php echo esc_html($desc); ?></p>
          <span class="doctor-badge">ADHD Specialist</span>
        </div>
      <?php endforeach; ?>
      <div class="no-results" id="noResults" style="display:none;">No doctors match your search.</div>
    <?php else : ?>
      <p>No doctors found.</p>
    <?php endif; ?>
  </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // ===== Config =====
  let MAP_ID = Number(document.querySelector('.doctors-page')?.dataset.mapId) || 260;

  // ===== Elements =====
  const searchInput  = document.getElementById('doctorSearch');
  const doctorItems  = Array.from(document.querySelectorAll('.doctor-item'));
  const noResultsEl  = document.getElementById('noResults');

  console.log('[Doctors] DOM ready. MAP_ID =', MAP_ID, 'Items:', doctorItems.length);

  // ===== Search filter =====
  function applyFilter(term) {
    let visibleCount = 0;
    const q = term.trim().toLowerCase();

    doctorItems.forEach(item => {
      const text = (item.dataset.title + ' ' + item.innerText).toLowerCase();
      const match = text.includes(q);
      item.style.display = match ? '' : 'none';
      if (match) visibleCount++;
    });

    if (noResultsEl) noResultsEl.style.display = visibleCount === 0 ? '' : 'none';
  }
  searchInput?.addEventListener('input', () => applyFilter(searchInput.value));

  // ===== Utility: collect markers from map as a fallback =====
  function collectMarkersFromMap(map) {
    const list = [];
    try {
      if (!map || typeof map.eachLayer !== 'function') {
        console.warn('[Doctors] collectMarkersFromMap: Invalid map object');
        return list;
      }

      console.log('[Doctors] Scanning map layers for markers...');
      
      map.eachLayer(layer => {
        // Direct marker check
        if (layer && typeof layer.getLatLng === 'function' && typeof layer.bindPopup === 'function') {
          console.log('[Doctors] Found direct marker:', layer);
          list.push(layer);
        }
        // Group/cluster layer check
        else if (layer && typeof layer.eachLayer === 'function') {
          console.log('[Doctors] Found layer group, scanning sublayers...');
          layer.eachLayer(inner => {
            if (inner && typeof inner.getLatLng === 'function' && typeof inner.bindPopup === 'function') {
              console.log('[Doctors] Found marker in group:', inner);
              list.push(inner);
            }
          });
        }
        // LayerGroup or FeatureGroup check
        else if (layer && layer._layers) {
          console.log('[Doctors] Found layer with _layers property, scanning...');
          Object.values(layer._layers).forEach(sublayer => {
            if (sublayer && typeof sublayer.getLatLng === 'function' && typeof sublayer.bindPopup === 'function') {
              console.log('[Doctors] Found marker in _layers:', sublayer);
              list.push(sublayer);
            }
          });
        }
        // Check for custom WP MapIt marker properties
        else if (layer && (layer.marker_title || layer.marker_content || layer._wpMapItMarker)) {
          console.log('[Doctors] Found WP MapIt marker:', layer);
          list.push(layer);
        }
      });
      
      console.log('[Doctors] collectMarkersFromMap found', list.length, 'markers');
    } catch (e) {
      console.warn('[Doctors] collectMarkersFromMap error:', e);
    }
    return list;
  }

  // ===== Utility: find nearest marker by lat/lng =====
  function findNearestMarker(markers, targetLat, targetLng) {
    let best = null;
    let bestDist = Infinity;
    markers.forEach(m => {
      if (m && typeof m.getLatLng === 'function') {
        const ll = m.getLatLng();
        const d = Math.hypot(ll.lat - targetLat, ll.lng - targetLng);
        if (d < bestDist) { best = m; bestDist = d; }
      }
    });
    return best;
  }

  // ===== Wait for WP MapIt to initialize =====
  const startedAt = Date.now();
  const timeoutMs = 30000; // 30s safety timeout

  function discoverMapAndMarkers() {
    let map = null;
    let markers = [];

    console.log('[Doctors][discover] Starting discovery process...');

    // Try multiple approaches to find the map
    // Approach 1: Direct WP MapIt globals
    map = window['wpMapitMap_' + MAP_ID];
    markers = window['wpMapitMarkers_' + MAP_ID];
    if (map) console.log('[Doctors][discover] Found map via direct ID:', MAP_ID);
    if (markers && markers.length) console.log('[Doctors][discover] Found markers via direct ID:', markers.length);

    // Approach 2: Search all WP MapIt globals
    if (!map) {
      const mapKeys = Object.keys(window).filter(k => /^wpMapitMap_/i.test(k));
      console.log('[Doctors][discover] Available map keys:', mapKeys);
      for (const k of mapKeys) {
        const candidate = window[k];
        if (candidate && typeof candidate.setView === 'function') {
          map = candidate;
          MAP_ID = k.split('_').pop();
          console.log('[Doctors][discover] Found map with key:', k, 'New MAP_ID:', MAP_ID);
          break;
        }
      }
    }

    if (!markers || !markers.length) {
      const markerKeys = Object.keys(window).filter(k => /^wpMapitMarkers_/i.test(k));
      console.log('[Doctors][discover] Available marker keys:', markerKeys);
      for (const mk of markerKeys) {
        const arr = window[mk];
        if (Array.isArray(arr) && arr.length) {
          markers = arr;
          console.log('[Doctors][discover] Found markers with key:', mk, 'count:', arr.length);
          break;
        }
      }
    }

    // Approach 3: Look for other WP MapIt related globals
    if (!map || !markers || !markers.length) {
      const allMapitKeys = Object.keys(window).filter(k => k.toLowerCase().includes('mapit'));
      console.log('[Doctors][discover] All MapIt-related keys:', allMapitKeys);
      
      allMapitKeys.forEach(key => {
        const obj = window[key];
        console.log('[Doctors][discover] Examining', key, ':', obj);
        
        if (obj && typeof obj === 'object') {
          // Check if it's a Leaflet layer that might have a parent map
          if (!map && obj._map && typeof obj._map.setView === 'function') {
            map = obj._map;
            console.log('[Doctors][discover] Found map via layer._map in:', key);
          }
          
          // Check if it's a map-like object
          if (!map && typeof obj.setView === 'function' && typeof obj.eachLayer === 'function') {
            map = obj;
            console.log('[Doctors][discover] Found map in:', key);
          }
          
          // Check if it contains map instances
          if (!map && obj.maps && typeof obj.maps === 'object') {
            console.log('[Doctors][discover] Found maps object in', key, ':', Object.keys(obj.maps));
            Object.values(obj.maps).forEach(mapInstance => {
              if (!map && mapInstance && typeof mapInstance.setView === 'function') {
                map = mapInstance;
                console.log('[Doctors][discover] Found map instance in', key + '.maps');
              }
            });
          }
          
          // Check if it contains markers
          if ((!markers || !markers.length) && obj.markers && Array.isArray(obj.markers)) {
            markers = obj.markers;
            console.log('[Doctors][discover] Found markers array in', key + '.markers:', markers.length);
          }
          
          // Check if it's an array of markers directly
          if ((!markers || !markers.length) && Array.isArray(obj) && obj.length > 0) {
            // Verify first element looks like a marker
            if (obj[0] && (typeof obj[0].getLatLng === 'function' || obj[0].lat || obj[0].lng)) {
              markers = obj;
              console.log('[Doctors][discover] Found marker array in:', key);
            }
          }
          
          // Check for specific WP MapIt structure
          if (key === 'wp_mapit' && obj.instances) {
            console.log('[Doctors][discover] Found wp_mapit.instances:', Object.keys(obj.instances));
            Object.values(obj.instances).forEach(instance => {
              if (!map && instance.map && typeof instance.map.setView === 'function') {
                map = instance.map;
                console.log('[Doctors][discover] Found map in wp_mapit.instances');
              }
              if ((!markers || !markers.length) && instance.markers && Array.isArray(instance.markers)) {
                markers = instance.markers;
                console.log('[Doctors][discover] Found markers in wp_mapit.instances:', markers.length);
              }
            });
          }
        }
      });
    }

    // Approach 4: Look for Leaflet map instances
    if (!map && typeof L !== 'undefined') {
      try {
        const containers = document.querySelectorAll('.leaflet-container');
        console.log('[Doctors][discover] Found', containers.length, 'Leaflet containers');
        
        for (const container of containers) {
          console.log('[Doctors][discover] Examining container:', container);
          
          // Try to find map instance attached to the container
          if (container._leaflet_map) {
            map = container._leaflet_map;
            console.log('[Doctors][discover] Found Leaflet map on container._leaflet_map');
            break;
          }
          
          // Try different Leaflet properties
          const leafletProps = Object.keys(container).filter(k => k.includes('leaflet') || k.includes('_L'));
          console.log('[Doctors][discover] Container Leaflet properties:', leafletProps);
          
          leafletProps.forEach(prop => {
            const obj = container[prop];
            if (!map && obj && typeof obj.setView === 'function') {
              map = obj;
              console.log('[Doctors][discover] Found map on container.' + prop);
            }
          });
          
          // Check for map ID in container attributes
          const mapId = container.getAttribute('data-map-id') || container.id;
          console.log('[Doctors][discover] Container ID/data-map-id:', mapId);
          if (mapId && window['map_' + mapId]) {
            map = window['map_' + mapId];
            console.log('[Doctors][discover] Found map via container ID:', mapId);
            break;
          }
          
          // Try to access the Leaflet instance directly
          if (!map && container._leaflet_id && L.Util && L.Util.stamp) {
            try {
              const leafletId = container._leaflet_id;
              console.log('[Doctors][discover] Container has Leaflet ID:', leafletId);
              // This is a long shot, but try to find the map in Leaflet's registry
            } catch(e) {}
          }
        }

        // Last resort: look for any Leaflet map in global scope
        if (!map) {
          console.log('[Doctors][discover] Searching global scope for Leaflet maps...');
          Object.keys(window).forEach(key => {
            const obj = window[key];
            if (obj && typeof obj.setView === 'function' && typeof obj.eachLayer === 'function' && obj._loaded) {
              map = obj;
              console.log('[Doctors][discover] Found Leaflet map in global:', key);
            }
          });
        }
      } catch(e) { 
        console.warn('[Doctors][discover] Leaflet detection error:', e); 
      }
    }

    // Approach 5: Try to access the shortcode map directly
    if (!map) {
      // Check if there's a map in the shortcode container
      const mapContainer = document.querySelector('.wp_mapit_multipin_map, .wp-mapit-map, [id*="mapit"], .leaflet-container');
      if (mapContainer) {
        console.log('[Doctors][discover] Found map container element:', mapContainer);
        console.log('[Doctors][discover] Container classes:', mapContainer.className);
        console.log('[Doctors][discover] Container ID:', mapContainer.id);
        
        // Look for attached map instance
        Object.keys(mapContainer).forEach(key => {
          console.log('[Doctors][discover] Container property:', key, mapContainer[key]);
          if (key.startsWith('_leaflet') || key.includes('map')) {
            const obj = mapContainer[key];
            if (obj && typeof obj.setView === 'function') {
              map = obj;
              console.log('[Doctors][discover] Found map on container property:', key);
            }
          }
        });
        
        // Try to find the Leaflet map directly in the container's children
        const leafletPane = mapContainer.querySelector('.leaflet-map-pane');
        if (leafletPane && leafletPane.parentElement) {
          console.log('[Doctors][discover] Found leaflet-map-pane, checking parent for map instance');
          const mapElement = leafletPane.parentElement;
          Object.keys(mapElement).forEach(key => {
            if (key.includes('leaflet') || key.includes('map')) {
              const obj = mapElement[key];
              if (!map && obj && typeof obj.setView === 'function') {
                map = obj;
                console.log('[Doctors][discover] Found map on map pane parent:', key);
              }
            }
          });
        }
      }
    }

    // Approach 6: Direct Leaflet global access
    if (!map && typeof L !== 'undefined') {
      console.log('[Doctors][discover] Trying direct Leaflet access...');
      
      // Try to access all Leaflet map instances
      if (L._mapInstances) {
        console.log('[Doctors][discover] Found L._mapInstances:', L._mapInstances);
        Object.values(L._mapInstances).forEach(mapInstance => {
          if (!map && mapInstance && typeof mapInstance.setView === 'function') {
            map = mapInstance;
            console.log('[Doctors][discover] Found map in L._mapInstances');
          }
        });
      }
      
      // Check if there's a global leaflet map
      if (!map && window.L && window.L.map) {
        const possibleMap = window.L.map;
        if (typeof possibleMap.setView === 'function') {
          map = possibleMap;
          console.log('[Doctors][discover] Found map at window.L.map');
        }
      }
      
      // Try to find map through Leaflet's internal registry
      if (!map && L.Util && L.Util.stamp) {
        console.log('[Doctors][discover] Searching through Leaflet objects...');
        
        // Look through all window properties for objects with _leaflet_id
        Object.keys(window).forEach(key => {
          const obj = window[key];
          if (obj && obj._leaflet_id && typeof obj === 'object') {
            // If it's a map
            if (!map && typeof obj.setView === 'function' && typeof obj.eachLayer === 'function') {
              map = obj;
              console.log('[Doctors][discover] Found map via _leaflet_id in:', key);
            }
            // If it's a layer, try to get its parent map
            else if (!map && obj._map && typeof obj._map.setView === 'function') {
              map = obj._map;
              console.log('[Doctors][discover] Found map via layer._map in:', key);
            }
          }
        });
      }
      
      // Final attempt: scan all DOM elements for map instances
      if (!map) {
        console.log('[Doctors][discover] Final attempt: scanning DOM elements...');
        document.querySelectorAll('*').forEach(element => {
          Object.keys(element).forEach(prop => {
            if (!map && prop.includes('leaflet') && element[prop] && typeof element[prop].setView === 'function') {
              map = element[prop];
              console.log('[Doctors][discover] Found map on DOM element property:', prop);
            }
          });
        });
      }
    }

    // Collect markers from map layers if we have a map but no markers array
    if (map && (!markers || !markers.length)) {
      console.log('[Doctors][discover] Map found but no markers, scanning map layers...');
      markers = collectMarkersFromMap(map);
      if (markers.length) {
        console.log('[Doctors][discover] Collected', markers.length, 'markers from map layers');
      }
    }

    console.log('[Doctors][discover] Discovery complete. Map:', !!map, 'Markers:', markers ? markers.length : 0);
    return { map, markers };
  }

  // Add initial delay to let WP MapIt fully load
  setTimeout(() => {
    console.log('[Doctors] Starting map discovery after initial delay...');
    
    const poll = setInterval(() => {
      const { map, markers } = discoverMapAndMarkers();

      // Debug info on each poll
      if (Date.now() - startedAt > 3000) { // After 3 seconds, start logging more details
        console.log('[Doctors][poll] Searching... Map found:', !!map, 'Markers found:', markers ? markers.length : 0);
        
        // Log available window properties for debugging
        const windowKeys = Object.keys(window).filter(k => 
          k.toLowerCase().includes('map') || 
          k.toLowerCase().includes('marker') || 
          k.toLowerCase().includes('leaflet') ||
          k.toLowerCase().includes('wpmapit')
        );
        console.log('[Doctors][poll] Available window properties:', windowKeys);
      }

    if (map && markers && markers.length) {
      clearInterval(poll);
      console.log('[Doctors] SUCCESS! Map & markers ready. MAP_ID:', MAP_ID, 'Marker count:', markers.length);

        // Build a fast lookup by rounded lat,lng
        const markerLookup = new Map();
        function roundCoord(n){ return Number.parseFloat(n).toFixed(4); } // Reduced precision for better matching
        
        markers.forEach((m, i) => {
          if (m && typeof m.getLatLng === 'function') {
            try {
              const ll = m.getLatLng();
              const key = roundCoord(ll.lat) + ',' + roundCoord(ll.lng);
              if (!markerLookup.has(key)) markerLookup.set(key, []);
              markerLookup.get(key).push(m);
            } catch(e) {
              console.warn('[Doctors] Error processing marker', i, ':', e);
            }
          }
        });
        console.log('[Doctors] Marker lookup created with', markerLookup.size, 'coordinate keys');

        function buildPopupHtml(title, desc){
          return `<div class="doctor-popup"><h3 style="margin:0 0 6px;font-size:16px;color:#1f2937;font-weight:600;">${escapeHtml(title)}</h3><div style="font-size:14px;line-height:1.5;color:#4b5563;">${escapeHtml(desc)}</div></div>`;
        }

        function setMarkerPopup(marker, html){
          try {
            if (marker.getPopup && marker.getPopup()) {
              marker.setPopupContent(html);
            } else if (marker.bindPopup) {
              marker.bindPopup(html, { maxWidth: 300, className: 'doctor-marker-popup' });
            }
            return true;
          } catch(e){ 
            console.warn('[Doctors] setMarkerPopup error:', e); 
            return false;
          }
        }

        function openMarkerPopup(marker){
          if (!marker) return false;
          try {
            // Try opening popup directly
            if (marker.openPopup && typeof marker.openPopup === 'function') { 
              marker.openPopup(); 
              return true; 
            }
            // Try triggering click event
            if (marker.fire && typeof marker.fire === 'function') { 
              marker.fire('click'); 
              return true; 
            }
            // Try accessing popup directly and opening it
            if (marker.getPopup && typeof marker.getPopup === 'function') {
              const popup = marker.getPopup();
              if (popup && popup.openOn && typeof popup.openOn === 'function') {
                popup.openOn(map);
                return true;
              }
            }
          } catch(e){ 
            console.warn('[Doctors] openMarkerPopup error:', e); 
          }
          return false;
        }

        function fallbackLeafletPopup(map, lat, lng, html){
          if (typeof L !== 'undefined' && L.popup) {
            try {
              const popup = L.popup({ 
                maxWidth: 300, 
                className: 'doctor-marker-popup' 
              })
              .setLatLng([lat, lng])
              .setContent(html);
              
              if (popup.openOn && typeof popup.openOn === 'function') {
                popup.openOn(map);
                return true;
              }
            } catch(e) {
              console.warn('[Doctors] fallbackLeafletPopup error:', e);
            }
          }
          return false;
        }

        function findMarkerFor(lat, lng, idx){
          // 1. Try by index first (most reliable if available)
          if (Number.isInteger(idx) && idx >= 0 && markers[idx] && typeof markers[idx].getLatLng === 'function') {
            const marker = markers[idx];
            const markerLL = marker.getLatLng();
            // Verify the coordinates match roughly (within 0.001 degrees ~ 100m)
            if (Math.abs(markerLL.lat - lat) < 0.001 && Math.abs(markerLL.lng - lng) < 0.001) {
              return marker;
            }
          }
          
          // 2. Try exact coordinate lookup
          const key = roundCoord(lat) + ',' + roundCoord(lng);
          const coordMatches = markerLookup.get(key);
          if (coordMatches && coordMatches.length) {
            return coordMatches[0]; // Return first match
          }
          
          // 3. Find nearest marker (fallback)
          return findNearestMarker(markers, lat, lng);
        }

        // Click doctor item -> open marker popup + focus map
        doctorItems.forEach((item) => {
          item.addEventListener('click', () => {
            // Remove active class from all items
            doctorItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            const lat = parseFloat(item.dataset.lat);
            const lng = parseFloat(item.dataset.lng);
            const title = item.dataset.title || '';
            const desc = item.dataset.desc || '';
            const idx = Number(item.dataset.index);

            console.log('[Doctors] Item clicked:', { title, lat, lng, idx });

            // Validate coordinates
            if (isNaN(lat) || isNaN(lng)) {
              console.error('[Doctors] Invalid coordinates for item:', { title, lat, lng });
              return;
            }

            // Create popup content
            const popupHtml = buildPopupHtml(title, desc);
            
            // Find the corresponding marker
            let marker = findMarkerFor(lat, lng, idx);
            let popupOpened = false;

            if (marker) {
              console.log('[Doctors] Found marker for item:', title);
              
              // Set popup content and try to open it
              if (setMarkerPopup(marker, popupHtml)) {
                popupOpened = openMarkerPopup(marker);
                
                if (popupOpened) {
                  console.log('[Doctors] Successfully opened marker popup');
                } else {
                  // Try multiple fallback approaches
                  console.warn('[Doctors] Direct popup failed, trying alternatives...');
                  
                  // Try simulating a click event
                  try {
                    if (marker._icon) {
                      marker._icon.click();
                      popupOpened = true;
                    }
                  } catch(e) {}
                  
                  // Try triggering mousedown then mouseup
                  if (!popupOpened) {
                    try {
                      if (marker.fire) {
                        marker.fire('mousedown');
                        setTimeout(() => marker.fire('mouseup'), 10);
                        popupOpened = true;
                      }
                    } catch(e) {}
                  }
                }
              }
              
              // Center map on marker
              try {
                const markerLatLng = marker.getLatLng();
                map.setView(markerLatLng, Math.max(map.getZoom(), 15), { animate: true });
              } catch(e) {
                console.warn('[Doctors] Could not center map on marker:', e);
                map.setView([lat, lng], Math.max(map.getZoom(), 15), { animate: true });
              }
            }

            // If no marker found or popup failed, create fallback popup
            if (!marker || !popupOpened) {
              console.warn('[Doctors] Using fallback popup for:', title);
              if (fallbackLeafletPopup(map, lat, lng, popupHtml)) {
                popupOpened = true;
              }
              
              // Center map on coordinates
              try {
                map.setView([lat, lng], Math.max(map.getZoom(), 15), { animate: true });
              } catch(e) {
                console.error('[Doctors] Could not center map:', e);
              }
            }

            // On mobile, scroll map into view for better UX
            if (window.matchMedia('(max-width: 1024px)').matches) {
              setTimeout(() => {
                document.querySelector('.map-container')?.scrollIntoView({ 
                  behavior: 'smooth', 
                  block: 'start' 
                });
              }, 100);
            }

            console.log('[Doctors] Popup operation completed for:', title, 'Success:', popupOpened);
          });
        });

        // Marker -> highlight doctor item
        markers.forEach((marker) => {
          if (marker && marker.on) {
            marker.on('click', () => {
              const ll = marker.getLatLng ? marker.getLatLng() : null;
              if (!ll) return;

              // Find the item with nearest coords
              let bestItem = null, bestDist = Infinity;
              doctorItems.forEach(item => {
                const lat = parseFloat(item.dataset.lat);
                const lng = parseFloat(item.dataset.lng);
                const d = Math.hypot(lat - ll.lat, lng - ll.lng);
                if (d < bestDist) { bestDist = d; bestItem = item; }
              });

              if (bestItem) {
                doctorItems.forEach(i => i.classList.remove('active'));
                bestItem.classList.add('active');
                bestItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                // Sync popup content to selected item if needed
                const title = bestItem.dataset.title || '';
                const desc = bestItem.dataset.desc || '';
                const popupHtml = buildPopupHtml(title, desc);
                setMarkerPopup(marker, popupHtml);
                console.log('[Doctors] Marker clicked -> highlighted item:', bestItem.dataset.title);
              }
            });
          }
        });

        return; // done
    }

    if (Date.now() - startedAt > timeoutMs) {
      clearInterval(poll);
      console.group('[Doctors] Timeout diagnostics');
      console.error('[Doctors] Timed out waiting for WP MapIt map/markers after', timeoutMs/1000,'s');
      console.log('Window keys (subset):', Object.keys(window).filter(k=>k.startsWith('wpMapit')));
      console.log('Leaflet present?', typeof L !== 'undefined');
      console.groupEnd();
    }
    }, 100); // Increased frequency to 100ms for faster detection
  }, 500); // Reduced initial delay to 500ms
});

// ===== Helper: simple HTML escape to avoid breaking popup markup =====
function escapeHtml(str) {
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}
</script>

<!-- FOOTER -->
<?php get_footer(); ?>
