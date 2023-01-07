import {AbstractCommand} from "../../common/command/abstractCommand";
import {Shape} from "../shape/shape";

class DeleteShapeCommand extends AbstractCommand {
    private shapes: &Shape[]

    private removedShape: Shape

    private index: number = -1

    constructor(removedShape: Shape, shapes: &Shape[]) {
        super()
        this.shapes = shapes
        this.removedShape = removedShape
    }

    protected doExecute(): void {
        if (this.index === -1) {
            this.index = this.shapes.findIndex((shape) => {
                return this.removedShape === shape
            })
        }
        this.shapes.splice(this.index, 1)
    }

    protected doRollback(): void {
        this.shapes = [...this.shapes.slice(0, this.index - 1), this.removedShape, ...this.shapes.slice(this.index)]
    }
}

export {DeleteShapeCommand}
