# How to implement a LAMP stack for hosting database and webserver


There are four important components: 
**Linux**, which is the operating system hosting the webservers (This one is already installed, since RPi runs linux)

**Apache**, an open-source web server software for linux.

**MySQL**, the relational database management system.

**PHP**, a programing language used on server side to create dynamic pages


## Step 0: Create environment for server

When starting a server, we have to decide where to run it. It could be on a Raspberry Pi, your local computer/hardware or in the cloud. This section describes the process of starting a virtual machine in the AWS Cloud. 

### Create AWS Account
### Create IAM user for access to account (Optional BUT RECCOMENDED)
Create an IAM user in the AWS account and use that to access the account instead of the root user login. 

### Create EC2 Instance
The EC2 instance is a virtual machine that you spin up in the cloud

In the **Console**, search for **EC2**.\

Then, click **Launch instance**\

Give the instance a name\

Change **Instance Type** (optional, only required if expecting high loads on the server)\

Under **Key pair(login)**, select *Create new key pair* amd use the default settings (make sure it is a .pem file). Make sure to download the contents of the keypair, as we need it to SSH into our virtual machine\

Click **Launch instance**\

Wait for the instance to spin up, then select it and chose **Connect**. Here you can choose to connect via SSH client, which explains how to SSH into your instance.\


Now the instance is created, and we can start to spin up our web-server


## Step 1: Update and upgrade packages

```
sudo apt-get update
sudo apt upgrade
```

## Step 2: Install Apache

Installed by running the following command
```
sudo apt install apache2
sudo apt install libapache2-mod-php
sudo a2enmod php 
sudo apt install php7.3-mysql
```
Some flavours of linux require the user to actually start the server, which can be done by running:
```
sudo service apache2 start
```

If you receive an error message `(98) Address already in use: make_sock: could not bind to address 0.0.0.0:80`, then do the following:

```
sudo netstat -ltnp | grep: 80
sudo kill -9 [number]
```
Where `[number]` is the number in line `tcp ...... [number]/apache`

The server is now accessible through a browser by typing `localhost` in the adress field, or by going to the directory through the following command ``` cd /var/www/html ```


### Create a virtual host
In order to hook the IP adress of the local web page to a specific folder, we can create a **virtual host**.
This is easily done through a bash script created by Alecaddd. In order to download and ready the file, type the following
```
cd /usr/local/bin
sudo wget -O virtualhost https://raw.githubusercontent.com/RoverWire/virtualhost/master/virtualhost.sh
sudo chmod +x virtualhost
```
To create a VH, type 
```
sudo virtualhost [create | delete] [domain] [optional host_dir]
```
Note that domain is the same as the server name. A directory with the same name as `[domain]` was created at `var/www/[domain]`. We can delete this now, but remember the domain name for later.

Now, delete the directory by doing
```
sudo rm -r var/www/[domain]
```

### Clone repository
First do 
```
cd /var/www
```

Inside the www directory, clone this git repository: (Requires login with username and password)
```
sudo git clone https://github.com/wealthystudent/Communication-and-visualization_Eldig.git
```
We need to change the name of the cloned repository to the domain name used above, like this:
```
sudo mv Communication-and-visualization_Eldig [domain]
```
Finally, we need to change the `DocumentRoot` directory of apache2 sites conf file to `[domain]`

```
cd /etc/apache2/sites-available
sudo nano 000-default.conf
```
Change the line `DocumentRoot` to `DocumentRoot /var/www/[domain]`


**********
NOTE THAT THE REST OF THE COMMANDS ARE EXECUTED WHILE INSIDE THE `/var/www/[domain]` DIRECTORY.
Change the directory 
```
cd /var/www/[domain]
```
**********
Now, the page should be ready

## Step 3: Create the database

First install MariaDB.
```
sudo apt install mariadb-server
```
Next we need to ecure the MySQL server.  Run the following command, and make a password for your user

```
sudo mysql_secure_installation
```

Now the database can be accessed through `mysql -u [user] -p`, or through `sudo mysql -u root -p` which does not require a password. There are no users registered initially, so we need to create it.
After logging into mysql with the above command, we can start by creating a database and assign a user to that database. Type
```
CREATE DATABASE [name];
CREATE USER '[user]'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON [name].* TO '[user]'@'localhost' 
```

The file `connection.php` needs to be modified with the correct username [user] , password [password], servername [domain] and database [name] name
```
sudo nano /var/www/[domain]/connection.php
```

In order to initialize the database with the needed tables, we can run a python script that generates the needed tables. Before we can execute that file, it you need to install a mariadb connector for python
```
pip3 install mariadb
```
Inside the `var/www/[domain]` directory, run the following command. Note that `[user]` is the mysql username while `[name]` is the name of the database.

```
python3 genTables.py [user] [password] [domain] [name]
```

## Final Step: Publish data and view it online
Now we have configured the database and the webserver. The next step is to run the python script for publishing the readings to the database and view them in the browser. Log in to the webpage by typing `[domain]` in the adress feild and signup/login to access the main page.
*********
To access the webpage from another device on the same local network, type the command `hostname -I`
*********


Run the python file and watch the data getting displayed on the page. Note that `[table name]` is the same as the username used when signing up for the webpage.

```
python3 publishData.py [user] [password] [domain] [name] [table name]
```








  

