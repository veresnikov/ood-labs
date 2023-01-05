import {CommandInterface} from "../command/command";

interface HistoryInterface {
    CanUndo(): boolean

    CanRedo(): boolean

    Undo(): void

    Redo(): void

    Execute(command: CommandInterface): void
}

class History implements HistoryInterface {
    private commands: CommandInterface[] = []
    private commandIndex: number = 0

    CanRedo(): boolean {
        return this.commandIndex < this.commands.length
    }

    CanUndo(): boolean {
        return this.commandIndex > 0
    }

    Execute(command: CommandInterface): void {
        command.Execute()
        this.commands = this.commands.slice(0, this.commandIndex)
        this.commands.push(command)
        ++this.commandIndex
    }

    Redo(): void {
        if (this.CanRedo()) {
            this.commands[this.commandIndex++].Execute()
        }
    }

    Undo(): void {
        if (this.CanUndo()) {
            this.commands[--this.commandIndex].Rollback()
        }
    }
}

export {History}
export type {HistoryInterface}
