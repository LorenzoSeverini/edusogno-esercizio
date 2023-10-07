<!-- Documentazione  -->
## Documentazione
Il progetto è stato realizzato utilizzando PHP, per la gestione del database è stato utilizzato MySQL, CSS e JavaScript per la parte grafica e per la gestione degli eventi.

#### Per una migliore visualizzazione di questo file usare la shortcut: `Ctrl + Shift + V` in Visual Studio Code.

### User 5 con privilegi da Admin (email e password)

- email: admin@esempio.com
- password: Admin1234#

### User 1 email e password ( cambiata la password )

- email: ulysses200915@varen8.com
- password: Edusogno123#


## Funzione generale del progetto: 

#### User 

- L'utente può registrarsi e accedere al sito, effettuare una richiesta di reset della password tramite un link inviato alla propria email e aprendolo potrà inserire una nuova password.

- L'utente effettuando il log in accede alla dasboard utente dove può visualizzare gli eventi a cui fa parte.

- L'utente può effettuare il log out.

#### Admin 

- L'admin è uno user con privilegi maggiori, tramite una Foreing Key è collegato alla tabella admin_privileges dove è presente un campo con id utente che fa riferimento alla tabella utenti. I privilegi possono essere dati solo attraverso l'azienda tramite un update del campo privileges nel database.

- L'admin effettua il log in dal form di Login e accede alla dashboard admin dove può visualizzare tutti gli eventi presenti nel database, può aggiungere un nuovo evento, modificare un evento esistente e cancellare un evento.

- L'admin può effettuare il log out.

## Struttura del progetto

- Cartella assets: contiene i file css, js e le immagini utilizzate nel progetto e il file di migrazione del database.

- Ogni cartella contiene dei sottogruppi per una migliore organizzazione del progetto.

- cartella Config contiene il file di configurazione del database e il file di configurazione della email.

- cartella Controllers contiene i file che gestiscono le richieste e le risposte del server.

- cartella Models contiene i file che gestiscono le query al database.

- cartella Views contiene i file che gestiscono le viste del progetto.

- Cartella public contiene il file index.php ovvero il log in.

- Cartella vendor contiene i file di composer.

- Composer.json contiene la dipendenza per la gestione delle mail utlizzando PHPMailer.

## Struttura del database

### Il database è composto da 3 tabelle: utenti, eventi e admin_privileges.

### La tabella utenti contiene i dati degli utenti registrati al sito (nome, cognome, email, password, reset_token, reset_expires) 

- nome e cognome.

- la email è univoca e non può essere ripetuta.

- password deve essere lunga almeno 8 caratteri e deve contenere almeno un numero e un carattere speciale.

- reset_token è un token generato automaticamente quando l'utente richiede il reset della password. 

- reset_expires è la data di scadenza del token.

### La tabella eventi contiene i dati degli eventi.

- event_name è il nome dell'evento.

- event_date è la data dell'evento.

- attendees sono i partecipanti all'evento utilizzando la email dell'utente.

- admin_access è un campo booleano che indica se l'evento è visibile all admin

### La tabella admin_privileges contiene i dati degli admin.

- user_id è un campo che fa riferimento alla tabella utenti e indica l'id dell'utente che ha i privilegi di admin.

## Funzionalità del progetto

### Log In 

- L'utente può effettuare il log in dal form di Login, inserendo la propria email e password.

- Se l'utente non esiste, la password è errata o l'email inserita non è corretta viene visualizzato un messaggio di errore.

- Se l'utente è un admin viene reindirizzato alla dashboard admin.

- Se l'utente è un user viene reindirizzato alla dashboard utente.

link per il reset della password e per la registrazione

### Registrazione

- L'utente può registrarsi al sito, inserendo nome, cognome, email e password.

- Tutti i campi sono obbligatori.

- La password deve essere lunga almeno 8 caratteri e deve contenere almeno un numero e un carattere speciale.

- La password viene hashata utilizzando la funzione md5($password).

- Se l'utente non esiste viene creato un nuovo utente e riceve un messaggio di conferma e puo effettuare il log in.

- Se l'email e gia presente riceve un errore.

- L'utente viene reindirizzato alla pagina di log in.

### Reset password

- L'utente può richiedere il reset della password, inserendo la propria email.

- Se l'utente non esiste riceve un messaggio di errore.

- Se l'utente esiste riceve un messaggio di conferma e riceve una email con un link per il reset della password.

- Il link ha una durata di 30 minuti, dopo di che non è più valido.

- Cliccando sul link l'utente viene reindirizzato ad una pagina dove può inserire la nuova password.

- Se il link è scaduto l'utente riceve un messaggio di errore.

- La password deve essere lunga almeno 8 caratteri e deve contenere almeno un numero e un carattere speciale.

- La password viene hashata utilizzando la funzione md5($password).

- Se l'utente inserisce una password non valida riceve un messaggio di errore.

- Se le password non coincidono riceve un messaggio di errore.

- Se l'utente inserisce una password valida riceve un messaggio di conferma e puo effettuare il log in.

- Il Token viene generato automaticamente quando l'utente richiede il reset della password e viene salvato nel database con la data di scadenza.

- Il token viene generato utilizzando la funzione bin2hex(random_bytes(32)). 

- Il token viene hashato utilizzando la funzione hash('sha256', $token) e salvato nel database.

- Il token se viene cambiato l'utente riceve un messaggio di errore.

- Quando L'utente resetta la password il token e la data di scadenza vengono cancellati dal database.

### Dashboard utente

- L'utente può visualizzare gli eventi a cui fa parte.

- L'utente può effettuare il log out e viene reindirizzato alla pagina di log in.

### Dashboard admin

- L'admin può visualizzare tutti gli eventi presenti nel database se il valore admin_access = 1.

- L'admin può aggiungere un nuovo evento, gli utenti segnati come partecipanti ricevono una email con la notifica dell'aggiunta di un nuovo evento, il nome e la data. Possono poi visualizzare l'evento nella dashboard utente.

- L'admin può modificare un evento esistente, gli utenti segnati come partecipanti ricevono una email con la notifica della modifica dell'evento, il nome e la data. Possono poi visualizzare l'evento nella dashboard utente.

- L'admin può cancellare un evento esistente. L'utente non vedrà più l'evento nella dashboard utente.

- L'admin può effettuare il log out e viene reindirizzato alla pagina di log in.

