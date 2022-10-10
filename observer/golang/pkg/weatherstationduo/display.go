package weatherstationduo

import (
	"fmt"
)

func NewDisplay() Observer {
	return &display{
		data: make(map[*Station]WeatherData),
	}
}

type display struct {
	data map[*Station]WeatherData
}

func (d *display) addStation(station *Station) {
	d.data[station] = WeatherData{}
}

func (d *display) removeStation(station *Station) {
	delete(d.data, station)
}

func (d *display) Update(payload WeatherData) {
	_, ok := d.data[payload.sender]
	if ok {
		d.data[payload.sender] = payload
		d.printInfo(payload)
	}
}

func (d *display) printInfo(data WeatherData) {
	fmt.Printf("Station location %v\nTemperature: %v\nHumidity: %v\nPressure: %v\n",
		data.sender.getLocation(),
		data.temperature,
		data.humidity,
		data.pressure,
	)
}
