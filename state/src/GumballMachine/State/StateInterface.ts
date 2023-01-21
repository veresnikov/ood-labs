interface StateInterface {
    InsertQuarter(): void

    EjectQuarter(): void

    TurnCrank(): void

    Dispense(): void

    ToString(): string
}

export type {StateInterface}