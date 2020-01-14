#!/usr/bin/env python
#import minimalmodbus
import time
import schedule
import MySQLdb
import RPi.GPIO as GPIO
import Adafruit_DHT

temperatura=0
umiditate=0
x=0
timeV=0
file_log = open('modbus.log','w')

def readDirectly():
    GPIO.setmode(GPIO.BCM)

    #name the type of sensor used
    type = Adafruit_DHT.DHT11

    #declare the pin used by the sensor in GPIO form
    dht11 = 25

    #set the sensor as INPUT
    GPIO.setup(dht11, GPIO.IN)

    try:
        while True:
            #make the reading
            humidity, temperature = Adafruit_DHT.read_retry(type, dht11)

            #we will display the values only if they are not null
            if humidity is not None and temperature is not None:
                print('Temperature = {:.1f}  Humidity = {:.1f}' .format(temperature, humidity))
                global umiditate
                umiditate = humidity
                global temperatura
                temperatura = temperature
                job()


    except KeyboardInterrupt:
        pass

    #clean all the used ports
    GPIO.cleanup()

#def read():
	#time.sleep(0.9)
	#instrument = minimalmodbus.Instrument('/dev/ttyUSB0', 1) # port name, slave address (in decimal)
	#instrument.serial.timeout  = 1
	#instrument.mode = minimalmodbus.MODE_RTU
	#time.sleep(0.5)
	#try:
		#global timeV
		#values = (instrument.read_registers(4,2,3))
			#print(time.strftime("%H:%M:%S"))
		#timeV = (time.strftime("%H:%M:%S"))
		
		#global temperatura
		#temperatura = values[0]
		#global umiditate
		#umiditate = values[1]
		#print (timeV,"tempearatura=",temperatura,"umidiatate=",umiditate)
        
		#print >> file_log, timeV,'tempearatura=',temperatura,'umidiatate=',umiditate
	
	#except IOError:
		#print (timeV,"Failed to read from instrument")
		#file_log.close()

def job():
	dataDB = (time.strftime('%Y-%m-%d %H:%M:%S'))
    
	# Open database connection
	db = MySQLdb.connect("localhost","marius","panasonic","pytemphum" )

	# prepare a cursor object using cursor() method
	cursor = db.cursor()
    print ("temperatura=", temperatura, "umiditate=", umiditate)
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
	print ("TEST OK")
#def testprint():
	#print "print test"

def actions():
	readDirectly()
	job()
	schedule.every(0.1).minutes.do(readDirectly)
	schedule.every(0.5).minutes.do(job)
	while True:
		schedule.run_pending()
		time.sleep(1)

if __name__ == "__main__":
	actions()



