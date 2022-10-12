let j = 0;
while ((j = 0)) {
  j = j - 1;
  console.log("hello");
  j = j + 1;
}
function PrinterFunction(inputCounter) {
  console.log("hello");
  inputCounter = inputCounter + 1;
  return inputCounter;
}

function ImCalling(noOfTimesToCall) {
  let x = 1;

  while (x < noOfTimesToCall) {
    x = PrinterFunction(x);
  }
}

ImCalling(4);
