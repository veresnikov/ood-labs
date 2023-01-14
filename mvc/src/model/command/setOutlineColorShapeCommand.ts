import {AbstractCommand} from "../../common/command/abstractCommand";
import {Color} from "../../common/color/color";
import {Shape} from "../shape/shape";

class SetOutlineColorShapeCommand extends AbstractCommand {
    private readonly newColor: Color

    private readonly oldColor: Color

    private shape: &Shape

    constructor(newColor: Color, shape: &Shape) {
        super();
        this.newColor = newColor
        this.oldColor = shape.GetOutlineColor()
        this.shape = shape
    }

    protected doExecute(): void {
        this.shape.SetOutlineColor(this.newColor)
    }

    protected doRollback(): void {
        this.shape.SetOutlineColor(this.oldColor)
    }

}

export {SetOutlineColorShapeCommand}
