import {GumballMachine} from "../GumballMachine/GumballMachine";

const ExpectedState = (count: number, stateMessage: string) => {
    return 'Best C++ gumball Machine\n' +
        'Gumballs count: ' + count + '\n' +
        'Machine state: ' + stateMessage
}
describe("Gumball machine tests", () => {
    describe("sold out state tests", () => {
        let machine = new GumballMachine(0)

        beforeEach(() => {
            machine = new GumballMachine(0)
        })

        test("sold out state", () => {
            expect(machine.ToString()).toEqual(ExpectedState(0, "Sold out"))
        })

        test("try to insert quarter", () => {
            machine.InsertQuarter()
            expect(machine.ToString()).toEqual(ExpectedState(0, "Sold out"))
        })

        test("try to eject quarter", () => {
            machine.EjectQuarter()
            expect(machine.ToString()).toEqual(ExpectedState(0, "Sold out"))
        })

        test("try to turn crank", () => {
            machine.TurnCrank()
            expect(machine.ToString()).toEqual(ExpectedState(0, "Sold out"))
        })

        test("gumball machine with 1 gumball", () => {
            machine = new GumballMachine(1)
            expect(machine.ToString()).toEqual(ExpectedState(1, "Waiting for quarter"))

            machine.InsertQuarter()
            machine.TurnCrank()
            expect(machine.ToString()).toEqual(ExpectedState(0, "Sold out"))
        })
    })
    describe("has quarter state tests", () => {
        let machine = new GumballMachine(3)
        machine.InsertQuarter()

        beforeEach(() => {
            machine = new GumballMachine(3)
            machine.InsertQuarter()
        })

        test("has quarter state", () => {
            expect(machine.ToString()).toEqual(ExpectedState(3, "waiting for turning the crank"))
        })

        test("try to insert quarter", () => {
            machine.InsertQuarter()
            expect(machine.ToString()).toEqual(ExpectedState(3, "waiting for turning the crank"))
        })

        test("try to eject quarter", () => {
            machine.EjectQuarter()
            expect(machine.ToString()).toEqual(ExpectedState(3, "Waiting for quarter"))
        })

        test("try to turn crank", () => {
            machine.TurnCrank()
            expect(machine.ToString()).toEqual(ExpectedState(2, "Waiting for quarter"))
        })
    })
    describe("no quarter state tests", () => {
        let machine = new GumballMachine(3)

        beforeEach(() => {
            machine = new GumballMachine(3)
        })

        test("no quarter state", () => {
            expect(machine.ToString()).toEqual(ExpectedState(3, "Waiting for quarter"))
        })

        test("try to insert quarter", () => {
            machine.InsertQuarter()
            expect(machine.ToString()).toEqual(ExpectedState(3, "waiting for turning the crank"))
        })

        test("try to eject quarter", () => {
            machine.EjectQuarter()
            expect(machine.ToString()).toEqual(ExpectedState(3, "Waiting for quarter"))
        })

        test("try to turn crank", () => {
            machine.TurnCrank()
            expect(machine.ToString()).toEqual(ExpectedState(3, "Waiting for quarter"))
        })
    })
})

