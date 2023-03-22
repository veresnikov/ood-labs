import {AbstractCommand} from "../../common/command/abstractCommand";
import {ShapeFactory} from "../shape/shapeFactory";
import {Shape} from "../shape/shape";
import {ShapeType} from "../shape/shapeType";

class CreateShapeCommand extends AbstractCommand {
    private readonly type: ShapeType

    private shapes: &Shape[]
    private newShape: Shape | null = null
    private unselectCallback: (shape: Shape) => void

    private selectCallback: (shape: Shape) => void

    constructor(type: ShapeType, shapes: &Shape[], unselectCallback: (shape: Shape) => void, selectCallback: (shape: Shape) => void) {
        super()
        this.type = type
        this.shapes = shapes
        this.unselectCallback = unselectCallback
        this.selectCallback = selectCallback
    }

    protected doExecute(): void {
        if (this.newShape === null) {
            this.newShape = ShapeFactory.CreateShape(this.type)

            if (this.type === ShapeType.Polyline) {
                this.selectCallback(this.newShape)
            }
        }
        this.shapes.push(this.newShape)
    }

    protected doRollback(): void {
        this.shapes.pop()
        this.newShape !== null && this.unselectCallback(this.newShape)
    }
}

export {CreateShapeCommand}
