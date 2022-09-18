package weatherstation

import (
	"fmt"

	"github.com/veresnikov/ood-labs/observer/golang/pkg/observer"
)

func NewStatisticsDisplay() observer.Observer[WeatherData] {
	return &statisticsDisplay{}
}

type statisticsDisplay struct {
	minTemperature *float32
	maxTemperature *float32
	accTemperature *float32
	countAcc       int
}

func (d *statisticsDisplay) Update(data WeatherData) {
	if d.minTemperature == nil {
		minTemperature := data.temperature
		d.minTemperature = &minTemperature
	} else {
		if *d.minTemperature > data.temperature {
			*d.minTemperature = data.temperature
		}
	}
	if d.maxTemperature == nil {
		maxTemperature := data.temperature
		d.maxTemperature = &maxTemperature
	} else {
		if *d.maxTemperature < data.temperature {
			*d.maxTemperature = data.temperature
		}
	}
	if d.accTemperature == nil {
		accTemperature := data.temperature
		d.accTemperature = &accTemperature
	} else {
		*d.accTemperature += data.temperature
	}
	d.countAcc++
	d.printInfo()
}

func (d *statisticsDisplay) printInfo() {
	fmt.Printf("Max temperature: %v\nMin temperature: %v\nAvg temperature: %v\n",
		*d.maxTemperature,
		*d.minTemperature,
		*d.accTemperature/float32(d.countAcc),
	)
}
