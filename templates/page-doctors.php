<!-- HEADER -->
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
/* ===== Doctors Page (single-file) ===== */
.doctors-page {
  display: flex;
  flex-direction: column;
  gap: 18px;
  padding: 16px;
  max-width: 1120px;
  margin: 0 auto;
  box-sizing: border-box;
}

/* Map up top */
.map-container {
  min-height: 420px;
  border: 1px solid #e5e7eb;
  border-radius: 14px;
  overflow: hidden;
  background: #fff;
}

/* Search bar */
.search-container {
  display: flex;
  justify-content: center;
}
#doctorSearch {
  width: 100%;
  max-width: 560px;
  padding: 12px 14px;
  border: 2px solid #0073aa;
  border-radius: 10px;
  font-size: 16px;
  outline: none;
}
#doctorSearch:focus {
  box-shadow: 0 0 0 4px rgba(0,115,170,0.15);
}

/* Doctor list grid */
.doctor-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 12px;
}
.doctor-item {
  background: #ffffff;
  border: 1px solid #e5e7eb;
  border-radius: 12px;
  padding: 14px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.04);
  cursor: pointer;
  transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease, background .15s ease;
}
.doctor-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 18px rgba(0,0,0,0.06);
}
.doctor-item.active {
  border-color: #0073aa;
  background: #f0f8ff;
  box-shadow: 0 8px 18px rgba(0,115,170,0.12);
}
.doctor-item h3 {
  margin: 0 0 6px 0;
  font-size: 1.05rem;
  color: #0f172a;
}
.doctor-item p {
  margin: 0;
  color: #475569;
  line-height: 1.45;
}

/* No results */
.no-results {
  grid-column: 1 / -1;
  text-align: center;
  color: #64748b;
  padding: 12px;
}

/* Responsive tweaks */
@media (max-width: 600px) {
  #doctorSearch { font-size: 14px; }
}
</style>

