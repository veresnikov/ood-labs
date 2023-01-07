import {Observable} from "../../common/observer/observer";
import {Shape} from "../shape/shape";
import {HistoryInterface} from "../../common/history/history";
import {CommandInterface} from "../../common/command/abstractCommand";
import {ShapeType} from "../shape/shapeType";
import {CreateShapeCommand} from "../command/createShapeCommand";

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

    public CreateShape(type: ShapeType): void {
        this.Execute(new CreateShapeCommand(type, this.shapes))
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
