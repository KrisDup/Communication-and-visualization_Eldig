# Publisere Data og Visulaisere Dem

## Introduksjon til kommunikasjon mellom fysisk og digital verden
Denne delen av prosjektet tar for seg kommunikasjonen mellom den fysiske og digitale verden. Lenken starter ved at elektroniske sensorer måler den fysiske verden. Signaler og impluser blir i dette stadiet omformet til elektriske signaler som kan bli tolket av en datamaskin. Datamaskinen viderefører så signalene til internet ved hjelp av kommunikasjonsprotokollene TCP/IP. TCP er ansvarlig for selve transport av dataen over internet, mens IP forteller noe om hvordan dataen skal bli levert. En IP adresse er et nummer som unikt identifiserer en enhet over internet. DNS (Domain Name System) er en adressebok for IP adresser, hvor hver adresse har et tilsvarende domene. Det kjente domenet `ntnu.no` har tilsvarende IP adresse lik `129.241.160.102`. Du kan copy/paste de inn i en nettleser, og de vil begge ta deg til Ntnu sin hjemmeside.

## Lag bruker

Nettsiden dere skal bruke i dette prosjektet finner dere nedenfor. Det er samme om dere bruker DNS eller IPv4 adressen


DNS: `http://ec2-16-170-110-98.eu-north-1.compute.amazonaws.com`

IPv4: `http://16.170.110.98`

Her trykker dere på `Signup here!` og lager deretter passord og brukernavn. Logg så inn med brukernavn/passord. Det er viktig at dere **husker både brukernavn og passord**, ettersom de skal brukes senere.


## Last ned nødvendige filer

Neste steg er å laste ned `publishData.py`. Denne filen henter først ut sensor data fra Pi og PiJuice, for å så lagre de i en database lokalisert i skyen. Denne filen, samt en python fil for å hente ut temperatur målinger, kan lastes ned ved å kjøre følgende kode:

```
sudo git clone https://github.com/wealthystudent/Communication-and-visualization_Eldig.git
```

I folderen `Communication-and-visualization_Eldig` vil dere finne en del forskjellige filer. Dere skal bare bry dere om filene som ligger i folderen `ELDIG`. For å komme inn i denne folderen, skriv følgende 

```
cd Communication-and-visualization_Eldig/ELDIG
```

Inne i denne filkatalogen så skal dere gjøre endringer på filen `publishData.py`. For å få tilgang til å endre den, kjør kommandoen:

```
sudo nano publishData.py
```

Bla ned til linjene der det står `user_name` og `password`. Her fyller dere inn brukernavn og passord som dere lagde tidligere. Pass på å fylle inn mellom apostrofene (""). Trykk så `Ctrl+X` og `Enter`.

Før dere kan kjøre filen, må dere installere et python biliotek for å muligjøre tilkobling til MariaDB databaser. Dette bibliteket installeres ved hjelp av `pip`, en pakkeleder som brukes til å laste ned forskjellige biblioteker. For å laste ned biblioteket, kjør disse kommandoene

```
sudo apt-get update 
sudo apt-get upgrade
sudo apt-get install python3-pip
pip3 install mariadb
```


## Publiser data

Nå kan dere kjøre filen, og følge med på nettsiden for å se verdiene 

```
python3 publishData.py
```


