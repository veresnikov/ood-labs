import {StateInterface} from "./StateInterface";
import {GumballMachineInterface} from "../GumballMachineInterface";

class SoldOutState implements StateInterface {
    private machine: GumballMachineInterface

    constructor(machine: GumballMachineInterface) {
        this.machine = machine
    }

    Dispense(): void {
        console.log('No gumball dispensed')
    }

    EjectQuarter(): void {
        console.log('You can\'t eject, you haven\'t inserted a quarter yet')
    }

    InsertQuarter(): void {
        console.log('You can\'t insert a quarter, the machine is sold out')
    }

    ToString(): string {
        return "Sold out";
    }

    TurnCrank(): void {
        console.log('You turned but there\'s no gumballs')
    }

}

export {SoldOutState}