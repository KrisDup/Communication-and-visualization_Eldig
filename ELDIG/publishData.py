# Datahandler for pijuice

# install with pip: pip3 install mariadb
import mariadb
import sys
import time
from tempmain import return_temp
import pijuice

# Initialize PiJuoce object
pijuice = pijuice.PiJuice(1, 0x14)


# Insert Username and Password below. Remember to put them between the quotation marks

user_name = ""
password = ""


table_name = user_name

# Connection
try:
    connection = mariadb.connect(user=user_name,
                                 password=password,
                                 host="34.233.8.82",
                                 port=3306,
                                 database="ELDIts")

    # MAKE SURE THIS IS TRUE; IF NOT THEN IT WONT INSERT INTO TABLES
    connection.autocommit = True
except mariadb.Error as e:
    print(f"Could not connect to mariadb. Error msg: {e}")
    sys.exit(1)

# Set cursor
cur = connection.cursor()


def retrivedata(pijuice):
    try:
        Powerinput = pijuice.status.GetStatus()['data'].get('powerInput')  # arraynr. 0
    except:
        pass
    try:
        Charge = pijuice.status.GetChargeLevel()['data']  # arraynr. 1
    except:
        pass
    try:
        Batterytemp = pijuice.status.GetBatteryTemperature()['data']  # arraynr. 2
    except:
        pass
    try:
        BatV = pijuice.status.GetBatteryVoltage()['data']  # arraynr. 3
    except:
        pass
    try:
        BatC = pijuice.status.GetBatteryCurrent()['data']  # arraynr. 4
    except:
        pass
    try:
        IOV = pijuice.status.GetIoVoltage()['data']  # arraynr. 5
    except:
        pass
    try:
        IOC = pijuice.status.GetIoCurrent()['data']  # arraynr. 6
    except:
        pass
    try:
        Temp = return_temp()  # arraynr. 7
    except:
        pass
    try:
        DataArray = [Powerinput, Charge, Batterytemp, BatV, BatC, IOV, IOC, Temp]
    except:
        pass
    return DataArray


def publishData(timeframe, cursor, pijuice):
    while (True):
        temp_arr = retrivedata(pijuice)
        query = f"INSERT INTO ELDIts.{table_name} (power_input, charge, battery_temp, bat_v, bat_i, io_v, io_c, temperature) VALUES ('{temp_arr[0]}',{temp_arr[1]},{temp_arr[2]},{temp_arr[3]},{temp_arr[4]},{temp_arr[5]},{temp_arr[6]},{temp_arr[7]})"
        try:
            cursor.execute(query)
        except mariadb.Error as e:
            print(f"Error: {e}")
        time.sleep(timeframe)


publishData(1, cur, pijuice)
