import styles from "./colorbutton.module.css"

interface ColorButtonProps {
    color: string
    setColor: (color: string) => void
}

function Colorbutton(props: ColorButtonProps) {
    const setColorFunc = () => {
        props.setColor(props.color)
    }
    return (
        <button
            className={styles.colorbutton}
            onClick={setColorFunc}
            style={{backgroundColor: props.color}}>
        </button>
    )
}

export {Colorbutton}