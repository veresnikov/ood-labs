package weatherstationwithwind

import (
	"github.com/veresnikov/ood-labs/observer/golang/pkg/observer"
)

const (
	temperatureField   = "temperature"
	humidityField      = "humidity"
	pressureField      = "pressure"
	windSpeedField     = "windSpeed"
	windDirectionField = "windDirection"
)

func NewWeatherStation() *Station {
	s := Station{
		availableFields: []string{temperatureField, humidityField, pressureField, windSpeedField, windDirectionField},
	}
	s.Observable = observer.NewBaseObservable[WeatherData](s.getChangedData)
	return &s
}

type Field interface {
	GetDisplayName() string
	GetValue() interface{}
}

type field struct {
	name  string
	value interface{}
}

func (f field) GetDisplayName() string {
	return f.name
}

func (f field) GetValue() interface{} {
	return f.value
}

type WeatherData struct {
	availableFields []string
	data            map[string]Field
}

type Station struct {
	observer.Observable[WeatherData]

	availableFields []string
	data            WeatherData
}

func (s *Station) SetMeasurements(temperature, humidity, pressure, windSpeed float32, windDirection int) {
	s.data = WeatherData{
		availableFields: s.availableFields,
		data: map[string]Field{
			temperatureField: field{
				name:  fieldNameToDisplayNameMap[temperatureField],
				value: temperature,
			},
			humidityField: field{
				name:  fieldNameToDisplayNameMap[humidityField],
				value: humidity,
			},
			pressureField: field{
				name:  fieldNameToDisplayNameMap[pressureField],
				value: pressure,
			},
			windSpeedField: field{
				name:  fieldNameToDisplayNameMap[windSpeedField],
				value: windSpeed,
			},
			windDirectionField: field{
				name:  fieldNameToDisplayNameMap[windDirectionField],
				value: windDirection,
			},
		},
	}
	s.NotifyObservers()
}

func (s *Station) getChangedData() WeatherData {
	return s.data
}

var fieldNameToDisplayNameMap = map[string]string{
	temperatureField:   "temperature",
	humidityField:      "humidity",
	pressureField:      "pressure",
	windSpeedField:     "wind speed",
	windDirectionField: "wind direction",
}
