import {AbstractCommand} from "../../common/command/abstractCommand";
import {Shape} from "../shape/shape";
import {Frame} from "../frame/frame";

class EditFrameShapeCommand extends AbstractCommand {
    private readonly oldFrame: Frame

    private readonly newFrame: Frame

    private shape: &Shape

    constructor(newFrame: Frame, shape: &Shape) {
        super()
        this.oldFrame = shape.GetFrame()
        this.newFrame = newFrame
        this.shape = shape
    }

    protected doExecute(): void {
        this.shape.SetFrame(this.newFrame)
    }

    protected doRollback(): void {
        this.shape.SetFrame(this.oldFrame)
    }
}

export {EditFrameShapeCommand}
