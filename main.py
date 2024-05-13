import requests
from datetime import datetime, timedelta
import matplotlib.pyplot as plt

def get_weather_data(city, api_key, date):
    url = f"http://api.openweathermap.org/data/2.5/forecast?q={city}&appid={api_key}&units=metric"
    response = requests.get(url)
    data = response.json()
    return data

def extract_weather_info(data):
    weather_info = []
    for item in data['list']:
        date = item['dt_txt']
        temperature = item['main']['temp']
        humidity = item['main']['humidity']
        pressure = item['main']['pressure']
        rain = item.get('rain', {}).get('3h', 0)  # Lượng mưa trong 3 giờ (nếu có)
        wind_speed = item['wind']['speed']
        weather_info.append({'Date': date, 'Temperature (°C)': temperature, 'Humidity (%)': humidity, 
                             'Pressure (hPa)': pressure, 'Rain (mm)': rain, 'Wind Speed (m/s)': wind_speed})
    return weather_info

def get_past_date(days):
    today = datetime.now()
    past_date = today - timedelta(days=days)
    return past_date.strftime("%Y-%m-%d")

city = "Thai Nguyen"  # Thay đổi thành tên thành phố bạn quan tâm
api_key = "093bc10f5336f52a5c3c761e7b731280"  # Thay YOUR_API_KEY bằng API key của bạn từ OpenWeatherMap
past_date = get_past_date(7)  # Lấy dữ liệu 1 tuần trước

weather_data = get_weather_data(city, api_key, past_date)
weather_info = extract_weather_info(weather_data)

# Tách thông tin thời tiết thành các danh sách riêng biệt
dates = [item['Date'] for item in weather_info]
temperatures = [item['Temperature (°C)'] for item in weather_info]
humidities = [item['Humidity (%)'] for item in weather_info]
pressures = [item['Pressure (hPa)'] for item in weather_info]
rains = [item['Rain (mm)'] for item in weather_info]
wind_speeds = [item['Wind Speed (m/s)'] for item in weather_info]

# Vẽ biểu đồ
plt.figure(figsize=(10, 6))

# Biểu đồ nhiệt độ
plt.plot(dates, temperatures, label='Temperature (°C)', color='red', linestyle='-')

# Biểu đồ độ ẩm
plt.plot(dates, humidities, label='Humidity (%)', color='blue', linestyle='-')

# Biểu đồ áp suất không khí
plt.plot(dates, pressures, label='Pressure (hPa)', color='green', linestyle='-')

# Biểu đồ lượng mưa
plt.plot(dates, rains, label='Rain (mm)', color='purple', linestyle='-')

# Biểu đồ tốc độ gió
plt.plot(dates, wind_speeds, label='Wind Speed (m/s)', color='orange', linestyle='-')

plt.xlabel('Date')
plt.ylabel('Value')
plt.title('Weather Forecast')
plt.xticks(rotation=45)
plt.legend()
plt.grid(True)
plt.tight_layout()

plt.show()
