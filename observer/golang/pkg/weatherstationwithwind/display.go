package weatherstationwithwind

import (
	"fmt"
	"github.com/veresnikov/ood-labs/observer/golang/pkg/observer"
)

func NewDisplay() observer.Observer[WeatherData] {
	return &display{}
}

type display struct {
	data WeatherData
}

func (d *display) Update(data WeatherData) {
	d.data = data
	d.printInfo()
}

func (d *display) printInfo() {
	result := ""
	for _, field := range d.data.availableFields {
		result += fmt.Sprintf("%v: %v\n", d.data.data[field].GetDisplayName(), d.data.data[field].GetValue())
	}
	fmt.Println(result)
}
