import {AbstractCommand} from "../../common/command/abstractCommand";
import {Frame} from "../frame/frame";
import {Shape} from "../shape/shape";

class EditShapeFrameCommand extends AbstractCommand {
    private readonly oldFrame: Frame
    private readonly newFrame: Frame
    private shape: &Shape

    constructor(newFrame: Frame, shape: &Shape) {
        super();
        this.newFrame = newFrame
        this.oldFrame = shape.GetFrame()
        this.shape = shape
    }

    protected doExecute(): void {
        this.shape.SetFrame(this.newFrame)
    }

    protected doRollback(): void {
        this.shape.SetFrame(this.oldFrame)
    }
}

export {EditShapeFrameCommand}
