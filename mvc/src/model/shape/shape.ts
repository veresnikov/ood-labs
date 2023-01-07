import {Color} from "../../common/color/color";
import {DefaultValues} from "../../defaultValues";
import {Frame} from "../frame/frame";
import {ShapeType} from "./shapeType";

abstract class Shape {
    private readonly id: string
    private fillColor: Color = DefaultValues.fillColor
    private outlineColor: Color = DefaultValues.outlineColor
    private outlineThickness: number = DefaultValues.outlineThickness

    protected constructor(id: string, fillColor: Color | null, outlineColor: Color | null, outlineThickness: number | null) {
        this.id = id
        if (fillColor !== null) {
            this.SetFillColor(fillColor)
        }
        if (outlineColor !== null) {
            this.SetOutlineColor(outlineColor)
        }
        if (outlineThickness !== null) {
            this.SetOutlineThickness(outlineThickness)
        }
    }

    GetFillColor(): Color {
        return this.fillColor
    }

    GetOutlineColor(): Color {
        return this.outlineColor
    }

    GetOutlineThickness(): number {
        return this.outlineThickness
    }

    GetID(): string {
        return this.id
    }

    SetFillColor(fillColor: Color): void {
        this.fillColor = fillColor
    }

    SetOutlineColor(outlineColor: Color): void {
        this.outlineColor = outlineColor
    }

    SetOutlineThickness(outlineThickness: number): void {
        this.outlineThickness = outlineThickness
    }

    abstract GetFrame(): Frame

    abstract SetFrame(frame: Frame): void

    abstract GetType(): ShapeType
}

export {Shape}