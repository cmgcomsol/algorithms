class LDB {
	// The constructor initializes instance properties
	prefix = "";
	constructor(prefix = "LDB-") {
		this.prefix = prefix;

		console.log("LDB initialsed!!!");
	}

	set(key, value) {
		key = this.prefix + key

		if (typeof (value) !== "string") {
			value = JSON.stringify(value);
		}

		localStorage.setItem(key, value);
	}

	get(key) {
		key = this.prefix + key
		//console.log(key);
		return localStorage.getItem(key);
	}

	getJson(key) {
		key = this.prefix + key
		return JSON.parse(localStorage.getItem(key));

	}

	del(key) {
		key = this.prefix + key
		localStorage.removeItem(key);
	}

	clearAll() {
		// 1. Create a snapshot array of keys matching the prefix first
		const keysToDelete = Object.keys(localStorage).filter(key =>
			key.startsWith(this.prefix)
		);

		// 2. Safe to delete now without interrupting the iteration
		keysToDelete.forEach(key => {
			localStorage.removeItem(key);
		});
	}
}