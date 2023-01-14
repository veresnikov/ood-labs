import styles from "./historybutton.module.css"

interface HistoryButtonProps {
    actionName: string
    action: () => void
    isEnabled: boolean
}

function Historybutton(props: HistoryButtonProps) {
    return (
        <button
            className={styles.createshapebutton}
            onClick={props.action}
            disabled={!props.isEnabled}
        >
            {props.actionName}
        </button>
    )
}

export {Historybutton}
