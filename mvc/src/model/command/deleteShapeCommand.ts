import {AbstractCommand} from "../../common/command/abstractCommand";
import {Shape} from "../shape/shape";

class DeleteShapeCommand extends AbstractCommand {
    private shapes: &Shape[]

    private removedShape: Shape

    private selectShapeFunc: (shape: Shape | null) => void

    private index: number = -1

    constructor(removedShape: Shape, shapes: &Shape[], selectShapeFunc: (shape: Shape | null) => void) {
        super()
        this.shapes = shapes
        this.removedShape = removedShape
        this.selectShapeFunc = selectShapeFunc
    }

    protected doExecute(): void {
        if (this.index === -1) {
            this.index = this.shapes.findIndex((shape) => {
                return this.removedShape === shape
            })
        }
        this.shapes.splice(this.index, 1)
        this.selectShapeFunc(null)
    }

    protected doRollback(): void {
        this.shapes.splice(this.index, 0, this.removedShape)
        this.selectShapeFunc(this.removedShape)
    }
}

export {DeleteShapeCommand}
