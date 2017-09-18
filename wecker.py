#!/usr/bin/python3
import time
import RPi.GPIO as GPIO

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)
GPIO.setup(23, GPIO.OUT)
GPIO.setup(7, GPIO.OUT)
GPIO.setup(5, GPIO.OUT)
GPIO.setup(3, GPIO.OUT)

zeit = time.strftime("%H:%M");
status = open("wecker.txt", "r")
status = status.read()
a = 1

if status != "aus":
	while a == 1:
		if zeit == status:
			print("Es geht")
			for i in range(5):
				GPIO.output(3, GPIO.HIGH)
				for j in range(3):
					GPIO.output(5, GPIO.LOW)
					GPIO.output(23, GPIO.HIGH)
					GPIO.output(7, GPIO.HIGH)
					time.sleep(0.5)
					GPIO.output(5, GPIO.HIGH)
					GPIO.output(23, GPIO.LOW)
					GPIO.output(7, GPIO.LOW)
					time.sleep(0.5)
				GPIO.output(3, GPIO.LOW)
				time.sleep(0.5)
				GPIO.output(5, GPIO.LOW)
				GPIO.output(3, GPIO.HIGH)
				time.sleep(0.5)
			GPIO.output(3, GPIO.LOW)
			GPIO.output(5, GPIO.LOW)
			GPIO.output(7, GPIO.LOW)
			a = 0
		zeit=time.strftime("%H:%M")
		time.sleep(5)
