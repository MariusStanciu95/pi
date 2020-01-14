#!/usr/bin/env python
import minimalmodbus
import time
import schedule
import MySQLdb

#Variabile Globale
temperatura=0
umiditate=0
x=0
timeV=0
timeV = (time.strftime("%H:%M:%S"))
file_log = open('modbus.log','w')

# Initializare conexiune MODBUS RTU RS485
time.sleep(0.9)
instrument = minimalmodbus.Instrument('/dev/ttyUSB0', 1) # port name, slave address (in decimal)
instrument.serial.timeout  = 1
instrument.mode = minimalmodbus.MODE_RTU
time.sleep(0.5)

#DataBase Config
host = "192.168.253.5"
username = "py"
password = "123456"
database = "py-temp-hum"
insert_DB = "20" # minutes
def read():
	
	try:    
		#global timeV
		global temperatura
		global umiditate
		values = (instrument.read_registers(4,2,3))


		#print(time.strftime("%H:%M:%S"))
		#timeV = (time.strftime("%H:%M:%S"))
		

		# Read Values from modbus
		temperatura = values[0]
		umiditate = values[1]
		
		

		#Debug variables for database
		#print timeV,"tempearatura=",temperatura,"umidiatate=",umiditate
		#print >> file_log, timeV,'tempearatura=',temperatura,'umidiatate=',umiditate

		#time.sleep(0.2)
		# Registernumber, value, number of decimals for storage
		#instrument.write_register(1,1,0)

		#time.sleep(0.2)
		# Registernumber, value, number of decimals for storage
		#instrument.write_register(1,2,0)

		#time.sleep(0.2)
		# Registernumber, value, number of decimals for storage
		#instrument.write_register(1,4,0)

		#time.sleep(0.2)
		# Registernumber, value, number of decimals for storage
		#instrument.write_register(1,8,0)

		#time.sleep(0.2)
		# Registernumber, value, number of decimals for storage
		#instrument.write_register(1,31,0)

		#time.sleep(0.8)
		# Registernumber, value, number of decimals for storage
		#instrument.write_register(1,0,0)

	
	except IOError:
		#Print for debug
		#print timeV,"Failed to read from instrument"

		#DB connection for sending info state
		dataDB = (time.strftime('%Y-%m-%d %H:%M:%S'))
    
		# Open database connection
		db = MySQLdb.connect(host,username,password,database)


		# prepare a cursor object using cursor() method
		cursor = db.cursor()

		# Prepare SQL query to INSERT a record into the database.
		sql = 'INSERT INTO errors(error, data) VALUES ("%s","%s")' % \
		('Failed to read from instrument', dataDB)

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

def job():
	dataDB = (time.strftime('%Y-%m-%d %H:%M:%S'))
	# Open database connection
	db = MySQLdb.connect(host,username,password,database)

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


	#Denug info to database
	#time.sleep(6)
	#print "TEST OK"

def readcoils():
		# Open database connection
	db = MySQLdb.connect(host,username,password,database)

	# prepare a cursor object using cursor() method
	cursor = db.cursor()

	# Prepare SQL query to INSERT a record into the database.
	sql = 'SELECT coil1,coil2,coil3,coil4,coil5  from coils order by date desc limit 1 ' 
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
	try:
		row = cursor.fetchone ()
		nr=0
		for i in range(0,5):
			if(row[i]):
				nr=nr+pow(2,i)
		instrument.write_register(1,nr,0)

	except IOError:
		#Print for debug
		#print timeV,"Failed to read from instrument"

		#DB connection for sending info state
		dataDB = (time.strftime('%Y-%m-%d %H:%M:%S'))
    
		# Open database connection
		db = MySQLdb.connect(host,username,password,database)


		# prepare a cursor object using cursor() method
		cursor = db.cursor()

		# Prepare SQL query to INSERT a record into the database.
		sql = 'INSERT INTO errors(error, data) VALUES ("%s","%s")' % \
		('Failed to read from instrument', dataDB)

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


def actions():
	readcoils()
	read()
	job()
	# Define interval for reading values from the remote modbus clients
	schedule.every(0.1).minutes.do(read)
	schedule.every(0.02).minutes.do(readcoils)
	# Define interval fro inserting values to database
	schedule.every(20).minutes.do(job)
	while True:
		schedule.run_pending()
		time.sleep(1)

if __name__ == "__main__":
	actions()

