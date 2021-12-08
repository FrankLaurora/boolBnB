let chiamata='Roma Via Appia';
document.getElementById('addressoptions').addEventListener('keyup',()=>{
  chiamata=document.getElementById('addressoptions').value;
  fetch('https://api.tomtom.com/search/2/geocode/'+chiamata+'.json?key=jXiFCoqvlFBNjmqBX4SuU1ehhUX1JF7t&language=it-IT')
  .then(response => response.json())
    .then(data => {
      // console.log(data);
      document.getElementById('address').innerHTML="";
      for(let i=0;i<data.results.length;i++){
        document.getElementById('address').innerHTML+=`<option>${data.results[i].address.freeformAddress}</option>`;
      }
      console.log(document.getElementById('address').value);
    });
});