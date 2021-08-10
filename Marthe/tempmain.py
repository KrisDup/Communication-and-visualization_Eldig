import os
import glob
import time
from temperaturefiles import read_temp

#Test på at det funker å hente serienummer med os.system og printe verdier
os.system('sudo modprobe w1-gpio')
os.system('sudo modprobe w1-therm')
base_dir = '/sys/bus/w1/devices/'

temp_sens_content = os.listdir(base_dir)
sensor_id = temp_sens_content[1]
sensor_id_short = sensor_id[0]+sensor_id[1]

device_folder = glob.glob(base_dir + sensor_id_short+'*')[0]
device_file = device_folder + '/w1_slave'

def return_temp():
    return read_temp(device_file)

'''
while True:
    print(read_temp(device_file))
    time.sleep(1)
'''
