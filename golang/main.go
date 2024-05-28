package main

import (
	"fmt"
	"time"
)

func display(front [16][32]bool) {
    for y := 0; y < 16; y++ {
        for x := 0; x < 32; x++ {
            if front[y][x] {
                fmt.Printf("#");
            } else {
                fmt.Printf(".");
            }
        }
        fmt.Printf("\n");
    }
}

func mod(a int, b int) int {
    return (a % b + b) % b
}

func count_nbors(cx int, cy int, front [16][32]bool) int {
    nbors := 0
    for dx := -1; dx <= 1; dx++ {
        for dy := -1; dy <= 1; dy++ {
            if !(dx == 0 && dy == 0) {
                x := mod(cx + dx, 32)
                y := mod(cy + dy, 16)
                if front[y][x] {
                    nbors += 1
                }
            }
        }
    }
    return nbors
}

func next(back *[16][32]bool, front [16][32]bool) {
  for y := 0; y < 16; y++ {
        for x := 0; x < 32; x++ {
            nbors := count_nbors(x, y, front)
            if front[y][x] {
                back[y][x] = nbors == 2 || nbors == 3
            } else {
                back[y][x] = nbors == 3
            }
        }
    }
}

func main () {
    front := [16][32]bool{}
    back := [16][32]bool{}
    
    // Glider 1
    //   012
    // 0 .*.
    // 1 ..*
    // 2 ***

    front[0][1] = true
    front[1][2] = true
    front[2][0] = true
    front[2][1] = true
    front[2][2] = true

    for {
        display(front)
        next(&back, front)
        front = back

        time.Sleep(200 * time.Millisecond)

        fmt.Printf("\033[%dA\033[%dD", 16, 32)
    }
}
