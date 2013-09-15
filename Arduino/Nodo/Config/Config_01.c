
// ****************************************************************************************************************************************
// Definities voor Nodo units : CONFIG.C
// ****************************************************************************************************************************************
// Deel 1: geef hier op welke devices er gebruikt worden. Het maakt niet uit in welke Nodo ht device zich bevindt.
// Let op: u dient voor elke device file het VOLLEDIGE path op te geven!
//
// Voor een volledige, en bijgewerkte lijst van alle beschikbare devices verwijzen we naar de Wiki:
// http://www.nodo-domotica.nl/index.php/Device
//
// Allereerst de KAKU devices. Die worden gespecificeerd voor ALLE Nodo's. Alle andere devices worden Nodo-specifiek opgegeven
// ****************************************************************************************************************************************

#define UNIT_NODO 1
#define NODO_MEGA                    true // true = Nodo Mega, false=Nodo-Small
#define ETHERNET                     true // true = Deze Nodo beschikt over een ethernet kaart

// Kaku              : Klik-Aan-Klik-Uit / HomeEasy protocol ontvangst
#define PLUGIN_001
#define PLUGIN_001_CORE

// KakuSend          : Klik-Aan-Klik-Uit / HomeEasy protocol verzenden 
#define PLUGIN_002
#define PLUGIN_002_CORE

// NewKAKU           : Klik-Aan-Klik-Uit ontvangst van signalen met automatische codering. Tevens bekend als Intertechno.
#define PLUGIN_003
#define PLUGIN_003_CORE

// NewKAKUSend       : Klik-Aan-Klik-Uit ontvangst van signalen met automatische codering. Tevens bekend als Intertechno. 
#define PLUGIN_004
#define PLUGIN_004_CORE

// TempSensor        : Temperatuursensor Dallas DS18B20. (Let op; -B- variant, dus niet DS1820)
#define PLUGIN_005 
#define PLUGIN_005_CORE

// UserEvent receiver voor oude Nodo codering
#define PLUGIN_007 
#define PLUGIN_007_CORE



