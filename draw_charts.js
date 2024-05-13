
// Load thư viện Google Charts
google.charts.load('current', {'packages':['corechart']});

// Khi nút "Get Weather Data" được nhấn
$(document).ready(function() {
    $(".btn_save").click(function() {
        // Gọi hàm để lấy dữ liệu từ cơ sở dữ liệu và vẽ biểu đồ
        getWeatherDataAndDrawChart();
    });
});

// Hàm để lấy dữ liệu từ cơ sở dữ liệu và vẽ biểu đồ
function getWeatherDataAndDrawChart() {
    // Gọi AJAX để lấy dữ liệu từ cơ sở dữ liệu
    $.ajax({
        url: "api/get_weather_data",  // Địa chỉ API để lấy dữ liệu thời tiết
        type: "GET",
        success: function(data) {
            // Sau khi nhận được dữ liệu, vẽ biểu đồ
            drawChart(data);
        },
        error: function() {
            // Xử lý lỗi nếu có
            alert("Error occurred while fetching weather data!");
        }
    });
}

// Hàm để vẽ biểu đồ
function drawChart(weatherData) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Date');
    data.addColumn('number', 'Temperature (°C)');

    // Thêm dữ liệu từ weatherData vào biểu đồ
    for (var i = 0; i < weatherData.length; i++) {
        data.addRow([weatherData[i].Date, weatherData[i]['Temperature (°C)']]);
    }

    var options = {
        title: 'Temperature Forecast',
        curveType: 'function',
        legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    chart.draw(data, options);
}
