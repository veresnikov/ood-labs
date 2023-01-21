import {StateInterface} from "./StateInterface";
import {GumballMachineInterface} from "../GumballMachineInterface";

class HasQuarterState implements StateInterface {
    private machine: GumballMachineInterface

    constructor(machine: GumballMachineInterface) {
        this.machine = machine
    }

    Dispense(): void {
        console.log('You need to insert a quarter first')
    }

    EjectQuarter(): void {
        console.log('Quarter ejected successfully')
        this.machine.SetNoQuarterState()
    }

    InsertQuarter(): void {
        console.log('You can\'t insert another one quarter')
    }

    ToString(): string {
        return 'waiting for turning the crank'
    }

    TurnCrank(): void {
        console.log('You turned the crank')
        this.machine.SetSoldState()
    }

}

export {HasQuarterState}