#Datahandler for pijuice

#install with pip: pip3 install mariadb
import mariadb
import sys
import time
#from tempmain import return_temp
import pijuice


pijuice = pijuice.PiJuice(1, 0x14)

#Connection variables for database. Fill in later. ["user", "password", "host", "port", "database"]
#THIS SHOULD PREFERABLY BE COLLECTED FROM THE SYSTEM SO IT DOES NOT INCLUDE PASSWORD IN PLAIN TEXT
con_var = [sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4], sys.argv[5]]

#Table name for each group. Fill in later
table_name = con_var[4]

#Connection
try:
    connection = mariadb.connect(user=con_var[0],
                                 password=con_var[1],
                                 host=con_var[2],
                                 port=3306,
                                 database=con_var[3])
    
    #MAKE SURE THIS IS TRUE; IF NOT THEN IT WONT INSERT INTO TABLES
    connection.autocommit = True
except mariadb.Error as e:
    print("Could not connect to mariadb. Error msg: {e}")
    sys.exit(1)
    
#Set cursor
cur = connection.cursor()



def retrivedata(pijuice):
    Powerinput=pijuice.status.GetStatus()['data'].get('powerInput') #arraynr. 0
    Charge=pijuice.status.GetChargeLevel()['data'] #arraynr. 1
    Batterytemp=pijuice.status.GetBatteryTemperature()['data'] #arraynr. 2
    BatV=pijuice.status.GetBatteryVoltage()['data'] #arraynr. 3
    BatC=pijuice.status.GetBatteryCurrent()['data'] #arraynr. 4
    IOV=pijuice.status.GetIoVoltage()['data'] #arraynr. 5
    IOC=pijuice.status.GetIoCurrent()['data'] #arraynr. 6
    Temp =  30;#return_temp() #arraynr. 7
    DataArray=[Powerinput,Charge,Batterytemp,BatV,BatC,IOV,IOC, Temp]
    return DataArray

def publishData(timeframe, cursor, pijuice):
    while(True):
        temp_arr = retrivedata(pijuice)
        query = f"INSERT INTO {table_name} (power_input, charge, battery_temp, bat_v, bat_i, io_v, io_c, temperature) VALUES ('{temp_arr[0]}',{temp_arr[1]},{temp_arr[2]},{temp_arr[3]},{temp_arr[4]},{temp_arr[5]},{temp_arr[6]},{temp_arr[7]})"                
        try:
            cursor.execute(query)
        except mariadb.Error as e:
            print(f"Error: {e}")
        time.sleep(timeframe)  
        
publishData(1, cur, pijuice)

