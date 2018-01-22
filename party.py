#!/usr/bin/python3
import time
import RPi.GPIO as GPIO

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)
GPIO.setup(23, GPIO.OUT) # Buzzer
GPIO.setup(7, GPIO.OUT) # Blau
GPIO.setup(5, GPIO.OUT) # Rot
GPIO.setup(3, GPIO.OUT) # Grün

open("/var/www/html/status.txt", "r+").write("1")
status = open("/var/www/html/status.txt", "r")
status_r = status.read()
status.close()

while status_r == "1":
    status = open("/var/www/html/status.txt", "r")
    status_r = status.read()
    GPIO.output(3, GPIO.LOW)
    time.sleep(0.2)
    GPIO.output(5, GPIO.LOW)
    time.sleep(0.2)
    GPIO.output(3, GPIO.HIGH)
    GPIO.output(7, GPIO.LOW)
    time.sleep(0.2)
    GPIO.output(5, GPIO.HIGH)
    GPIO.output(3, GPIO.LOW)
    time.sleep(0.2)
    GPIO.output(3, GPIO.HIGH)
    GPIO.output(7, GPIO.HIGH)

GPIO.output(3, GPIO.HIGH)
GPIO.output(5, GPIO.HIGH)
GPIO.output(7, GPIO.HIGH)
status.close()


'''
    for c in range(2): # Strobo Weiss
        GPIO.output(3, GPIO.LOW)
        GPIO.output(5, GPIO.LOW)
        GPIO.output(7, GPIO.LOW)
        time.sleep(0.1)
        GPIO.output(3, GPIO.HIGH)
        GPIO.output(5, GPIO.HIGH)
        GPIO.output(7, GPIO.HIGH)
        time.sleep(0.2)
'''
