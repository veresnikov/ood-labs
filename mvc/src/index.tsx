import ReactDOM from 'react-dom/client';
import './index.css';
import reportWebVitals from './reportWebVitals';
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

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
