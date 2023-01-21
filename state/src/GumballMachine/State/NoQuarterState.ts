import {StateInterface} from "./StateInterface";
import {GumballMachineInterface} from "../GumballMachineInterface";

class NoQuarterState implements StateInterface {
    private machine: GumballMachineInterface

    constructor(machine: GumballMachineInterface) {
        this.machine = machine
    }

    Dispense(): void {
        console.log('You need to insert a quarter first')
    }

    EjectQuarter(): void {
        console.log('You haven\'t inserted a quarter for ejection')
    }

    InsertQuarter(): void {
        console.log('You inserted a quarter')
        this.machine.SetHasQuarterState()
    }

    ToString(): string {
        return "Waiting for quarter";
    }

    TurnCrank(): void {
        console.log('You need to insert a quarter first but not turning')
    }

}

export {NoQuarterState}