#!/usr/bin/env python
import minimalmodbus
import time
import schedule
import MySQLdb
temperatura=0
umiditate=0
x=0
file_log = open('modbus.log','w')

def read():
	time.sleep(0.9)
	instrument = minimalmodbus.Instrument('/dev/ttyUSB0', 1) # port name, slave address (in decimal)
	instrument.serial.timeout  = 1
	instrument.mode = minimalmodbus.MODE_RTU
	time.sleep(0.5)
	try:    
		values = (instrument.read_registers(4,2,3))
			#print(time.strftime("%H:%M:%S"))
		timeV = (time.strftime("%H:%M:%S"))
		
		global temperatura
		temperatura = values[0]
		global umiditate
		umiditate = values[1]
#		print timeV,"tempearatura=",temperatura,"umidiatate=",umiditate
        
		#print >> file_log, timeV,'tempearatura=',temperatura,'umidiatate=',umiditate
	
	except IOError:
		print timeV,"Failed to read from instrument"
		#file_log.close()

def job():
	dataDB = (time.strftime('%Y-%m-%d %H:%M:%S'))
    
	# Open database connection
	db = MySQLdb.connect("192.168.253.5","py","123456","py-temp-hum" )

	# prepare a cursor object using cursor() method
	cursor = db.cursor()

	# Prepare SQL query to INSERT a record into the database.
	sql = 'INSERT INTO temp_hum(temp, hum, data) VALUES ("%d","%d","%s")' % \
	(temperatura, umiditate, dataDB)

	try:
		# Execute the SQL command
		cursor.execute(sql)
		# Commit your changes in the database
		db.commit()
	except:
		# Rollback in case there is any error
		db.rollback()

	# disconnect from server
	db.close()
	#time.sleep(6)
#	print "TEST OK"
#def testprint():
	#print "print test"

def actions():
	read()
	job()
	schedule.every(0.1).minutes.do(read)
	schedule.every(20).minutes.do(job)
	while True:
		schedule.run_pending()
		time.sleep(1)

if __name__ == "__main__":
	actions()



