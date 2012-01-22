/**************************************************************************************************************************\

Known Errors / ToDo:

- Found in r310: Date=2012-01-14, Time=20:31, Input=Wired, Unit=1, Event=(WiredIn 9,On) event ?? na verzenden .
- Found in r306: Nodo due compatibel maken n.a.v. omnummeren CMD_...
- Sendbusy en Waitbusy testen of mmi en oppikken commando nog goed werken. Queue testen
- Found in r306: Status WiredAnalog groter dan toegestane poort

Aanpassingen:
- EventListshow, eventListWrite,eventListErase hebben nu als parameter-1 de regel waar het betrekking op heeft (<eventlistregel>, ALL, 0=All)
- Toevoeging commando "IPSettings".
- bug uit terminal toegang gehaald.
- Aanpassing weergave van EventList zodat deze direct weer gebruikt kan worden om weg te schrijven
- Commando's/Events worden niet meer tussen "(" en ")" haken weergegeven.

Release V3.0.0: Functionele aanpassingen ten opzichte van de 1.2.1 release
- EventListshow, eventListWrite,eventListErase hebben nu als parameter-1 de regel waar het betrekking op heeft (regel, ALL, 0=All)
- Toevoeging commando "IPSettings".
- Commaando toegevoegd "WiredCalibrate <poort> <High|Low> <ijkwaarde>"
- Ethernet intergratie. Events van EventGhost (PC, Android) ontvangen en verzenden over IP;
- Toevoeging commando "URL <line>", hiermee kan de URL van de server worden ingesteld waar de events (via HTTP-Poort 80) naar toegezonden moeten worden. (max. 40 tekens)
- Nieuw commando "OutputEG <On|Off> , <SaveIP Save|On|Off>"
- Bij opstarten de melding "Booting..." omdat wachten op IP adres van de router de eerste keer even tijd in beslag kan nemen.
- Indien SDCard geplaatst, dan logging naar Log.txt.
- UserPlugin maakt mogelijk om gebruiker zelf code aan de Nodo code toe te voegen.
- Aantal timers verhoogd van 15 naar 32
- Aantal gebruikersvariabelen verhoogd van 15 naar 32
- 8 digitale wired poorten i.p.v. 4
- 8 analoge wired poorten i.p.v. 4
- Aanpassing "WiredSmittTrigger": invoer analoge decimale waarde. 
- Aanpassing "WiredTreshold": invoer analoge decimale waarde.
- Eventlist uitgebreid van 120 posities naar 256
- queue voor opvangen events tijdens delay van 15 uitgebreid naar 32 events.
- Welkomsttekst uitgebreid met de IP-settings
- Welkomsttekst uitgebreid met melding logging naar SDCard.
- Toevoeging commando "Password"
- Toevoeging commando "Reboot"
- Ccommando "Status" geeft in als resultaat in de tag "output=Status"
- Toevoeging commando "Terminal <[On|Off]>,<prompt [On|Off]>". tevens "Status" commando uitgebreid met setting "Terminal"
- Commando "Display" Vervallen.
- Commando hoeft niet meer te worden afgesloten met een puntkomma. Puntkomma wordt alleen gebruikt om meerdere commandos per regel te scheiden.
- Toevoeging commando "VariableSave", slaat alle variabelen op zodat deze na een herstart weer worden geladen. Opslaan gebeurt NIET meer automatisch.
- Toevoeging commando "LogShow": laat de inhoud van de log op SDCard zien
- Toevoeging commando "LogErase": wist de logfile
- Commando "RawSignalGet" en "RawSignlPut" vervallen;
- Toevoeging commando "RawSignalSave <key>". Slaat pulsenreeks van het eerstvolgende ontvangen signaal op op SDCard onder opgegeven nummer
- Toevoeging commando "RawSignalSend <key>". Verzend een eerder onder <key> opgeslagen pulsenreeks. Als <key> = 0, dan wordt huidige inhoud verzonden
- "SendVarUserEvent" renamed naar "VariableSendUserEvent"
- nieuw commando: "VariableUserEvent" genereert een userevent op basis van de inhoud van twee variabelen.
- Commando "TransmitSettings" vervallen. Vervangen door "TransmitIR", "TransmitRF"
- Commando "Simulate" vervallen. Kan worden opgelost met de nieuwe commandos "TransmitIR" en "TransmitRF".
- Aanpassing weergave van datum/tijd. De dag wordt na NA de datum weergegeven ipv VOOR (ivm kunnen sorteren logfile).
- Errors worden nu weergeven met een tekstuele toelichting wat de fout veroorzaakte: "Error=<tekst>". 
- "Timestamp=" wordt nu iets anders weergegeven als "Date=yyyy-mm-dd, Time=hh:mm".
- Variabelen worden na wijzigen niet meer automatisch opgeslagen in het EEPROM geheugen. Opslaan kan nu met commando "VariableSave"
- Toevoeging commando "HTTPRequest <line>". Vul in als "HTTPRequest www.mijnhost.nl/pad/mijnscript.php"
- Tag 'Direction' vervangen door Input, Output, Internal
- Commando "SendEvent <poort>" toegevoegd. Vervangt oude SendSignal. Stuurt laatst ontvangen event door. Par1 bevat de poort( EventGhost, IR, RF, HTTP, All)
- Onbekende hex-events worden mogelijk door andere waarde weergegeven a.g.v. filtering aan Nodo gelijke events. ??? wenselijk/noodzakelijk?
- Een EventlistWrite commando met bijhehorende event en actie moeten zich binnen 1 regel bevinden die wordt afgesloten met een \n
- Verzenden naar Serial vindt pas plaats als er door ontvangst van een teken gecontroleerd is dat seriele verbinding nodig is;
- Commando "VariableSetWiredAnalog" vervallen. Past niet meer bij 10-bit berwerking en calibratie/ijking
- Commando "WiredRange" vervallen. Overbodig geworden n.a.v. calibratie/ijking funktionaliteit.
- Event aangepast "WiredAnalog". Geeft nu gecalibreerde waarde weer metdecimalen achter de komma
- Verzenden van IR staat default op Off na een reset.
- Sound: als Par1 groter dan 8, dan tijdsduur=Par2*100 milliseconde, toonhoogte=Par2*100 Hz
- Aanpassing weergave van EventList zodat deze direct weer gebruikt kan worden om weg te schrijven
- Commando's/Events worden niet meer tussen "(" en ")" haken weergegeven.

Onder de motorkap:
- Verwerken van seriele gegevens volledig herschreven
- omnummeren van tabel met events,commando en waarden om plaats te maken voor uitbreiding commandoset. LET OP: niet meer compatibel met de Uno 1.2.1 en lagere versies!

\**************************************************************************************************************************/

