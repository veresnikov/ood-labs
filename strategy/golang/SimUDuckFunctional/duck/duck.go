package duck

import (
	"SimUDuckFunctional/behavior"
	"fmt"
)

type Duck interface {
	Quack()
	Fly()
	Dance()
	Swim()
	Display()
	SetFlyBehavior(fly behavior.FlyBehavior)
}

type baseDuck struct {
	quack behavior.QuackBehavior
	fly   behavior.FlyBehavior
	dance behavior.DanceBehavior
}

func (d baseDuck) Quack() {
	d.quack()
}

func (d baseDuck) Fly() {
	d.fly()
}

func (d baseDuck) Dance() {
	d.dance()
}

func (d baseDuck) Swim() {
	fmt.Println("I'm swimming!")
}

func (d *baseDuck) SetFlyBehavior(fly behavior.FlyBehavior) {
	if fly != nil {
		d.fly = fly
	}
}

func NewDecoyDuck() Duck {
	return &decoyDuck{baseDuck{
		quack: behavior.MuteQuack(),
		fly:   behavior.FlyNoWay(),
		dance: behavior.NoDance(),
	}}
}

type decoyDuck struct {
	baseDuck
}

func (d decoyDuck) Display() {
	fmt.Println("I'm decoy duck")
}

func NewMallardDuck() Duck {
	return &mallardDuck{baseDuck{
		quack: behavior.Quack(),
		fly:   behavior.FlyWithWings(),
		dance: behavior.Waltz(),
	}}
}

type mallardDuck struct {
	baseDuck
}

func (d mallardDuck) Display() {
	fmt.Println("I'm mallard duck")
}

func NewModelDuck() Duck {
	return &modelDuck{baseDuck{
		quack: behavior.Quack(),
		fly:   behavior.FlyNoWay(),
		dance: behavior.NoDance(),
	}}
}

type modelDuck struct {
	baseDuck
}

func (d modelDuck) Display() {
	fmt.Println("I'm model duck")
}

func NewRedheadDuck() Duck {
	return &redheadDuck{baseDuck{
		quack: behavior.Quack(),
		fly:   behavior.FlyWithWings(),
		dance: behavior.Minuet(),
	}}
}

type redheadDuck struct {
	baseDuck
}

func (d redheadDuck) Display() {
	fmt.Println("I'm redhead duck")
}

func NewRubberDuck() Duck {
	return &rubberDuck{baseDuck{
		quack: behavior.Squeak(),
		fly:   behavior.FlyNoWay(),
		dance: behavior.NoDance(),
	}}
}

type rubberDuck struct {
	baseDuck
}

func (d rubberDuck) Display() {
	fmt.Println("I'm rubber duck")
}
