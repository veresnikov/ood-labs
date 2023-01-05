import {Observable, Observer} from "./observer";

interface Data {
    payload: string
}

class ConcreteObserver extends Observer<Data> {
    public data: string = ""

    Update(data: Data): void {
        this.data = data.payload
    }
}

class ConcreteObservable extends Observable<Data> {
    private data: Data = {payload: "default"}

    SetData(data: Data): void {
        this.data = data
        this.NotifyObserver()
    }

    GetChangedData(): Data {
        return this.data;
    }
}

describe("observer and observable tests", () => {
    let observable = new ConcreteObservable()
    let observer = new ConcreteObserver()

    beforeEach(() => {
        observable = new ConcreteObservable()
        observer = new ConcreteObserver()
    })

    test("test register observer", () => {
        observable.RegisterObserver(observer)
    })

    test("test register observer exception", () => {
        observable.RegisterObserver(observer)
        expect(() => {observable.RegisterObserver(observer)}).toThrow()
    })

    test("test remove observer", () => {
        observable.RegisterObserver(observer)
        observable.RemoveObserver(observer)
    })

    test("test remove observer exception", () => {
        expect(() => {observable.RemoveObserver(observer)}).toThrow()
    })

    test("notify observer", () => {
        observable.RegisterObserver(observer)
        expect(observer.data).toEqual("")
        observable.SetData({payload: "42"})
        expect(observer.data).toEqual("42")
    })
})
