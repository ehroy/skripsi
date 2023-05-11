const fs = require("fs-extra");

const data = "etiket.pdf";
console.log(data);
var buf = Buffer.from(data, "base64");
console.log(buf);
fs.writeFile("result.pdf", buf, (error) => {
  if (error) {
    throw error;
  } else {
    console.log("buffer saved!");
    console.log(buf);
  }
});
