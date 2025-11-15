"use strict";
// 06 - Enums: agrupar constantes con valores definidos
var Weather;
(function (Weather) {
    Weather["Sunny"] = "Sunny";
    Weather["Rainy"] = "Rainy";
    Weather["Cloudy"] = "Cloudy";
    Weather["Windy"] = "Windy";
})(Weather || (Weather = {}));
const todayWeather = Weather.Sunny;
// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li><strong>Today's weather:</strong> ${todayWeather}</li>
    `;
}
