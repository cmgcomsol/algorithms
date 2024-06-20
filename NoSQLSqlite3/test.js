//const mainMenuTemplate = require("./menutemplate.js").mainMenuTemplate;
const NoSQLBetterSqlite3 = require("./nosqlbettersqlite3.js").NoSQLBetterSqlite3

let db = new NoSQLBetterSqlite3("example.sqlite3")
console.log(db.getKeyList())

for (let i = 0; i < 1000; i++) {
	console.log("Setting...", 'a' + i, db.set('a' + i, Date.now().toString()))
}


for (let i = 0; i <= 1000; i++) {
	let x = Math.floor(Math.random() * (1000 - 0 + 1) + 0);
	console.log(db.get('a' + x))
}

console.log("all values")
console.log(db.getAllKeyValue())

console.log("Deleting...")
for (let i = 0; i < 1000; i++) {
	console.log("Deleting...", 'a' + i, db.del('a' + i))
}

