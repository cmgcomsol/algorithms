import os
import sqlite3
import time
import json


class NoSQLSqlite3:
	def __init__(self, pathtosqlite3):
		# test for pathtosqlite3 exists and if not create it
		if os.path.isfile(pathtosqlite3) == False:
			# print("DB does not exist", pathtosqlite3)
			self.conn = sqlite3.connect(pathtosqlite3)
			self.cur = self.conn.cursor()
			self.cur.execute("""
			CREATE TABLE "tb" (
				"key"	BLOB,
				"value"	BLOB,
				PRIMARY KEY("key")
			) without rowid;
			""");
			self.conn.commit()

		else:
			# print("DB exists", pathtosqlite3)
			self.conn = sqlite3.connect(pathtosqlite3)
			self.cur = self.conn.cursor()

		self.keylist = self.getKeyList()

	# print(self.keylist)

	def getKeyList(self):
		res = self.cur.execute("select key from  tb order by key")
		keys = []
		res = res.fetchall()
		for rec in res:
			# print(rec)
			keys.append(rec[0])
		# print(keys)
		return keys[:]

	def get(self, key):
		key = str(key)
		assert type(key) == str, "Key must be string"

		if key not in self.keylist:
			return None

		res = self.cur.execute("select value from  tb where key='%s'" % key)

		rec = res.fetchone()
		# print(rec[0])
		return rec[0]

	def getJson(self, key):
		return json.loads(self.getJson(key))

	def set(self, key, value):
		key = str(key)
		assert type(value) == str, "Value must be string"

		# print(key)
		if key not in self.keylist:  # insert
			query = "insert into tb values('%s','%s')" % (key, value)
			# print(query)
			self.cur.execute(query)
			self.keylist.append(key)
		else:  # update
			query = "update tb set value='%s' where key='%s'" % (value, key)
			# print(query)
			self.cur.execute(query)

		self.conn.commit()

	def setInsertMany(self, keyvaluelist):
		query = "insert into tb values(?,?)"
		retvalue = self.cur.executemany(query, keyvaluelist)
		self.keylist = self.getKeyList()
		self.conn.commit()
		return retvalue

	def setUpdateMany(self, valuekeylist):
		query = "update tb set value=? where key=?"
		retvalue = self.cur.executemany(query, valuekeylist)
		self.keylist = self.getKeyList()
		self.conn.commit()
		return retvalue

	def remove(self, key):
		key = str(key)
		assert type(key) == str, "Key must be string"

		if key not in self.keylist:
			return

		query = "delete from  tb where key='%s'" % key
		# print(query)
		self.cur.execute(query)
		self.conn.commit()
		self.keylist = self.getKeyList()

	def removeMany(self, keylist):
		query = "delete from tb where key=?"
		retvalue = self.cur.executemany(query, keylist)
		self.keylist = self.getKeyList()
		self.conn.commit()
		return retvalue


# example
if __name__ == "__main__":
	nosql = NoSQLSqlite3("example.sqlite3")
	print(nosql.keylist)
	nosql.set('a', str(time.time()))
	print(nosql.get('a'))
	nosql.remove('a')
	print(nosql.keylist)
	x = 10
	print("setting values", x)
	start = time.time()
	for i in range(1, x):
		nosql.set("a%s" % i, str(time.time()))
	end = time.time()
	print("Total time to write %s records" % x, end - start)
	print("reading values")
	for i in range(1, x):
		print(i, nosql.get("a%s" % i))

	for i in range(1, x):
		print("removing", "a%s" % i, nosql.remove("a%s" % i))

	start = time.time()
	##insert many test
	max = 10000000
	print("Starting insert many test")
	tmplist = []
	for i in range(max):
		tmplist.append(['x%s' % i, str(time.time())])

	print(nosql.setInsertMany(tmplist))

	# for i in nosql.keylist:
	#	print(i, nosql.get(i))
	end = time.time()
	print("Total time to write %s records" % max, int(round(end - start)))

	start = time.time()
	##update many test
	print("Starting udpate many test")
	tmplist = []
	for i in range(max):
		tmplist.append([str(time.time()), 'x%s' % i])

	print(nosql.setUpdateMany(tmplist))

	# for i in nosql.keylist:
	#	print(i, nosql.get(i))
	end = time.time()
	print("Total time to write %s records" % max, int(round(end - start)))

	start = time.time()
	##remove many test
	print("Starting remove many test")
	tmplist = []
	for i in range(max):
		tmplist.append(['x%s' % i, ])

	print(nosql.removeMany(tmplist))
	end = time.time()
	print("Total time to write %s records" % max, int(round(end - start)))
