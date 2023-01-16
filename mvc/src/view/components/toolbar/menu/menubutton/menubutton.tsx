interface ColorButtonProps {
    title: string
    action: () => void
}

function Menubutton(props: ColorButtonProps) {
    return (
        <button
            onClick={props.action}>
            {props.title}
        </button>
    )
}

export {Menubutton}
