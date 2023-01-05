interface CommandInterface {
    Execute(): void

    Rollback(): void

}

abstract class AbstractCommand implements CommandInterface {
    private isCompleted: boolean = false

    Execute(): void {
        if (!this.isCompleted) {
            this.doExecute()
            this.isCompleted = true
        }
    }

    Rollback(): void {
        if (this.isCompleted) {
            this.doRollback()
            this.isCompleted = false
        }
    }

    protected abstract doExecute(): void

    protected abstract doRollback(): void
}

export {AbstractCommand}
export type {CommandInterface}
