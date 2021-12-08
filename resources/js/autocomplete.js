window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let address = document.getElementById('address');



address.addEventListener('click', function(){
    // fetch('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-regioni.json')
    // .then(response => response.json());
    console.log('ciaone');
});

// 'https://api.tomtom.com/search/2/search/'


// fetch('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-regioni.json')
// .then(response => response.json())
// .then(dati => {
//     let sorted = dati.reverse()
//     let lastUpdated = sorted[0].data
//     let lastUpdatedFormatted = lastUpdated.split("T")[0].split("-").reverse().join("/")

//     console.log(lastUpdatedFormatted)
// })