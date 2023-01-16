import {Find} from "../utils/find";

enum Color {
    Red = "#FF3333",
    Green = "#51FF33",
    Blue = "#33B8FF",
    Pink = "#FF3387",
    Yellow = "#FFFB33",
    Black = "#000000",
    White = "#FFFFFF",
}

function FindColorByValue(title: string): Color | null {
    let color = Find(Object.values(Color), (c: string) => {
        return c === title
    })
    return (color !== null) ? color as Color : null
}

export {Color, FindColorByValue}