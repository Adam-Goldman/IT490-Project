import pika
import json
from MongoThing import MongoThing


creds= pika.PlainCredentials('guest', 'guest')
connection = pika.BlockingConnection(pika.ConnectionParameters( '192.168.1.150', 5672,'AMERICA', creds))

channel = connection.channel()

channel.queue_declare(queue='test')
channel.queue_bind(exchange='testExchange',queue='test', routing_key='test')
def backEndThing(n):
	mongothing = MongoThing()
	
	if n[0] == "login":
		return mongothing.auth(n[1])
	elif n[0] == "regi":
		return mongothing.regi(n[1])
 	elif n[0] == "pull":
		return mongothing.pull(n[1])
	else:
		return "Fuck"


def on_request(ch, method, props, body):

	result = json.loads(body)
	print "Response from client: " + body
	response = backEndThing(result)
	print response
	ch.basic_publish(exchange='testExchange', 
			routing_key='test.response', 
			properties=pika.BasicProperties(correlation_id=
							props.correlation_id),
			body=json.dumps(str(response)))

	ch.basic_ack(delivery_tag = method.delivery_tag)
	print "I got the thing!"


channel.basic_qos(prefetch_count=1)
channel.basic_consume(on_request, queue='test')
# Data will listen/receive things here

print " [x] Awaiting RPC requests"

channel.start_consuming()
