import {ControllerFunctions} from "../controller/controllerFunctions";
import {useCallback, useEffect} from "react";

function useHotKey(controller: ControllerFunctions) {
    const hotKeyHandler = useCallback((event: KeyboardEvent) => {
        if (event.code === 'Delete') {
            controller.DeleteShape()
            return
        }
        if (event.ctrlKey) {
            switch (event.code) {
                case 'KeyZ':
                    controller.Undo()
                    return;
                case 'KeyY':
                    controller.Redo()
                    return;
            }
        }
    }, [controller])

    useEffect(() => {
        document.addEventListener('keypress', hotKeyHandler)
        return () => {
            document.removeEventListener('keypress', hotKeyHandler)
        }
    }, [hotKeyHandler])
}

export {useHotKey}