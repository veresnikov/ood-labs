import {Observer} from "../common/observer/observer";
import {Editor, EditorViewData} from "../model/editor/editor";
import {Editor as EditorView} from "./editor/editor";
import ReactDOM from "react-dom/client";
import React from "react";

class EditorObserver extends Observer<EditorViewData> {
    private readonly callback: Function

    constructor(callback: Function) {
        super();
        this.callback = callback
    }

    Update(data: EditorViewData | null): void {
        if (data === null) {
            data = {
                selectedShape: null,
                shapes: [],
            }
        }
        this.callback(data)
    }
}

function App(root: ReactDOM.Root, editor: Editor) {
    const renderFunc = (data: EditorViewData) => {
        root.render(
            <React.StrictMode>
                <EditorView selectedShape={data.selectedShape} shapes={data.shapes}></EditorView>
            </React.StrictMode>
        )
    }

    let observer = new EditorObserver(renderFunc)
    editor.RegisterObserver(observer)
}

export {App}