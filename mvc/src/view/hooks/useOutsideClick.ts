import {RefObject, useEffect} from "react";

function useOutsideClick(
    ref: RefObject<Element>,
    selectFunc: () => void,
) {
    let firstClick = true
    useEffect(() => {
        document.addEventListener('click', mouseEventHandler)
        return () => {
            document.removeEventListener('click', mouseEventHandler)
        }
    })

    const mouseEventHandler = (event: MouseEvent) => {
        if (firstClick) {
            firstClick = false
            return
        }
        if (ref.current && !ref.current?.contains(event.target as Node)) {
            selectFunc()
        }
    }
}

export {useOutsideClick}