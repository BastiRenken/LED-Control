#!/usr/bin/python3
#Wecker

import time
import RPi.GPIO as GPIO

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)
GPIO.setup(23, GPIO.OUT) # Buzzer
GPIO.setup(7, GPIO.OUT) # Blau
GPIO.setup(5, GPIO.OUT) # Rot
GPIO.setup(3, GPIO.OUT) # Grün

while True:
	zeit = time.strftime("%H:%M")
	weckzeit = open("/var/www/html/wecker.txt", "r")
	weckzeit_r = weckzeit.read()
	weckzeit.close()
	print(weckzeit_r)
	print(zeit)
	if zeit == weckzeit_r:
		for i in range(2):
			GPIO.output(3, GPIO.LOW)
			time.sleep(0.5)
			GPIO.output(5, GPIO.LOW)
			time.sleep(0.5)
			GPIO.output(3, GPIO.HIGH)
			GPIO.output(7, GPIO.LOW)
			time.sleep(0.5)
			GPIO.output(5, GPIO.HIGH)
			GPIO.output(3, GPIO.LOW)
			time.sleep(0.5)
			GPIO.output(3, GPIO.HIGH)
			GPIO.output(7, GPIO.HIGH)
		for i in range(5):
			for i in range(2):
				GPIO.output(3, GPIO.LOW)
				GPIO.output(5, GPIO.LOW)
				GPIO.output(7, GPIO.LOW)
				time.sleep(0.1)
				GPIO.output(3, GPIO.HIGH)
				GPIO.output(5, GPIO.HIGH)
				GPIO.output(7, GPIO.HIGH)
				time.sleep(0.1)
			GPIO.output(3, GPIO.HIGH)
			for j in range(3):
				GPIO.output(5, GPIO.LOW)
				GPIO.output(23, GPIO.HIGH)
				GPIO.output(7, GPIO.HIGH)
				time.sleep(0.4)
				GPIO.output(5, GPIO.HIGH)
				GPIO.output(23, GPIO.LOW)
				GPIO.output(7, GPIO.LOW)
				time.sleep(0.4)
			GPIO.output(3, GPIO.LOW)
			time.sleep(0.4)
			GPIO.output(5, GPIO.LOW)
			GPIO.output(3, GPIO.HIGH)
			time.sleep(0.4)
		GPIO.output(3, GPIO.LOW)
		GPIO.output(5, GPIO.LOW)
		GPIO.output(7, GPIO.LOW)
		farbe = open("/var/www/html/farbe.txt", "r+")
		farbe.write("lightyellow")
		farbe.close()
		time.sleep(40)
	else:
		time.sleep(10)
