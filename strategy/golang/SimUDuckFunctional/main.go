package main

import (
	"SimUDuckFunctional/behavior"
	"SimUDuckFunctional/duck"
	"fmt"
)

func main() {
	mallardDuck := duck.NewMallardDuck()
	redheadDuck := duck.NewRedheadDuck()
	decoyDuck := duck.NewDecoyDuck()
	rubberDuck := duck.NewRubberDuck()
	modelDuck := duck.NewModelDuck()

	PlayWithDuck(mallardDuck)
	PlayWithDuck(redheadDuck)
	PlayWithDuck(decoyDuck)
	PlayWithDuck(rubberDuck)
	PlayWithDuck(modelDuck)
	modelDuck.SetFlyBehavior(behavior.FlyWithWings())
	PlayWithDuck(modelDuck)

	flyWithStatistics := behavior.FlyWithStatistics()
	mallardDuck.SetFlyBehavior(flyWithStatistics)
	modelDuck.SetFlyBehavior(flyWithStatistics)
	redheadDuck.SetFlyBehavior(flyWithStatistics)

	PlayWithDuck(mallardDuck)
	PlayWithDuck(redheadDuck)
	PlayWithDuck(redheadDuck)
	PlayWithDuck(modelDuck)
}

func PlayWithDuck(duck duck.Duck) {
	duck.Display()
	duck.Fly()
	duck.Quack()
	duck.Swim()
	duck.Dance()
	fmt.Println()
}
