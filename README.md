# Home Project

- Appicazione per la lettura ed il salvataggio delle informazioni in merito alle vulnerabililità dei sistemi informatici

## Indice

- [Funzioni](#finzioni)
- [Inizio](#inizio)
  - [Prerequisiti](#prerequisiti)
  - [Installazione](#installazione)
- [Utilizzo](#utilizzo)


## Funzioni

- Proteione tramite login
- Creazione utente
- Lettura API dei dati della CVE relatina al CpeName indiacato
- Salvataggio dati API
- Elenco delle CVE salvate
- Visualizzazione dedicata alla singola CVE con lo storico dei cambiamenti

## Inizio

Per poter essere avviata l'applicazione necessita di essere installato in un ambiente che rispetta i requisiti sotto elencati.
Una volta che questi siano soddisfatti la procedura di installazione deve essere eseguita come indicato.

### Prerequisiti

- Database Mysql
- Npm
- php >= 8.1
- per mysql (max_allowed_packet=1M)

### Installazione

1. composer install
2. php artisan migrate

## Utilizzo

Ad ogni avvio dell'applicazione deve essere eseguito il comando <b>npm run dev</b>, a questo punto l'applicazione sarà fruibile all'indirizzo http://localhost/laravel_security/public/
