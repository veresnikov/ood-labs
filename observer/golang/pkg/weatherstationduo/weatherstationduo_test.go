package weatherstationduo

import (
	"log"
	"testing"
)

func TestAssertStandardDisplay(t *testing.T) {
	outStation := NewWeatherStation(log.Default(), WeatherStationOut)
	inStation := NewWeatherStation(log.Default(), WeatherStationIn)

	standardDisplay := &display{}

	outStation.RegisterObserver(standardDisplay, 1)
	inStation.RegisterObserver(standardDisplay, 1)

	outStation.SetMeasurements(-10, 20, 42)
	inStation.SetMeasurements(20, 55, 12)
	assertOutStation := standardDisplay.outStation.location == WeatherStationOut &&
		standardDisplay.outStation.temperature == -10 &&
		standardDisplay.outStation.humidity == 20 &&
		standardDisplay.outStation.pressure == 42
	assertInStation := standardDisplay.inStation.location == WeatherStationIn &&
		standardDisplay.inStation.temperature == 20 &&
		standardDisplay.inStation.humidity == 55 &&
		standardDisplay.inStation.pressure == 12

	if !(assertOutStation && assertInStation) {
		t.Error("data did not match")
	}
}

func TestAssertStatisticDisplay(t *testing.T) {
	outStation := NewWeatherStation(log.Default(), WeatherStationOut)
	inStation := NewWeatherStation(log.Default(), WeatherStationIn)

	inStatistic := &baseStatistic{typeStatistic: "temperature " + WeatherStationIn}
	outStatistic := &baseStatistic{typeStatistic: "temperature " + WeatherStationOut}
	statisticDisplay := &statisticsDisplay{
		temperatureStatisticIn:  inStatistic,
		temperatureStatisticOut: outStatistic,
	}

	outStation.RegisterObserver(statisticDisplay, 1)
	inStation.RegisterObserver(statisticDisplay, 1)

	inDataSet := []float32{10, 15, 20, 25, 30}
	outDataSet := []float32{-10, -15, -20, -25, -30}

	minOut := outDataSet[0]
	maxOut := outDataSet[0]
	accOut := float32(0)
	countAccOut := 0

	minIn := inDataSet[0]
	maxIn := inDataSet[0]
	accIn := float32(0)
	countAccIn := 0

	for i := 0; i < 5; i++ {
		outStation.SetMeasurements(outDataSet[i], 0, 0)
		inStation.SetMeasurements(inDataSet[i], 0, 0)
		if minOut > outDataSet[i] {
			minOut = outDataSet[i]
		}
		if maxOut < outDataSet[i] {
			maxOut = outDataSet[i]
		}
		accOut += outDataSet[i]
		countAccOut++

		if minIn > inDataSet[i] {
			minIn = inDataSet[i]
		}
		if maxIn < inDataSet[i] {
			maxIn = inDataSet[i]
		}
		accIn += inDataSet[i]
		countAccIn++

		assertOutData := *outStatistic.acc == accOut &&
			*outStatistic.min == minOut &&
			*outStatistic.max == maxOut &&
			outStatistic.countAcc == countAccOut

		assertInData := *inStatistic.acc == accIn &&
			*inStatistic.min == minIn &&
			*inStatistic.max == maxIn &&
			inStatistic.countAcc == countAccIn

		if !(assertOutData && assertInData) {
			t.Error("data did not match")
		}
	}
}
