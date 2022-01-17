let map, heatmap;



function initMap() {
    const mapOptions = {
        zoom: 5.5,
        center: {lat: 56.073156, lng: -4.011995},
        mapTypeId: 'satellite'
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    heatmap = new google.maps.visualization.HeatmapLayer({
        data: getPoints()
    });
    heatmap.setMap(map);
}




function toggleHeatMap() {
    heatmap.setMap(heatmap.getMap() ? null : map);
}

function changeGradient() {
    var gradient = [
        'rgba(0, 255, 255, 0)',
        'rgba(0, 255, 255, 1)',
        'rgba(0, 191, 255, 1)',
        'rgba(0, 127, 255, 1)',
        'rgba(0, 63, 255, 1)',
        'rgba(0, 0, 255, 1)',
        'rgba(0, 0, 223, 1)',
        'rgba(0, 0, 191, 1)',
        'rgba(0, 0, 159, 1)',
        'rgba(0, 0, 127, 1)',
        'rgba(63, 0, 91, 1)',
        'rgba(127, 0, 63, 1)',
        'rgba(191, 0, 31, 1)',
        'rgba(255, 0, 0, 1)'
    ]

    heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
}


function changeRadius() {
    heatmap.set('radius', heatmap.get('radius') ? null : 20);
}

function changeOpacity() {
    heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
}

function getPoints() {
    return [
        new google.maps.LatLng(37.782, -122.447),
        new google.maps.LatLng(37.782, -122.445),
        new google.maps.LatLng(37.782, -122.443)
    ];
}