<main class="doctors-page" data-map-id="260">
  <!-- MAP -->
  <div class="map-container">
    <?php echo do_shortcode('[wp_mapit_map id="260"]'); ?>
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
      map.eachLayer(layer => {
        if (layer && typeof layer.getLatLng === 'function' && typeof layer.bindPopup === 'function') {
          list.push(layer);
        }
        // If WP MapIt adds markers into groups, dig one level
        if (layer && typeof layer.eachLayer === 'function') {
          layer.eachLayer(inner => {
            if (inner && typeof inner.getLatLng === 'function' && typeof inner.bindPopup === 'function') {
              list.push(inner);
            }
          });
        }
      });
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
    let map = window['wpMapitMap_' + MAP_ID];
    let markers = window['wpMapitMarkers_' + MAP_ID];

    // Broad search if not found or empty
    if (!map) {
      const mapKeys = Object.keys(window).filter(k => /^wpMapitMap_/.test(k));
      if (mapKeys.length) {
        console.log('[Doctors][discover] Available map keys:', mapKeys);
        for (const k of mapKeys) {
          const candidate = window[k];
            if (candidate && typeof candidate.setView === 'function' && typeof candidate.addLayer === 'function') {
              map = candidate;
              const idFromKey = k.split('_').pop();
              if (!isNaN(Number(idFromKey))) MAP_ID = Number(idFromKey);
              break;
            }
        }
      }
    }

    if ((!markers || !markers.length)) {
      const markerKeys = Object.keys(window).filter(k => /^wpMapitMarkers_/i.test(k));
      if (markerKeys.length) {
        console.log('[Doctors][discover] Available marker keys:', markerKeys);
        for (const mk of markerKeys) {
          const arr = window[mk];
          if (Array.isArray(arr) && arr.length) {
            markers = arr;
            // Attempt to sync MAP_ID
            const idFromKey = mk.split('_').pop();
            if (!isNaN(Number(idFromKey))) MAP_ID = Number(idFromKey);
            break;
          }
        }
      }
    }

    // As absolute fallback, attempt to detect Leaflet maps via L if available
    if (!map && typeof L !== 'undefined' && L && L.Map && L.layerGroup) {
      try {
        // L has internal _leaflet_id registry in layers; easier: look for divs with leaflet-container
        const containers = document.querySelectorAll('.leaflet-container');
        containers.forEach(c => {
          if (!map && c._leaflet_id) {
            // Leaflet stores map instance on c._leaflet_id via L.stamp; we can't easily reverse map.
            // Heuristic: iterate potential globals holding map-like objects
            Object.keys(window).forEach(k => {
              const v = window[k];
              if (!map && v && typeof v.setView === 'function' && typeof v.addLayer === 'function' && v._loaded) {
                map = v;
              }
            });
          }
        });
      } catch(e){ console.warn('[Doctors][discover] Leaflet heuristic error', e); }
    }

    // Collect markers from map if needed
    if (map && (!markers || !markers.length)) {
      markers = collectMarkersFromMap(map);
      if (markers.length) console.log('[Doctors][discover] Collected markers from map:', markers.length);
    }

    return { map, markers };
  }

  const poll = setInterval(() => {
    const { map, markers } = discoverMapAndMarkers();

    if (map && markers && markers.length) {
      clearInterval(poll);
      console.log('[Doctors] Map & markers ready. Using MAP_ID =', MAP_ID, 'Marker count =', markers.length);

        // Build a fast lookup by rounded lat,lng
        const markerLookup = new Map();
        function roundCoord(n){ return Number.parseFloat(n).toFixed(5); }
        markers.forEach((m,i)=>{
          if (m && typeof m.getLatLng === 'function') {
            const ll = m.getLatLng();
            const key = roundCoord(ll.lat)+','+roundCoord(ll.lng);
            if(!markerLookup.has(key)) markerLookup.set(key, []);
            markerLookup.get(key).push(m);
          }
        });
        console.log('[Doctors] Marker lookup keys:', markerLookup.size);

        function buildPopupHtml(title, desc){
          return `<div class="doctor-popup"><h3 style=\"margin:0 0 4px;font-size:15px;\">${escapeHtml(title)}</h3><div style=\"font-size:13px;line-height:1.4;\">${escapeHtml(desc)}</div></div>`;
        }

        function setMarkerPopup(marker, html){
          try {
            if (marker.getPopup && marker.getPopup()) {
              marker.setPopupContent(html);
            } else if (marker.bindPopup) {
              marker.bindPopup(html, { maxWidth: 260 });
            }
          } catch(e){ console.warn('[Doctors] setMarkerPopup error', e); }
        }

        function openMarkerPopup(marker){
          if (!marker) return false;
          try {
            if (marker.openPopup) { marker.openPopup(); return true; }
            if (marker.fire) { marker.fire('click'); return true; }
          } catch(e){ console.warn('[Doctors] openMarkerPopup error', e); }
          return false;
        }

        function fallbackLeafletPopup(map, lat, lng, html){
          if (typeof L !== 'undefined' && L.popup) {
            L.popup({ maxWidth: 260 }).setLatLng([lat,lng]).setContent(html).openOn(map);
            return true;
          }
          return false;
        }

        function findMarkerFor(lat, lng, idx){
          // 1. Index direct
          if (Number.isInteger(idx) && markers[idx] && typeof markers[idx].getLatLng === 'function') return markers[idx];
          // 2. Exact rounded match
          const key = roundCoord(lat)+','+roundCoord(lng);
            const arr = markerLookup.get(key);
            if (arr && arr.length) return arr[0];
          // 3. Nearest
          return findNearestMarker(markers, lat, lng);
        }

        // Click doctor item -> open marker popup + focus map
        doctorItems.forEach((item) => {
          item.addEventListener('click', () => {
            doctorItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            const lat = parseFloat(item.dataset.lat);
            const lng = parseFloat(item.dataset.lng);
            const title = item.dataset.title || '';
            const desc = item.dataset.desc || '';

            console.log('[Doctors] Item clicked:', { title: item.dataset.title, lat, lng });

            const idx = Number(item.dataset.index);
            let marker = findMarkerFor(lat, lng, idx);
            const popupHtml = buildPopupHtml(title, desc);

            if (marker) {
              setMarkerPopup(marker, popupHtml);
              if (!openMarkerPopup(marker)) {
                console.warn('[Doctors] Could not open marker directly, firing click fallback.');
                try { marker.fire && marker.fire('click'); } catch(e){}
              }
              try { map.setView(marker.getLatLng(), Math.max(map.getZoom(), 14), { animate: true }); } catch(e){}
            } else {
              console.warn('[Doctors] No marker matched -> creating leaflet popup fallback');
              fallbackLeafletPopup(map, lat, lng, popupHtml);
              try { map.setView([lat,lng], Math.max(map.getZoom(), 14), { animate: true }); } catch(e){}
            }

            // On mobile, scroll map into view for better UX
            if (window.matchMedia('(max-width: 1024px)').matches) {
              document.querySelector('.map-container')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
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
  }, 300);
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
