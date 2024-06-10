const fs = require('fs');
const sqlite3 = require('better-sqlite3');

class NoSQLBetterSqlite3 {
	constructor(pathtofile) {
		if (fs.existsSync(pathtofile) === false) {
			this.db = new sqlite3(pathtofile, { verbose: console.log });//new sqlite3.Database(pathtofile);
			this.db.prepare(`CREATE TABLE "tb" (
				"key"	BLOB,
				"value"	BLOB,
				PRIMARY KEY("key")
			) without rowid;`).run()

		} else {
			this.db = new sqlite3(pathtofile);
		}

	}

	getKeyList() {
		this.keylist = Array();
		let list = this.db.prepare("select key from tb order by key").all();
		for (let i = 0; i < list.length; i++) {
			this.keylist.push(list[i].key)
		}
		return this.keylist
	}

	get(key) {
		//console.log("inside get")

		if (this.keylist.indexOf(key) === -1) {
			return undefined
		}
		//console.log(this.keylist)
		let query = `select value from tb where key='${key}'`
		//console.log(query)

		return this.db.prepare(query).get().value;
	}

	getJson(key) {
		return JSON.parse(this.get(key));
	}

	set(key, value) {
		if (typeof (value) !== "string") {
			throw new Error("Value Error: Value must be string type")
		}

		//console.log(value)
		if (this.keylist.indexOf(key) !== -1) { //key existing
			let query = `update tb set value='${value}' where key='${key}'`
			//console.log(query)
			return this.db.prepare(query).run()

		} else {	//key does not exist
			this.keylist.push(key)
			let query = `insert into tb values('${key}','${value}' )`
			//console.log(query)
			return this.db.prepare(query).run()
		}
	}

	del(key) {
		if (this.keylist.indexOf(key) !== -1) { //key existing
			let query = `delete from tb where key='${key}'`
			//console.log(query)
			return this.db.prepare(query).run()
		} else {	//key does not exist			
			return undefined
		}
	}

}


exports.NoSQLBetterSqlite3 = NoSQLBetterSqlite3