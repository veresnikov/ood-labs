package utils

import (
	stderr "errors"
	"reflect"
)

var (
	errNotFound = stderr.New("item not found")
)

func Find[T any](slice []T, find T) (index int, err error) {
	for i := range slice {
		if reflect.DeepEqual(slice[i], find) {
			return i, nil
		}
	}
	return 0, errNotFound
}

func Remove[T any](slice []T, find T) ([]T, error) {
	index, err := Find(slice, find)
	if err != nil {
		return nil, err
	}
	return append(slice[:index], slice[index+1:]...), nil
}
