import {Editor} from "./editor";
import {History} from "../../common/history/history";
import {ShapeType} from "../shape/shapeType";
import {Ellipse} from "../shape/ellipse";
import {Triangle} from "../shape/triangle";
import {Rectangle} from "../shape/rectangle";

describe("editor model tests", () => {
    let editor = new Editor(new History())

    beforeEach(() => {
        editor = new Editor(new History())
    })

    describe("create shape tests", () => {
        test("create ellipse", () => {
            editor.CreateShape(ShapeType.Ellipse)
            expect(editor.GetShapes().length).toEqual(1)
            expect(editor.GetShapes()[0]).toBeInstanceOf(Ellipse)
        })
        test("create triangle", () => {
            editor.CreateShape(ShapeType.Triangle)
            expect(editor.GetShapes().length).toEqual(1)
            expect(editor.GetShapes()[0]).toBeInstanceOf(Triangle)
        })
        test("create rectangle", () => {
            editor.CreateShape(ShapeType.Rectangle)
            expect(editor.GetShapes().length).toEqual(1)
            expect(editor.GetShapes()[0]).toBeInstanceOf(Rectangle)
        })
        test("creating multiple shapes", () => {
            editor.CreateShape(ShapeType.Rectangle)
            editor.CreateShape(ShapeType.Ellipse)
            editor.CreateShape(ShapeType.Triangle)
            editor.CreateShape(ShapeType.Ellipse)
            expect(editor.GetShapes().length).toEqual(4)
        })
    })
})