package weatherstationduo

import (
	"fmt"
	"strings"
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

func NewStatisticsDisplay() Observer {
	return &statisticsDisplay{
		data: make(map[*Station]statisticInfo),
	}
}

type statisticsDisplay struct {
	data map[*Station]statisticInfo
}

func (d *statisticsDisplay) addStation(station *Station) {
	d.data[station] = newBaseStatistic("temperature")
}

func (d *statisticsDisplay) removeStation(station *Station) {
	delete(d.data, station)
}

func (d *statisticsDisplay) Update(payload WeatherData) {
	statistic, ok := d.data[payload.sender]
	if ok {
		statistic.Update(payload.temperature)
		d.data[payload.sender] = statistic
		d.printInfo(statistic)
	}
}

func (d *statisticsDisplay) printInfo(info statisticInfo) {
	fmt.Print("Statistics display\n", info)
}
