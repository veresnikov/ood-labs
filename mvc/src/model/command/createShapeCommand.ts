import {AbstractCommand} from "../../common/command/abstractCommand";
import {ShapeFactory} from "../shape/shapeFactory";
import {Shape} from "../shape/shape";
import {ShapeType} from "../shape/shapeType";

class CreateShapeCommand extends AbstractCommand {
    private readonly type: ShapeType

    private shapes: &Shape[]

    private newShape: Shape | null = null

    constructor(type: ShapeType, shapes: &Shape[]) {
        super()
        this.type = type
        this.shapes = shapes
    }

    protected doExecute(): void {
        if (this.newShape === null) {
            this.newShape = ShapeFactory.CreateShape(this.type)
        }
        this.shapes.push(this.newShape)
    }

    protected doRollback(): void {
        this.shapes.pop()
    }
}

export {CreateShapeCommand}
