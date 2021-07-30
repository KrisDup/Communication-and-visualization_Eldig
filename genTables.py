import mariadb
import sys

con_var = [sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4]]
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


query = f"CREATE TABLE login (id BIGINT AUTO_INCREMENT, user_id BIGINT, user_name VARCHAR(50), password VARCHAR(50), date TIMESTAMP, PRIMARY KEY(id))"


try:
    cur.execute(query)
    print("login table created")
except mariadb.Error as e:
    print(f"Error: {e}")
