interface GumballMachineInterface {
    ReleaseBall(): void

    GetBallsCount(): number

    SetSoldOutState(): void

    SetNoQuarterState(): void

    SetSoldState(): void

    SetHasQuarterState(): void
}

export type {GumballMachineInterface}