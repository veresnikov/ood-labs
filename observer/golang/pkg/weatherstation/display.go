package weatherstation

import (
	"fmt"

	"github.com/veresnikov/ood-labs/observer/golang/pkg/observer"
)

func NewDisplay() observer.Observer[WeatherData] {
	return &display{}
}

type display struct {
	temperature float32
	humidity    float32
	pressure    float32
}

func (d *display) Update(data WeatherData) {
	d.temperature = data.temperature
	d.humidity = data.humidity
	d.pressure = data.pressure
	d.printInfo()
}

func (d *display) printInfo() {
	fmt.Printf("Temperature: %v\nHumidity: %v\nPressure: %v\n", d.temperature, d.humidity, d.pressure)
}
