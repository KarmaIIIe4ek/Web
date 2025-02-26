const matr = [];
let num = 1;
const rows = parseInt(prompt("Введите количество строк в матрице:"));
const columns = parseInt(prompt("Введите количество столбцов в матрице:"));
for (let i = 0; i < rows; i++) {
  const row = [];
  for (let j = 0; j < columns; j++) {
    row.push(
      parseInt(prompt("Введите значение элемента a[" + i + "][" + j + "]"))
    );
  }
  matr.push(row);
}
const n = parseInt(prompt("Введите строку:"));
const z = parseInt(prompt("Введи множитель:"));
const m = parseInt(prompt("Введи строку для суммирования:"));
for (let i = 0; i < columns; i++) {
  matr[m][i] += matr[n][i] * z;
}
let output = "";
for (let i = 0; i < rows; i++) {
  output += matr[i].join("\t") + "\n";
}
document.getElementById("myrezult").value = output;
output;