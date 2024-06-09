const fs = require('fs');
const sqlite3 = require('sqlite3').verbose();

class NoSQLSqlite3 {
	constructor(pathtofile) {
		if (fs.existsSync(pathtofile) === false) {
			this.db = new sqlite3.Database(pathtofile);
			this.db.run(`CREATE TABLE "tb" (
				"key"	BLOB,
				"value"	BLOB,
				PRIMARY KEY("key")
			) without rowid;`)
		} else {
			this.db = new sqlite3.Database(pathtofile);
		}

	}

	getKeyList(cb) {
		this.keylist = Array();
		this.db.all("select key from tb order by key", (err, data) => {
			/*console.log("start")
			console.log(err)
			console.log(data)
			console.log("exited")*/
			if (data != undefined) {
				for (let i = 0; i < data.length; i++) {
					this.keylist.push(data[i].key)
				}
			}

			cb(this.keylist);
		})

	}

	get(key, cb) {
		//console.log("inside get")

		if (this.keylist.indexOf(key) === -1) {
			cb(undefined)
			//console.log("not found in keylist")
			return
		}
		//console.log(this.keylist)
		let query = `select value from tb where key='${key}'`
		//console.log(query)
		this.db.get(query, (err, data) => {
			if (err === null) {
				//console.log(data)
				cb(data.value);
			} else {

				console.log("Error:", err);
			}
		})
	}

	set(key, value, cb) {
		//console.log(value)
		if (this.keylist.indexOf(key) !== -1) { //key existing
			let query = `update tb set value='${value}' where key='${key}'`
			//console.log(query)
			this.db.run(query, err => {
				console.log(key, value, "set", err)
				cb(err)
			})
		} else {	//key does not exist
			this.keylist.push(key)
			let query = `insert into tb values('${key}','${value}' )`
			//console.log(query)
			this.db.run(query, err => {
				console.log(key, value, "set", err)
				cb(err)
			})
		}
	}

	del(key, cb) {
		if (this.keylist.indexOf(key) !== -1) { //key existing
			let query = `delete from tb where key='${key}'`
			//console.log(query)
			this.db.run(query, err => {
				//console.log(key, value, "set", err)
				cb(err)
			})
		} else {	//key does not exist			
			cb(undefined)
		}
	}

}


exports.NoSQLSqlite3 = NoSQLSqlite3