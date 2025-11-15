// 06 - Enums: agrupar constantes con valores definidos
enum Weather {
    Sunny = "Sunny",
    Rainy = "Rainy",
    Cloudy = "Cloudy",
    Windy = "Windy"
}
const todayWeather: Weather = Weather.Sunny;
// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li><strong>Today's weather:</strong> ${todayWeather}</li>
    `;
}
