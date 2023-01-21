import {StateInterface} from "./StateInterface";
import {GumballMachineInterface} from "../GumballMachineInterface";

class SoldState implements StateInterface {
    private machine: GumballMachineInterface

    constructor(machine: GumballMachineInterface) {
        this.machine = machine
    }

    Dispense(): void {
        this.machine.ReleaseBall()
        if (this.machine.GetBallsCount() === 0) {
            console.log('Oops, there is no more gumballs in machine')
            this.machine.SetSoldOutState()
            return
        }
        this.machine.SetNoQuarterState()
    }

    EjectQuarter(): void {
        console.log('Sorry you already turned the crank')
    }

    InsertQuarter(): void {
        console.log('Please wait, we\'re already giving you a gumball')
    }

    ToString(): string {
        return 'delivering a gumball';
    }

    TurnCrank(): void {
        console.log('Turning twice doesn\'t get you another gumball')
    }

}

export {SoldState}