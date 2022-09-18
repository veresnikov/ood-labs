package weatherstationduo

import (
	"fmt"
	"strings"

	"github.com/veresnikov/ood-labs/observer/golang/pkg/observer"
)

func newBaseStatistic(typeStatistic string) statisticInfo {
	return &baseStatistic{typeStatistic: typeStatistic}
}

type statisticInfo interface {
	String() string
	Update(data float32)
}

type baseStatistic struct {
	typeStatistic string
	min           *float32
	max           *float32
	acc           *float32
	countAcc      int
}

func (s *baseStatistic) String() string {
	str := "Max {type}: %v\nMin {type}: %v\nAvg {type}: %v\n"
	str = strings.ReplaceAll(str, "{type}", s.typeStatistic)
	return fmt.Sprintf(str,
		*s.max,
		*s.min,
		*s.acc/float32(s.countAcc),
	)
}

func (s *baseStatistic) Update(data float32) {
	if s.min == nil {
		min := data
		s.min = &min
	} else {
		if *s.min > data {
			*s.min = data
		}
	}
	if s.max == nil {
		max := data
		s.max = &max
	} else {
		if *s.max < data {
			*s.max = data
		}
	}
	if s.acc == nil {
		accTemperature := data
		s.acc = &accTemperature
	} else {
		*s.acc += data
	}
	s.countAcc++
}

func NewStatisticsDisplay() observer.Observer[WeatherData] {
	return &statisticsDisplay{
		temperatureStatisticIn:  newBaseStatistic("temperature " + WeatherStationIn),
		temperatureStatisticOut: newBaseStatistic("temperature " + WeatherStationOut),
	}
}

type statisticsDisplay struct {
	temperatureStatisticIn  statisticInfo
	temperatureStatisticOut statisticInfo
}

func (d *statisticsDisplay) Update(data WeatherData) {
	switch data.sender {
	case WeatherStationIn:
		d.temperatureStatisticIn.Update(data.temperature)
		d.printInfo(d.temperatureStatisticIn)
		break
	case WeatherStationOut:
		d.temperatureStatisticOut.Update(data.temperature)
		d.printInfo(d.temperatureStatisticOut)
		break
	}
}

func (d *statisticsDisplay) printInfo(info statisticInfo) {
	fmt.Print("Statistics display\n", info)
}
