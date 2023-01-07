abstract class Observable<Type> {
    private observers: Observer<Type>[] = []

    RegisterObserver(observer: Observer<Type>): void {
        let index = this.observers.findIndex((item) => {
            return item === observer
        })
        if (index === -1) {
            this.observers.push(observer)
            this.InitializeObserver(observer)
            return
        }
        throw new Error("observer already registered")
    }

    RemoveObserver(observer: Observer<Type>): void {
        let index = this.observers.findIndex((item) => {
            return item === observer
        })
        if (index === -1) {
            throw new Error("observer not found")
        }
        this.observers.splice(index, 1)
    }

    NotifyObserver(): void {
        const data = this.GetChangedData()
        this.observers.forEach((observer) => {
            observer.Update(data)
        })
    }

    private InitializeObserver(observer: Observer<Type>): void {
        const data = this.GetChangedData()
        observer.Update(data)
    }

    protected abstract GetChangedData(): Type;
}

abstract class Observer<Type> {
    abstract Update(data: Type): void;
}

export {Observable, Observer}