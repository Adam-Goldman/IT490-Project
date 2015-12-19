#!/usr/bin/python
# -*- coding: utf-8 -*-

import MySQLdb as mdb
from pymongo import MongoClient
from passlib.hash import sha512_crypt

class MongoThing:
	
	
	def __init__(self):
		site = "mongodb://testadmin:12adam12@ds041633.mongolab.com:41633/it420"
		self.client = MongoClient(site)
	def auth(self, data): #Needs 1 array with two elements: 0 = username  1 = password
		con = mdb.connect(host='localhost', user='adam', passwd='12adam12', db='IT490')
		query = "select password from users where user_name = \"%s\"" % data[0]
		
		try:
			cur = con.cursor()
			cur.execute(query)
			pwd = cur.fetchall()
			result = sha512_crypt.verify(data[1],pwd[0][0])
		except: 
			print "Error: unable to fetch data"
			return False

		con.close();
		return result

	def regi(self,data): #Needs 1 array with 3 elements: 0 = username  1 = password  2 = powerlevel
		passy = sha512_crypt.encrypt(data[1])
		con = mdb.connect(host='localhost', user='adam', passwd='12adam12', db='IT490')
                query = "insert into users (user_name, password, powerlvl) values (\"%s\",\"%s\", %d)" % (data[0], passy, int(data[2]))

		try:
			cur = con.cursor()
			cur.execute(query)
			con.commit()
			return True
		except mdb.Error, e:
			print("Error: {}".format(e))
			con.rollback()
			

		con.close()
	
	def pull(self,data): #Needs 1 string, which is owner. Owners is usually the username, So when data is sent to the back end, make sure to include the username of the person somehow
                db= self.client["it420"]
                collection = db.game_description
                for thing in  collection.find_one({"results.name":data}):
                        print(thing)
                self.client.close()
                return thing

	def test(self):
		db = self.client["it420"]
		collection = db.game_description
		if(0 < collection.count()):
			return True
		else:
			return False	

