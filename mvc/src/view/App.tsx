import {Observer} from "../common/observer/observer";
import {Editor, EditorViewData} from "../model/editor/editor";
import {Editor as EditorView} from "./components/editor/editor";
import ReactDOM from "react-dom/client";
import React from "react";
import {Controller} from "../controller/controller";
import {BuildControllerFunctions} from "./controller/controllerFunctions";

class EditorObserver extends Observer<EditorViewData> {
    private readonly callback: Function

    constructor(callback: Function) {
        super();
        this.callback = callback
    }

    Update(data: EditorViewData): void {
        this.callback(data)
    }
}

function App(root: ReactDOM.Root, editor: Editor, controller: Controller) {
    const renderFunc = (data: EditorViewData) => {
        root.render(
            <React.StrictMode>
                <EditorView data={data} controllerFunctions={BuildControllerFunctions(controller)} />
            </React.StrictMode>
        )
    }

    let observer = new EditorObserver(renderFunc)
    editor.RegisterObserver(observer)
}

export {App}