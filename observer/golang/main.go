package main

import (
	"log"

	"github.com/veresnikov/ood-labs/observer/golang/pkg/weatherstation"
)

func main() {
	logger := log.Default()

	station := weatherstation.NewWeatherStation(logger)
	display := weatherstation.NewDisplay()
	statDisplay := weatherstation.NewStatisticsDisplay()

	station.RegisterObserver(display)
	station.RegisterObserver(statDisplay)
	station.SetMeasurements(2, 3, 3)
	station.SetMeasurements(4, 3, 3)
	station.SetMeasurements(-1, 3, 3)
}
