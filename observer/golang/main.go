package main

import (
	"fmt"
	"github.com/veresnikov/ood-labs/observer/golang/pkg/weatherstationduo"
	"github.com/veresnikov/ood-labs/observer/golang/pkg/weatherstationwithwind"
	"log"

	"github.com/veresnikov/ood-labs/observer/golang/pkg/weatherstation"
)

func main() {
	weatherStation()
	fmt.Println("------------------")
	weatherStationDuo()
	fmt.Println("------------------")
	weatherStationWithWind()
	fmt.Println("------------------")
}

func weatherStation() {
	logger := log.Default()

	station := weatherstation.NewWeatherStation()
	display := weatherstation.NewDisplay()
	statDisplay := weatherstation.NewStatisticsDisplay()

	logger.Println(station.RegisterObserver(display, 1))
	logger.Println(station.RegisterObserver(statDisplay, 1))
	station.SetMeasurements(2, 3, 3)
	station.SetMeasurements(4, 3, 3)
	station.SetMeasurements(-1, 3, 3)
}

func weatherStationDuo() {
	logger := log.Default()

	stationIn := weatherstationduo.NewWeatherStation(weatherstationduo.WeatherStationIn)
	stationOut := weatherstationduo.NewWeatherStation(weatherstationduo.WeatherStationOut)
	display := weatherstationduo.NewDisplay()
	statDisplay := weatherstationduo.NewStatisticsDisplay()
	logger.Println(stationIn.RegisterObserver(display, 1))
	logger.Println(stationOut.RegisterObserver(display, 1))
	logger.Println(stationIn.RegisterObserver(statDisplay, 2))
	logger.Println(stationOut.RegisterObserver(statDisplay, 2))

	stationIn.SetMeasurements(1, 1, 1)
	stationOut.SetMeasurements(-5, 5, 6)
}

func weatherStationWithWind() {
	logger := log.Default()

	station := weatherstationwithwind.NewWeatherStation()
	display := weatherstationwithwind.NewDisplay()
	statDisplay := weatherstationwithwind.NewStatisticsDisplay()
	logger.Println(station.RegisterObserver(display, 1))
	logger.Println(station.RegisterObserver(statDisplay, 1))

	station.SetMeasurements(1, 2, 3, 4, 5)
	station.SetMeasurements(2, 3, 4, 5, 6)
	station.SetMeasurements(3, 4, 5, 6, 7)
	station.SetMeasurements(4, 5, 6, 7, 8)
}
