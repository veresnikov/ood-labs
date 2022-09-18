package weatherstationduo

import (
	"log"

	"github.com/veresnikov/ood-labs/observer/golang/pkg/observer"
)

const (
	WeatherStationIn  = "in"
	WeatherStationOut = "out"
)

func NewWeatherStation(logger *log.Logger, location string) *Station {
	s := Station{logger: logger, location: location}
	s.Observable = observer.NewBaseObservable[WeatherData](s.logger, s.getChangedData)
	return &s
}

type WeatherData struct {
	sender      string
	temperature float32
	humidity    float32
	pressure    float32
}

type Station struct {
	observer.Observable[WeatherData]

	location string
	data     WeatherData
	logger   *log.Logger
}

func (s *Station) SetMeasurements(temperature float32, humidity float32, pressure float32) {
	s.data = WeatherData{
		sender:      s.location,
		temperature: temperature,
		humidity:    humidity,
		pressure:    pressure,
	}
	s.NotifyObservers()
}

func (s *Station) getChangedData() WeatherData {
	return s.data
}
