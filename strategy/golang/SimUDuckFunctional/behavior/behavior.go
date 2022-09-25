package behavior

import "fmt"

type FlyBehavior func()

type QuackBehavior func()

type DanceBehavior func()

func FlyNoWay() FlyBehavior {
	return func() {}
}

func FlyWithStatistics() FlyBehavior {
	statistics := 0
	return func() {
		statistics++
		fmt.Println("I'm fly. My flight number: ", statistics)
	}
}

func FlyWithWings() FlyBehavior {
	return func() {
		fmt.Println("I'm fly.")
	}
}

func MuteQuack() QuackBehavior {
	return func() {}
}

func Quack() QuackBehavior {
	return func() {
		fmt.Println("Quack quack!!!")
	}
}

func Squeak() QuackBehavior {
	return func() {
		fmt.Println("Squeak squeak!!!")
	}
}

func Minuet() DanceBehavior {
	return func() {
		fmt.Println("Dance minuet")
	}
}

func Waltz() DanceBehavior {
	return func() {
		fmt.Println("Dance waltz")
	}
}

func NoDance() DanceBehavior {
	return func() {}
}
