from MongoThing import MongoThing

x = MongoThing()

result1 =  x.auth(["Bob","Password"])

result2 = x.test()

if(result1 and result2):
	 True
else:
	False



