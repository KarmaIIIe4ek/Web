const matr = [];
const rows = parseInt(prompt("Введите количество строк в матрице:"));
const columns = parseInt(prompt("Введите количество столбцов в матрице:"));

// Создаем матрицу, где каждый элемент равен произведению номера строки на номер столбца
for (let i = 0; i < rows; i++) {
  const row = [];
  for (let j = 0; j < columns; j++) {
    row.push((i + 1) * (j + 1)); // Нумерация строк и столбцов начинается с 1
  }
  matr.push(row);
}

// Выводим исходную матрицу
let output = "Полученная матрица:\n";
for (let i = 0; i < rows; i++) {
  output += matr[i].join("\t") + "\n";
}

output;