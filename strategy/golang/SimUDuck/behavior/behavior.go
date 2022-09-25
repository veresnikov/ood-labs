package behavior

import "fmt"

type FlyBehavior interface {
	Fly()
}

type QuackBehavior interface {
	Quack()
}

type DanceBehavior interface {
	Dance()
}

type FlyNoWay struct{}

func (f FlyNoWay) Fly() {}

type FlyWithStatistics struct {
	statistics int
}

func (f *FlyWithStatistics) Fly() {
	f.statistics++
	fmt.Println("I'm fly. My flight number: ", f.statistics)
}

type FlyWithWings struct{}

func (f FlyWithWings) Fly() {
	fmt.Println("I'm fly.")
}

type MuteQuack struct{}

func (q MuteQuack) Quack() {}

type Quack struct{}

func (q Quack) Quack() {
	fmt.Println("Quack quack!!!")
}

type Squeak struct{}

func (s Squeak) Quack() {
	fmt.Println("Squeak squeak!!!")
}

type Minuet struct{}

func (d Minuet) Dance() {
	fmt.Println("Dance minuet")
}

type Waltz struct{}

func (d Waltz) Dance() {
	fmt.Println("Dance waltz")
}

type NoDance struct{}

func (d NoDance) Dance() {}
