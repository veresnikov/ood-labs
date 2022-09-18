package observer

import (
	"bytes"
	"log"
	"strings"
	"testing"
)

func NewTestObservable(baseObservable *baseObservable[TestData]) *TestObservable {
	observable := TestObservable{}
	baseObservable.getChangedData = observable.getChangedData
	observable.Observable = baseObservable
	return &observable
}

type TestData struct {
	data string
}

type TestObservable struct {
	Observable[TestData]
	data TestData
}

func (o *TestObservable) SendData(data TestData) {
	o.data = data
	o.NotifyObservers()
}

func (o *TestObservable) getChangedData() TestData {
	return o.data
}

func NewTestObserver(callback func(data TestData)) Observer[TestData] {
	return &TestObserver{callback: callback}
}

type TestObserver struct {
	callback func(data TestData)
}

func (o *TestObserver) Update(data TestData) {
	o.callback(data)
}

func NewTestRemovableObserver(observable *TestObservable, callback func(data TestData)) Observer[TestData] {
	return &TestRemovableObserver{observable: observable, callback: callback}
}

type TestRemovableObserver struct {
	observable *TestObservable
	callback   func(data TestData)
}

func (o *TestRemovableObserver) Update(data TestData) {
	observer := Observer[TestData](o)
	o.observable.RemoveObserver(observer)
	o.callback(data)
}

func initialize() (*bytes.Buffer, *baseObservable[TestData], *TestObservable) {
	logger := log.Default()
	buffer := bytes.NewBufferString("")
	logger.SetOutput(buffer)
	baseObservable := &baseObservable[TestData]{logger: log.Default()}
	observable := NewTestObservable(baseObservable)
	return buffer, baseObservable, observable
}

func TestBaseObservable_RegisterObserver(t *testing.T) {
	_, baseObservable, observable := initialize()
	callback := func(data TestData) {}
	observer := NewTestObserver(callback)
	if len(baseObservable.observers) != 0 {
		t.Error("unexpected observers in base observable")
	}

	observable.RegisterObserver(observer)
	if len(baseObservable.observers) != 1 {
		t.Error("observer is not registered")
	}

	observable.RegisterObserver(observer)
	if len(baseObservable.observers) != 1 {
		t.Error("duplicated observer in base observable")
	}

	observer2 := NewTestObserver(callback)
	observable.RegisterObserver(observer2)
	if len(baseObservable.observers) != 2 {
		t.Error("observer is not registered")
	}
}

func TestBaseObservable_RemoveObserver(t *testing.T) {
	loggerBuffer, baseObservable, observable := initialize()
	callback := func(data TestData) {}
	observer := NewTestObserver(callback)

	observable.RemoveObserver(observer)
	if !strings.Contains(loggerBuffer.String(), "observer not registered") {
		t.Error("removing non-existent observer")
	}
	observable.RegisterObserver(observer)
	if len(baseObservable.observers) != 1 {
		t.Error("observer is not registered")
	}

	observer2 := NewTestObserver(callback)
	observable.RegisterObserver(observer2)
	if len(baseObservable.observers) != 2 {
		t.Error("observer is not registered")
	}

	observable.RemoveObserver(observer)
	if len(baseObservable.observers) != 1 {
		t.Error("observer is not deleted")
	}
}

func TestBaseObservable_NotifyObservers(t *testing.T) {
	_, baseObservable, observable := initialize()
	var returnedValue TestData
	callback := func(data TestData) { returnedValue = data }
	observer := NewTestObserver(callback)
	if len(baseObservable.observers) != 0 {
		t.Error("unexpected observers in base observable")
	}

	castedObserver := observer
	observable.RegisterObserver(castedObserver)
	if len(baseObservable.observers) != 1 {
		t.Error("observer is not registered")
	}
	testData := TestData{data: "some data"}
	observable.SendData(testData)
	if returnedValue != testData {
		t.Error("unexpected returned data")
	}
}

func TestBaseObservable_NotifyObserversWithRemovableObserver(t *testing.T) {
	_, baseObservable, observable := initialize()
	callback := func(data TestData) {}
	observer := NewTestRemovableObserver(observable, callback)
	if len(baseObservable.observers) != 0 {
		t.Error("unexpected observers in base observable")
	}

	observable.RegisterObserver(observer)
	if len(baseObservable.observers) != 1 {
		t.Error("observer is not registered")
	}

	observer2 := NewTestObserver(callback)
	observable.RegisterObserver(observer2)
	if len(baseObservable.observers) != 2 {
		t.Error("observer is not registered")
	}

	testData := TestData{data: "some data"}
	observable.SendData(testData)
	observable.RegisterObserver(observer2)
	if len(baseObservable.observers) != 1 {
		t.Error("observer is not deleted")
	}
}
