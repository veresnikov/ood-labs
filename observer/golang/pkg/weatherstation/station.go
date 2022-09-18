package weatherstation

import (
	"log"

	"github.com/veresnikov/ood-labs/observer/golang/pkg/observer"
)

func NewWeatherStation(logger *log.Logger) *Station {
	s := Station{logger: logger}
	s.Observable = observer.NewBaseObservable[WeatherData](s.logger, s.getChangedData)
	return &s
}

type WeatherData struct {
	temperature float32
	humidity    float32
	pressure    float32
}

type Station struct {
	observer.Observable[WeatherData]

	data   WeatherData
	logger *log.Logger
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
