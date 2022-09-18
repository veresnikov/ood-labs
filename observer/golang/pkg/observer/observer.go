package observer

import (
	"log"

	"github.com/veresnikov/ood-labs/observer/golang/pkg/utils"
)

type Observer[T comparable] interface {
	Update(data T)
}

type Observable[T comparable] interface {
	RegisterObserver(observer Observer[T], priority int)
	RemoveObserver(observer Observer[T])
	NotifyObservers()
}

func NewBaseObservable[T comparable](logger *log.Logger, getChangeData func() T) Observable[T] {
	return &baseObservable[T]{
		logger:         logger,
		observers:      make(map[int][]Observer[T]),
		getChangedData: getChangeData,
	}
}

type baseObservable[T comparable] struct {
	logger    *log.Logger
	observers map[int][]Observer[T]

	getChangedData func() T
}

func (base *baseObservable[T]) RegisterObserver(observer Observer[T], priority int) {
	for _, observers := range base.observers {
		_, err := utils.Find(observers, observer)
		if err == nil {
			base.logger.Println("observer already registered")
			return
		}
	}
	base.observers[priority] = append(base.observers[priority], observer)
}

func (base *baseObservable[T]) RemoveObserver(observer Observer[T]) {
	for priority, observers := range base.observers {
		updatedObservers, err := utils.Remove(observers, observer)
		if err == nil {
			base.observers[priority] = updatedObservers

			if len(base.observers[priority]) == 0 {
				delete(base.observers, priority)
			}
			return
		}
	}
	base.logger.Println("observer not registered")
}

func (base *baseObservable[T]) NotifyObservers() {
	data := base.getChangedData()
	availableObservers := base.observers
	for _, observers := range availableObservers {
		for _, observer := range observers {
			observer.Update(data)
		}
	}
}
