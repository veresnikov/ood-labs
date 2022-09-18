package weatherstationduo

import (
	"fmt"

	"github.com/veresnikov/ood-labs/observer/golang/pkg/observer"
)

func NewDisplay() observer.Observer[WeatherData] {
	return &display{}
}

type display struct {
	inStation  WeatherData
	outStation WeatherData
}

func (d *display) Update(data WeatherData) {
	switch data.sender {
	case WeatherStationIn:
		d.inStation = data
		d.printInfo(d.inStation)
		break
	case WeatherStationOut:
		d.outStation = data
		d.printInfo(d.outStation)
		break
	}
}

func (d *display) printInfo(data WeatherData) {
	fmt.Printf("Station location %v\nTemperature: %v\nHumidity: %v\nPressure: %v\n",
		data.sender,
		data.temperature,
		data.humidity,
		data.pressure,
	)
}
