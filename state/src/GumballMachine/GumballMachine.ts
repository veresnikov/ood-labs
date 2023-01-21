import {GumballMachineInterface} from "./GumballMachineInterface";
import {StateInterface} from "./State/StateInterface";
import {HasQuarterState} from "./State/HasQuarterState";
import {NoQuarterState} from "./State/NoQuarterState";
import {SoldOutState} from "./State/SoldOutState";
import {SoldState} from "./State/SoldState";

class GumballMachine implements GumballMachineInterface {

    private hasQuarterState: HasQuarterState
    private noQuarterState: NoQuarterState
    private soldOutState: SoldOutState
    private soldState: SoldState
    private state: StateInterface

    private gumballsCount: number

    constructor(gumballsCount: number) {
        this.gumballsCount = gumballsCount
        this.hasQuarterState = new HasQuarterState(this)
        this.noQuarterState = new NoQuarterState(this)
        this.soldOutState = new SoldOutState(this)
        this.soldState = new SoldState(this)

        if (this.gumballsCount > 0) {
            this.state = this.noQuarterState
        } else {
            this.state = this.soldOutState
        }
    }

    EjectQuarter(): void {
        this.state.EjectQuarter()
    }

    InsertQuarter(): void {
        this.state.InsertQuarter()
    }

    TurnCrank(): void {
        this.state.TurnCrank()
        this.state.Dispense()
    }

    ToString(): string {
        return 'Best C++ gumball Machine\n' +
            'Gumballs count: ' + this.gumballsCount + '\n' +
            'Machine state: ' + this.state.ToString()
    }

    GetBallsCount(): number {
        return this.gumballsCount;
    }

    ReleaseBall(): void {
        if (this.gumballsCount === 0) {
            return
        }
        console.log("A gumball comes rolling out the slot")
        this.gumballsCount--
    }

    SetHasQuarterState(): void {
        this.state = this.hasQuarterState
    }

    SetNoQuarterState(): void {
        this.state = this.noQuarterState
    }

    SetSoldOutState(): void {
        this.state = this.soldOutState
    }

    SetSoldState(): void {
        this.state = this.soldState
    }

}

export {GumballMachine}