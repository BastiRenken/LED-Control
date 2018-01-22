#!/usr/bin/python3
import time
import RPi.GPIO as GPIO

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)
GPIO.setup(23, GPIO.OUT) # Buzzer
GPIO.setup(7, GPIO.OUT) # Blau
GPIO.setup(5, GPIO.OUT) # Rot
GPIO.setup(3, GPIO.OUT) # Grün

'''
for a in range(5):
    for b in range(2): # Rot-Grün-Blau
        GPIO.output(3, GPIO.LOW)
        time.sleep(0.1)
        GPIO.output(5, GPIO.LOW)
        GPIO.output(3, GPIO.HIGH)
        time.sleep(0.1)
        GPIO.output(7, GPIO.LOW)
        GPIO.output(5, GPIO.HIGH)
        time.sleep(0.1)
        GPIO.output(7, GPIO.HIGH)
    for c in range(2): # Strobo Weiss
        GPIO.output(3, GPIO.LOW)
        GPIO.output(5, GPIO.LOW)
        GPIO.output(7, GPIO.LOW)
        time.sleep(0.1)
        GPIO.output(3, GPIO.HIGH)
        GPIO.output(5, GPIO.HIGH)
        GPIO.output(7, GPIO.HIGH)
        time.sleep(0.1)
time.sleep(3)
'''

open("/var/www/html/status.txt", "r+").write("1")
status = open("/var/www/html/status.txt", "r")
status_r = status.read()
status.close()

while status_r == "1":
    status = open("/var/www/html/status.txt", "r")
    status_r = status.read()
    GPIO.output(3, GPIO.LOW)
    GPIO.output(5, GPIO.LOW)
    GPIO.output(7, GPIO.LOW)
    time.sleep(0.08)
    GPIO.output(3, GPIO.HIGH)
    GPIO.output(5, GPIO.HIGH)
    GPIO.output(7, GPIO.HIGH)
    time.sleep(0.08)

farbe = open("/var/www/html/farbe.txt", "r+")
farbe.write("lavender")
status.close()
