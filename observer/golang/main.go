package main

import (
	"fmt"
	"github.com/veresnikov/ood-labs/observer/golang/pkg/weatherstationduo"
	"log"

	"github.com/veresnikov/ood-labs/observer/golang/pkg/weatherstation"
)

func main() {
	weatherStation()
	fmt.Println()
	weatherStationDuo()
}

func weatherStation() {
	logger := log.Default()

	station := weatherstation.NewWeatherStation(logger)
	display := weatherstation.NewDisplay()
	statDisplay := weatherstation.NewStatisticsDisplay()

	station.RegisterObserver(display, 1)
	station.RegisterObserver(statDisplay, 1)
	station.SetMeasurements(2, 3, 3)
	station.SetMeasurements(4, 3, 3)
	station.SetMeasurements(-1, 3, 3)
}

func weatherStationDuo() {
	logger := log.Default()

	stationIn := weatherstationduo.NewWeatherStation(logger, weatherstationduo.WeatherStationIn)
	stationOut := weatherstationduo.NewWeatherStation(logger, weatherstationduo.WeatherStationOut)
	display := weatherstationduo.NewDisplay()
	statDisplay := weatherstationduo.NewStatisticsDisplay()
	stationIn.RegisterObserver(display, 1)
	stationOut.RegisterObserver(display, 1)
	stationIn.RegisterObserver(statDisplay, 2)
	stationOut.RegisterObserver(statDisplay, 2)

	stationIn.SetMeasurements(1, 1, 1)
	stationOut.SetMeasurements(-5, 5, 6)
}
