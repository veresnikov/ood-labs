package weatherstationduo

import (
	"github.com/veresnikov/ood-labs/observer/golang/pkg/observer"
)

const (
	WeatherStationIn  = "in"
	WeatherStationOut = "out"
)

type Observer interface {
	observer.Observer[WeatherData]
	addStation(station *Station)
	removeStation(station *Station)
}

func NewWeatherStation(location string) *Station {
	s := Station{location: location}
	s.Observable = observer.NewBaseObservable[WeatherData](s.getChangedData)
	return &s
}

type WeatherData struct {
	sender      *Station
	temperature float32
	humidity    float32
	pressure    float32
}

type Station struct {
	observer.Observable[WeatherData]

	location string
	data     WeatherData
}

func (s *Station) RegisterObserver(observer Observer, priority int) error {
	err := s.Observable.RegisterObserver(observer, priority)
	if err != nil {
		return err
	}
	observer.addStation(s)
	return nil
}

func (s *Station) RemoveObserver(observer Observer) error {
	err := s.Observable.RemoveObserver(observer)
	if err != nil {
		return err
	}
	observer.removeStation(s)
	return nil
}

func (s *Station) SetMeasurements(temperature float32, humidity float32, pressure float32) {
	s.data = WeatherData{
		sender:      s,
		temperature: temperature,
		humidity:    humidity,
		pressure:    pressure,
	}
	s.NotifyObservers()
}

func (s *Station) getLocation() string {
	return s.location
}

func (s *Station) getChangedData() WeatherData {
	return s.data
}
