// desktop
var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
function getCountries()
{

    var x = document.getElementById("country");
    var y = document.getElementById("state");
    x.innerHTML=""
    x.innerHTML=` <option selected>Nigeria NG</option>`
    axios.get('/country')
          .then(response => {
        let items=response.data;
           for (i in items) {
            var option = document.createElement("option");
            option.text =items[i]+" "+i;
            x.add(option);
          }
          })
          var y = document.getElementById("state");
          y.innerHTML=""
          y.innerHTML=` <option selected value="">Select City</option>`
          let data=x.value.slice(-2)
          getStates(data)
}

function getStates(data)
{
    var x = document.getElementById("state");
    axios.get(`/state/${data}`)
          .then(response => {
        let items=response.data;
           for (i in items) {
            var option = document.createElement("option");
            option.text =items[i];
            x.add(option);
          }
          })

}

getCountries()



// mobile
function loadFileM(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputM');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
function getCountriesM()
{

    var x = document.getElementById("countryM");
    var y = document.getElementById("stateM");
    x.innerHTML=""
    x.innerHTML=` <option selected>Nigeria NG</option>`
    axios.get('/country')
          .then(response => {
        let items=response.data;
           for (i in items) {
            var option = document.createElement("option");
            option.text =items[i]+" "+i;
            x.add(option);
          }
          })
          var y = document.getElementById("stateM");
          y.innerHTML=""
          y.innerHTML=` <option selected value="">Select City</option>`
          let data=x.value.slice(-2)
          getStatesM(data)
}

function getStatesM(data)
{
    var x = document.getElementById("stateM");
    axios.get(`/state/${data}`)
          .then(response => {
        let items=response.data;
           for (i in items) {
            var option = document.createElement("option");
            option.text =items[i];
            x.add(option);
          }
          })

}

getCountriesM()
