import {AbstractCommand} from "../command/abstractCommand";
import {History} from "./history";

class Target {
    public lastAction: string = "init"
}

class ConcreteCommand extends AbstractCommand {
    private readonly data: string
    private target: Target

    private previousData: string = ""

    constructor(data: string, target: Target) {
        super();
        this.data = data
        this.target = target
    }

    protected doExecute(): void {
        this.previousData = this.target.lastAction
        this.target.lastAction = this.data
    }

    protected doRollback(): void {
        this.target.lastAction = this.previousData
    }
}

describe("command history tests", () => {
    let target = new Target()
    let history = new History()

    beforeEach(() => {
        target = new Target()
        history = new History()
    })

    test("test execute command", () => {
        let c1 = new ConcreteCommand("first", target)
        history.Execute(c1)
        expect(target.lastAction).toEqual("first")
    })

    describe("test undo", () => {
        test("test can undo", () => {
            let c1 = new ConcreteCommand("first", target)
            expect(history.CanUndo()).toBeFalsy()
            history.Execute(c1)
            expect(history.CanUndo()).toBeTruthy()
        })

        test("test undo", () => {
            let c1 = new ConcreteCommand("first", target)
            history.Execute(c1)
            history.Undo()
            expect(target.lastAction).toEqual("init")
        })
    })

    describe("test redo", () => {
        test("test can redo", () => {
            let c1 = new ConcreteCommand("first", target)
            history.Execute(c1)
            expect(history.CanRedo()).toBeFalsy()
            history.Undo()
            expect(history.CanRedo()).toBeTruthy()
        })

        test("test redo", () => {
            let c1 = new ConcreteCommand("first", target)
            history.Execute(c1)
            history.Undo()
            expect(target.lastAction).toEqual("init")
            history.Redo()
            expect(target.lastAction).toEqual("first")
        })
    })

    test("test rewrite history", () => {
        let c1 = new ConcreteCommand("first", target)
        let c2 = new ConcreteCommand("two", target)
        let c3 = new ConcreteCommand("three", target)
        let c4 = new ConcreteCommand("four", target)
        history.Execute(c1)
        history.Execute(c2)
        history.Execute(c3)
        history.Execute(c4)
        expect(target.lastAction).toEqual("four")
        history.Undo()
        history.Undo()
        expect(target.lastAction).toEqual("two")
        expect(history.CanRedo()).toBeTruthy()
        let c5 = new ConcreteCommand("five", target)
        history.Execute(c5)
        expect(target.lastAction).toEqual("five")
        expect(history.CanRedo()).toBeFalsy()
        history.Undo()
        expect(target.lastAction).toEqual("two")
    })
})