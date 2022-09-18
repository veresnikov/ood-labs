package observer

import (
	"log"

	"github.com/veresnikov/ood-labs/observer/golang/pkg/utils"
)

type Observer[T comparable] interface {
	Update(data T)
}

type Observable[T comparable] interface {
	RegisterObserver(observer Observer[T])
	RemoveObserver(observer Observer[T])
	NotifyObservers()
}

func NewBaseObservable[T comparable](logger *log.Logger, getChangeData func() T) Observable[T] {
	return &baseObservable[T]{
		logger:         logger,
		getChangedData: getChangeData,
	}
}

type baseObservable[T comparable] struct {
	logger    *log.Logger
	observers []Observer[T]

	getChangedData func() T
}

func (base *baseObservable[T]) RegisterObserver(observer Observer[T]) {
	_, err := utils.Find(base.observers, observer)
	if err == nil {
		base.logger.Println("observer already registered")
		return
	}
	base.observers = append(base.observers, observer)
}

func (base *baseObservable[T]) RemoveObserver(observer Observer[T]) {
	observers, err := utils.Remove(base.observers, observer)
	if err != nil {
		base.logger.Println("observer not registered")
		return
	}
	base.observers = observers
}

func (base *baseObservable[T]) NotifyObservers() {
	data := base.getChangedData()
	availableObservers := base.observers
	for _, observer := range availableObservers {
		observer.Update(data)
	}
}
