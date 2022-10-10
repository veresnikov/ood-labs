package weatherstation

import (
	"github.com/veresnikov/ood-labs/observer/golang/pkg/observer"
)

func NewWeatherStation() *Station {
	s := Station{}
	s.Observable = observer.NewBaseObservable[WeatherData](s.getChangedData)
	return &s
}

type WeatherData struct {
	temperature float32
	humidity    float32
	pressure    float32
}

type Station struct {
	observer.Observable[WeatherData]

	data WeatherData
}

func (s *Station) SetMeasurements(temperature float32, humidity float32, pressure float32) {
	s.data = WeatherData{
		temperature: temperature,
		humidity:    humidity,
		pressure:    pressure,
	}
	s.NotifyObservers()
}

func (s *Station) getChangedData() WeatherData {
	return s.data
}
