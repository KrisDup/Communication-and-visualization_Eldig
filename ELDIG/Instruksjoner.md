# Publisere Data og Visulaisere Dem
Denne delen av prosjektet tar for seg kommunikasjonen mellom den fysiske og digitale verden. Lenken starter ved at elektroniske sensorer måler den fysiske verden. Signaler og impluser blir i dette stadiet omformet til elektriske signaler som kan bli tolket av en datamaskin. Datamaskinen viderefører så signalene til internet ved hjelp av kommunikasjonsprotokollene TCP/IP. TCP er ansvarlig for selve transport av dataen over internet, mens IP forteller noe om hvordan dataen skal bli levert. En IP adresse er et nummer som unikt identifiserer en enhet over internet. DNS (Domain Name System) er en adressebok for IP adresser, hvor hver adresse har et tilsvarende domene. Det kjente domenet `ntnu.no` har tilsvarende IP adresse lik `129.241.160.102`. Du kan copy/paste de inn i en nettleser, og de vil begge ta deg til Ntnu sin hjemmeside.

Nettsiden dere skal bruke i dette prosjektet finner dere nedenfor


DNS: `http://ec2-16-170-110-98.eu-north-1.compute.amazonaws.com`.
IPv4: `http://16.170.110.98`.

Her trykker dere på `Signup here!` og lager deretter passord og brukernavn. Logg så inn med brukernavn/passord. Det er viktig at dere husker både brukernavn og passord, ettersom de skal brukes senere.



Neste steg er å laste ned `publishData.py`. Denne filen henter først ut sensor data fra Pi og PiJuice, for å så lagre de i en database lokalisert i skyen. Denne filen, samt en python fil for å hente ut temperatur målinger, kan lastes ned ved å kjøre følgende kode:

```
git clone -b Marthe https://github.com/wealthystudent/Communication-and-visualization_Eldig.git
```
