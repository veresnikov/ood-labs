import {Controller} from "../../controller/controller";

interface ControllerFunctions {
    SelectShape(id: string): void

    CreateShape(type: string): void

    SetFillColor(color: string): void

    SetOutlineColor(color: string): void
}

function BuildControllerFunctions(controller: Controller): ControllerFunctions {
    return {
        CreateShape(type: string): void {
            controller.CreateShape(type)
        },
        SelectShape(id: string): void {
            controller.SelectShape(id)
        },
        SetFillColor(color: string): void {
            controller.SetFillColor(color)
        },
        SetOutlineColor(color: string): void {
            controller.SetOutlineColor(color)
        }
    }
}

export {BuildControllerFunctions}
export type {ControllerFunctions}