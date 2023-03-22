import {Observable} from "../../common/observer/observer";
import {Shape} from "../shape/shape";
import {HistoryInterface} from "../../common/history/history";
import {CommandInterface} from "../../common/command/abstractCommand";
import {ShapeType} from "../shape/shapeType";
import {CreateShapeCommand} from "../command/createShapeCommand";
import {DeleteShapeCommand} from "../command/deleteShapeCommand";
import {EditShapeFrameCommand} from "../command/editShapeFrameCommand";
import {Point} from "../../common/point/point";
import {Color} from "../../common/color/color";
import {SetFillColorShapeCommand} from "../command/setFillColorShapeCommand";
import {SetOutlineColorShapeCommand} from "../command/setOutlineColorShapeCommand";

interface EditorViewData {
    selectedShape: Shape | null
    shapes: Shape[]
}

class Editor extends Observable<EditorViewData> {
    private shapes: Shape[] = []
    private selectedShape: Shape | null = null

    private history: HistoryInterface

    constructor(history: HistoryInterface) {
        super();
        this.history = history;
    }

    public SetOutlineColorShape(newColor: Color): void {
        if (this.selectedShape !== null) {
            this.Execute(new SetOutlineColorShapeCommand(newColor, this.selectedShape))
        }
    }

    public SetFillColorShape(newColor: Color): void {
        if (this.selectedShape !== null) {
            this.Execute(new SetFillColorShapeCommand(newColor, this.selectedShape))
        }
    }

    public SelectShape(shape: Shape | null): void {
        this.selectedShape = shape
        this.NotifyObserver()
    }

    public ResizeShape(newWidth: number, newHeight: number): void {
        if (this.selectedShape !== null) {
            let frame = this.selectedShape.GetFrame()
            frame.width = newWidth
            frame.height = newHeight
            this.Execute(new EditShapeFrameCommand(frame, this.selectedShape))
        }
    }

    public MoveShape(newTopLeft: Point): void {
        if (this.selectedShape !== null) {
            let frame = this.selectedShape.GetFrame()
            frame.topLeft = newTopLeft
            this.Execute(new EditShapeFrameCommand(frame, this.selectedShape))
        }
    }

    public DeleteShape(): void {
        if (this.selectedShape !== null) {
            this.Execute(new DeleteShapeCommand(this.selectedShape, this.shapes, (shape: Shape | null) => {
                this.SelectShape(shape)
            }))
        }
    }

    public CreateShape(type: ShapeType): void {
        this.Execute(new CreateShapeCommand(type, this.shapes, (shape: Shape) => {
            if (shape === this.selectedShape) {
                this.SelectShape(null)
            }
        }, (shape: Shape) => this.SelectShape(shape)))
    }

    public GetShapes(): Shape[] {
        return this.shapes
    }

    public CanRedo(): boolean {
        return this.history.CanRedo()
    }

    public CanUndo(): boolean {
        return this.history.CanUndo()
    }

    public Redo(): void {
        this.history.Redo()
        this.NotifyObserver()
    }

    public Undo(): void {
        this.history.Undo()
        this.NotifyObserver()
    }

    protected GetChangedData(): EditorViewData {
        return {
            selectedShape: this.selectedShape,
            shapes: this.shapes,
        };
    }

    private Execute(command: CommandInterface): void {
        this.history.Execute(command)
        this.NotifyObserver()
    }
}

export {Editor}
export type {EditorViewData}
