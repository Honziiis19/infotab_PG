currentWeather();
setInterval(currentWeather, 30000)
async function getWeather() {
    let weather= await fetch("https://api.openweathermap.org/data/2.5/weather?lat=49.3487181&lon=16.4243806&lang=cz&appid=a296927699ef78adbcd0efff41c64f09")
    weather= await weather.json();
    console.log(weather)
    return {
        "pocasi":    weather.weather[0].description,
        "teplota":   weather.main.temp-273.15,
        "tlak":      weather.main.pressure,
        "vlhkost":   weather.main.humidity,
        "icon":      weather.weather[0].icon
        }
}

async function currentWeather() {
    let pocasi = await getWeather();
    
    //pocasi.icon
    document.getElementById("stav").innerHTML = pocasi.pocasi 
    document.getElementById("teplota").innerHTML = Math.round(pocasi.teplota)
    document.getElementById("tlak").innerHTML = pocasi.tlak
    document.getElementById("image").setAttribute("src","img/"+pocasi.icon+".svg")
    document.getElementById("vlhkost").innerHTML = pocasi.vlhkost

}










