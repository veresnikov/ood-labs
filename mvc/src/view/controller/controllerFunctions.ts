import {Controller} from "../../controller/controller";
import {Point} from "../../common/point/point";

interface ControllerFunctions {
    SelectShape(id: string| null): void

    CreateShape(type: string): void

    SetFillColor(color: string): void

    SetOutlineColor(color: string): void

    MoveShape(topLeft: Point): void

    ResizeShape(width: number, height: number): void

    Undo(): void

    CanUndo(): boolean

    Redo(): void

    CanRedo(): boolean
}

function BuildControllerFunctions(controller: Controller): ControllerFunctions {
    return {
        CreateShape(type: string): void {
            controller.CreateShape(type)
        },
        SelectShape(id: string | null): void {
            controller.SelectShape(id)
        },
        SetFillColor(color: string): void {
            controller.SetFillColor(color)
        },
        SetOutlineColor(color: string): void {
            controller.SetOutlineColor(color)
        },
        MoveShape(topLeft: Point) {
            controller.MoveShape(topLeft)
        },
        ResizeShape(width: number, height: number) {
            controller.ResizeShape(width, height)
        },
        Undo() {
            controller.Undo()
        },
        CanUndo() {
            return controller.CanUndo()
        },
        Redo() {
            controller.Redo()
        },
        CanRedo() {
            return controller.CanRedo()
        },
    }
}

export {BuildControllerFunctions}
export type {ControllerFunctions}