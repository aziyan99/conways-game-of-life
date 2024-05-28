const ROWS = 16;
const COLS = 8;

/**
 * @param {number} cols
 * @param {number} rows
 *
 * @returns {Array} y_array
 */
function build_array(cols, rows)
{
    let y_array = [];
    for (let y = 0; y < rows; y++) {
        let x_array = [];
        for (let x = 0; x < cols; x++) {
            x_array.push(false);
        }
        y_array.push(x_array);
    }
    return y_array;
}

let front = build_array(COLS, ROWS);
let back = build_array(COLS, ROWS);

function display()
{
    for (let y = 0; y < COLS; y++) {
        for (let x = 0; x < ROWS; x++) {
            if (front[y][x]) {
                process.stdout.write("#");
            } else {
                process.stdout.write(".");
            }
        }
        process.stdout.write("\n");
    }
}

function mod(a, b)
{
    return (a % b + b) % b;    
}

function count_nbors(cx, cy)
{
    let nbors = 0;
    for (let dx = -1; dx <= 1; dx++) {
        for (let dy = -1; dy <= 1; dy++) {
            let x = mod(cx + dx, COLS); 
            let y = mod(cy + dy, ROWS);
            if (front[x][y]) {
                nbors += 1;
            }
        }
    } 
    return nbors;
}

function next()
{
  for (let y = 0; y < COLS; y++) {
        for (let x = 0; x < ROWS; x++) {
            let nbors = count_nbors(x, y);
            if (front[x][y]) {
                back[y][x] = nbors == 3 || nbors == 2;
            } else {
                back[y][x] = nbors == 3;
            }
        }
    }
}

function main()
{

    for(;;){
        display(); 
        next();

        process.stdout.write(`${"\033[" + ROWS +"A"}${"\033[" + COLS +"D"}`);

        for (let i = 0; i < 1000000; i++) {}
    }

}

main();
