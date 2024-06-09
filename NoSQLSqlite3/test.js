//const mainMenuTemplate = require("./menutemplate.js").mainMenuTemplate;
const NoSQLSqlite3 = require("./nosqlsqlite3.js").NoSQLSqlite3

let db = new NoSQLSqlite3("example.sqlite3")
db.getKeyList(list => {
	console.log(list)
	db.set("b", Date.now(), (err) => {
		if (err !== null) {
			db.get('b', (value => {
				if (value !== undefined)
					console.log(value);
			}))
		} else {
			console.log(err)
		}
	})

	/*for (let i = 0; i < 1000; i++) {
		db.set('a' + i, Date.now(), err => {
			console.log("completed value key", 'a' + i)
		})

	}*/

	/*for (let i = 0; i <= 1000; i++) {
		let x = Math.floor(Math.random() * (1000 - 0 + 1) + 0);
		db.get('a' + x, value => {
			console.log(i, 'a' + x, value)
		})
	}*/

	console.log("Deleting...")
	for (let i = 0; i < 1000; i++) {
		db.del('a' + i, err => {
			console.log('a' + i, err)
		})
	}
})

