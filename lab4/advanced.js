var canvas = document.getElementById("drawingCanvas");
var ctx = canvas.getContext("2d");
ctx.clearRect(0, 0, 600, 600);
for (let i = 1; i <= 6; i++) {
  for (let j = 10; j >= 1; j--) {
    let numRectangles;
    if (i % 2 === 1) {
      numRectangles = 10;
    } else {
      numRectangles = 5;
    }
    if ((10 - j) < numRectangles) {
      if ((j - i % 2) % 2 === 1) {
        ctx.strokeStyle = "#8d6";
        ctx.fillStyle = "#8d6";
      }
      else {
        ctx.strokeStyle = "#44f";
        ctx.fillStyle = "#44f";
      }
      ctx.strokeRect(j * 50, i * 50, 20, 20);
      ctx.fillRect(j * 50, i * 50, 20, 20);
    }
  }
}