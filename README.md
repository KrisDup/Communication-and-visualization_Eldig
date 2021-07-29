# How to implement a LAMP stack for hosting database and webserver


There are four important components: 
**Linux**, which is the operating system hosting the webservers (This one is already installed, since RPi runs linux)
**Apache**, an open-source web server software for linux
**MySQL**, the relational database management system
**PHP**, a programing language used on server side to create dynamic pages


## Step 1: Update and upgrade packages

```
sudo apt update
sudo apt upgrade
```

## Step 2: Install Apache

Installed by running the following command
```
sudo apt install apache2
```
Some flavours of linux require the user to actually start the server, which can be done by running:
```
sudo service apache2 start
```

The server is now accessible through a browser by typing `localhost` in the adress field, or by going to the directory through the following command ``` cd /var/www/html ```

### Clone repository
First do `cd /var/www`

Inside the www directory, clone this git repository:
`git clone https://github.com/wealthystudent/Communication-and-visualization_Eldig.git`

### Create a virtual host
In order to hook the IP adress of the local web oage to a specific folder, we can create a **virtual host**.






  

