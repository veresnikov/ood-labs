package observer

import (
	stderr "errors"
	"github.com/veresnikov/ood-labs/observer/golang/pkg/utils"
	"golang.org/x/exp/maps"
	"golang.org/x/exp/slices"
)

var (
	ErrObserverRegistered = stderr.New("observer already registered")
	ErrObserverNotFound   = stderr.New("observer not found")
)

type Observer[T any] interface {
	Update(data T)
}

type Observable[T any] interface {
	RegisterObserver(observer Observer[T], priority int) error
	RemoveObserver(observer Observer[T]) error
	NotifyObservers()
}

func NewBaseObservable[T any](getChangeData func() T) Observable[T] {
	return &baseObservable[T]{
		observers:      make(map[int][]Observer[T]),
		getChangedData: getChangeData,
	}
}

type baseObservable[T any] struct {
	observers           map[int][]Observer[T]
	availablePriorities []int
	getChangedData      func() T
}

func (base *baseObservable[T]) RegisterObserver(observer Observer[T], priority int) error {
	for _, observers := range base.observers {
		_, err := utils.Find(observers, observer)
		if err == nil {
			return ErrObserverRegistered
		}
	}
	base.observers[priority] = append(base.observers[priority], observer)
	base.updateAvailablePriorities()
	return nil
}

func (base *baseObservable[T]) RemoveObserver(observer Observer[T]) error {
	for priority, observers := range base.observers {
		updatedObservers, err := utils.Remove(observers, observer)
		if err == nil {
			base.observers[priority] = updatedObservers

			if len(base.observers[priority]) == 0 {
				delete(base.observers, priority)
			}
			base.updateAvailablePriorities()
			return nil
		}
	}
	return ErrObserverNotFound
}

func (base *baseObservable[T]) NotifyObservers() {
	data := base.getChangedData()
	availableObservers := base.observers
	for _, key := range base.availablePriorities {
		for _, observer := range availableObservers[key] {
			observer.Update(data)
		}
	}
}

func (base *baseObservable[T]) updateAvailablePriorities() {
	base.availablePriorities = maps.Keys(base.observers)
	slices.Sort(base.availablePriorities)
}
