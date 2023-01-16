function Find<Type>(items: Type[], predicate: (item: Type) => boolean): Type | null {
    let index = items.findIndex(predicate)
    if (index !== -1) {
        return items[index]
    }
    return null
}

export {Find}