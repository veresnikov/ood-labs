import ReactDOM from 'react-dom/client';
import './index.css';
import {Editor} from "./model/editor/editor";
import {History} from "./common/history/history";
import {App} from "./view/App";
import {Controller} from "./controller/controller";

let editor = new Editor(new History())
let controller = new Controller(editor)

const root = ReactDOM.createRoot(
    document.getElementById('root') as HTMLElement
);

App(root, editor, controller)
