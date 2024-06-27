//npm install --save node-7z-archive
//https://www.npmjs.com/package/node-7z-archive

import { createArchive, onlyArchive } from 'node-7z-archive';


createArchive("test1.7z", "c:/temp/1.pdf",).then(function () {
	console.log("Finished 1.pdf")

	onlyArchive("test1.7z", "./", "1.pdf").then(function () {
		console.log("Extracted 1.pdf")
	}).catch((err) => {
		console.log("Error: ", err)
	});

}).catch((err) => {
	console.log("Error: ", err)
});







//with password
createArchive("test2.7z", "c:/temp/2.pdf", { p: "1234567890", mx: "=9" }).then(function () {
	console.log("Finished encrypted 1.pdf")

	onlyArchive("test2.7z", "./", "2.pdf", { p: "1234567890" }).then(function () {
		console.log("Extracted decrypted 1.pdf")
	}).catch((err) => {
		console.log("Error: ", err)
	});

}).catch((err) => {
	console.log("Error: ", err)
});



